<?php
namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\ManageController;
use App\Http\Requests;
use App\Http\Controllers\BasicController;
use App\Modules\Finance\Model\FinancialModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskReportModel;
use App\Modules\Task\Model\TaskRightsModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskRightsController extends ManageController
{
    public $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = $this->manager;
        $this->initTheme('manage');
        $this->theme->setTitle('用户维权');
        $this->theme->set('manageType', 'TaskRights');
    }

    
    public function rightsList(Request $request)
    {
        $data = $request->all();
        $query = TaskRightsModel::select('task_rights.*', 'ud.name as from_nickname', 'userd.name as to_nickname', 'mg.username as handle_nickname');
        
        if ($request->get('reportId')) {
            $query = $query->where('ud.name','like','%'.$request->get('reportId').'%');
        }
        
        if ($request->get('reportType') && $request->get('reportType') != 0) {
            $query = $query->where('task_rights.type', $request->get('reportType'));
        }
        
        if ($request->get('reportStatus') && $request->get('reportStatus') != 0) {

            $query = $query->where('task_rights.status', $request->get('reportStatus') - 1);
        }
        
        $page_size = 10;
        if ($request->get('pageSize')) {
            $page_size = $request->get('pageSize');
        }
        $reports_page = $query->join('users as ud', 'ud.id', '=', 'task_rights.from_uid')
            ->leftjoin('users as userd', 'userd.id', '=', 'task_rights.to_uid')
            ->leftjoin('manager as mg', 'mg.id', '=', 'task_rights.handle_uid')
            ->orderBy('task_rights.id','DESC')
            ->paginate($page_size);
        $reports = $reports_page->toArray();
        
        $rights_type = [
            'type'=>[
                1=>'违规信息',
                2=>'虚假交换',
                3=>'涉嫌抄袭',
                4=>'其他',
            ],
        ];
        $reports['data'] = \CommonClass::intToString($reports['data'],$rights_type);

        $view = [
            'rights' => $reports,
            'merge' => $data,
            'reports_page'=>$reports_page
        ];

        return $this->theme->scope('manage.taskrights', $view)->render();
    }

    
    public function rightsDetail($id)
    {
        
        $preId = TaskRightsModel::where('id', '>', $id)->min('id');
        
        $nextId = TaskRightsModel::where('id', '<', $id)->max('id');
        $rights = TaskRightsModel::where('id',$id)->first();
        $work = WorkModel::where('id',$rights['work_id'])->first();
        $task = TaskModel::where('id',$rights['task_id'])->first();
        $from_user = UserModel::select('users.*','users.name as nickname','ud.mobile','ud.qq')
            ->where('users.id',$rights['from_uid'])
            ->leftjoin('user_detail as ud','ud.uid','=','users.id')
            ->first();

        $to_user = UserModel::select('users.*','users.name as nickname','ud.mobile','ud.qq')
            ->where('users.id',$rights['to_uid'])
            ->leftjoin('user_detail as ud','ud.id','=','users.id')
            ->first();

        $view = [
            'report'=>$rights,
            'from_user'=>$from_user,
            'to_user'=>$to_user,
            'task'=>$task,
            'work'=>$work,
            'preId'=>$preId,
            'nextId'=>$nextId
        ];

        return $this->theme->scope('manage.rightsdetail', $view)->render();
    }

    
    public function rightsDelet($id)
    {
        
        $result = TaskRightsModel::destroy($id);
        if(!$result)
            return redirect()->to('/manage/rightsList')->with(['error'=>'删除失败！']);

        return redirect()->to('/manage/rightsList')->with(['massage'=>'删除成功！']);
    }

    
    public function rightsDeletGroup(Request $request)
    {
        $data = $request->except('_token');

        $result = TaskRightsModel::whereIn($data['id'])->delete();

        if(!$result)
            return redirect()->to('/manage/rightsList')->with(['error'=>'删除失败!']);

        return redirect()->to('/manage/rightsList')->with(['massage'=>'删除成功！']);
    }

    
    public function handleRights(Request $request)
    {
        $data = $request->except('_token');
        $rights = TaskRightsModel::where('id',$data['id'])->first();

        
        $task = TaskModel::where('id',$rights['task_id'])->first();
        $bounty = floor($task['bounty']/$task['worker_num']);
        
        if(($data['worker_bounty']+$data['owner_bounty'])>$bounty)
        {
            return redirect()->back()->with(['error'=>'赏金分配超额']);
        }
        if($rights['role']==0)
        {
            $worker_id = $rights['from_uid'];
            $owner_id = $rights['to_uid'];
        }else{
            $worker_id = $rights['to_uid'];
            $owner_id = $rights['from_uid'];
        }
        
        $status = DB::transaction(function() use($data,$rights,$bounty,$worker_id,$owner_id,$task)
        {
            
            if($task['status']==11)
            {
                TaskModel::where('id',$task['id'])->update(['status'=>9,'end_at'=>date('Y-m-d',time())]);
            }
            
            $handle = [
                'status'=>1,
                'handle_uid'=>$this->user['id'],
                'handled_at'=>date('Y-m-d H:i:s',time())
            ];
            TaskRightsModel::where('id',$data['id'])->update($handle);

            
            if($data['worker_bounty']!=0)
            {
                UserDetailModel::where('uid',$worker_id)->increment('balance',$data['worker_bounty']);
                
                $finance_data = [
                    'action'=>2,
                    'pay_type'=>1,
                    'cash'=>$data['worker_bounty'],
                    'uid'=>$worker_id,
                    'created_at'=>date('Y-m-d H:i:s',time()),
                ];
                FinancialModel::create($finance_data);
            }
            
            if($data['owner_bounty']!=0)
            {
                UserDetailModel::where('uid',$owner_id)->increment('balance',$data['owner_bounty']);
                
                $finance_data = [
                    'action'=>7,
                    'pay_type'=>1,
                    'cash'=>$data['owner_bounty'],
                    'uid'=>$owner_id,
                    'created_at'=>date('Y-m-d H:i:s',time()),
                ];
                FinancialModel::create($finance_data);
            }
        });

        
        if(!is_null($status))
        {
            return redirect()->back()->with(['error'=>'维权处理失败！']);
        }
        $trading_rights_result  = MessageTemplateModel::where('code_name','trading_rights_result')->where('is_open',1)->where('is_on_site',1)->first();
        if($trading_rights_result)
        {
            $task = TaskModel::where('id',$rights['task_id'])->first();
            $worker_user = UserModel::where('id',$worker_id)->first();
            $owner_user = UserModel::where('id',$owner_id)->first();
            $site_name = \CommonClass::getConfig('site_name');
            
            
            $ownerMessageVariableArr = [
                'username'=>$owner_user['name'],
                'tasktitle'=>$task['title'],
                'ownername'=>$owner_user['name'],
                'ownermoney'=>$data['owner_bounty'],
                'workername'=>$worker_user['name'],
                'wokermoney'=>$data['worker_bounty'],
                'website'=>$site_name,
            ];
            $ownerMessage = MessageTemplateModel::sendMessage('trading_rights_result',$ownerMessageVariableArr);
            $message1 = [
                'message_title'=>$trading_rights_result['name'],
                'code'=>'trading_rights_result',
                'message_content'=>$ownerMessage,
                'js_id'=>$owner_user['id'],
                'message_type'=>2,
                'receive_time'=>date('Y-m-d H:i:s',time()),
                'status'=>0,
            ];
            MessageReceiveModel::create($message1);
            
            $workerMessageVariableArr = [
                'username'=>$worker_user['name'],
                'tasktitle'=>$task['title'],
                'ownername'=>$owner_user['name'],
                'ownermoney'=>$data['owner_bounty'],
                'workername'=>$worker_user['name'],
                'wokermoney'=>$data['worker_bounty'],
                'website'=>$site_name,
            ];
            $workerMessage = MessageTemplateModel::sendMessage('trading_rights_result',$workerMessageVariableArr);
            $message2 = [
                'message_title'=>$trading_rights_result['name'],
                'code'=>'trading_rights_result',
                'message_content'=>$workerMessage,
                'js_id'=>$worker_user['id'],
                'message_type'=>2,
                'receive_time'=>date('Y-m-d H:i:s',time()),
                'status'=>0,
            ];
            MessageReceiveModel::create($message2);
        }
        return redirect()->back()->with(['massage'=>'维权处理成功！']);

    }

}
