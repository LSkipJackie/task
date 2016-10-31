<?php
namespace App\Modules\Task\Http\Controllers;

use App\Http\Controllers\IndexController;
use App\Http\Requests;
use App\Modules\Manage\Model\AgreementModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\Task\Http\Requests\CommentRequest;
use App\Modules\Task\Http\Requests\WorkRequest;
use App\Modules\Task\Model\TaskAttachmentModel;
use App\Modules\Task\Model\TaskModel;
use App\Modules\Task\Model\TaskReportModel;
use App\Modules\Task\Model\TaskRightsModel;
use App\Modules\Task\Model\WorkCommentModel;
use App\Modules\Task\Model\WorkModel;
use App\Modules\User\Model\AttachmentModel;
use App\Modules\User\Model\CommentModel;
use App\Modules\User\Model\MessageReceiveModel;
use App\Modules\User\Model\UserDetailModel;
use App\Modules\User\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modules\Advertisement\Model\AdTargetModel;
use App\Modules\Advertisement\Model\AdModel;
use App\Modules\Advertisement\Model\RePositionModel;
use App\Modules\Advertisement\Model\RecommendModel;
use App\Modules\Manage\Model\ConfigModel;


class DetailController extends IndexController
{
    public function __construct()
    {
        parent::__construct();
        $this->user = Auth::user();
        $this->initTheme('main');
    }
    
	public function index($id,Request $request)
    {
        $this->theme->setTitle('任务详情');

        $data = $request->all();
        
        $detail = TaskModel::detail($id);

        
        if(is_null($detail))
        {
            return redirect()->to('task')->with(['error'=>'您访问的任务未托管！']);
        }
        
        TaskModel::where('id',$id)->increment('view_count',1);
        
        $user_type = 3;
        $is_win_bid = 0;
        $is_delivery = 0;
        $is_rights = 0;
        $delivery_count = 0;
        $works_rights_count = 0;
        
        if($detail['status']>2 && Auth::check())
        {
            
            if(WorkModel::isWorker($this->user['id'],$detail['id']))
            {
                $user_type = 2;
                
                $is_win_bid = WorkModel::isWinBid($id,$this->user['id']);
                $is_delivery = WorkModel::where('task_id',$id)->where('status','>',1)->where('uid',$this->user['id'])->first();
                $is_rights = WorkModel::where('task_id',$id)->where('status','=',4)->where('uid',$this->user['id'])->first();
            }
            
            if($detail['uid']==$this->user['id'])
            {
                $user_type = 1;
            }
        }

        
        $works = WorkModel::findAll($id,$data);
        $works_count = WorkModel::where('task_id',$id)->where('status','<=',1)->where('forbidden',0)->count();
        $works_bid_count = WorkModel::where('task_id',$id)->where('status','=',1)->where('forbidden',0)->count();
        $works_winbid_count = WorkModel::where('task_id',$id)->where('status','=',1)->where('forbidden',0)->count();
        
            
        $delivery = [];
        if(Auth::check())
        {
            if($user_type==2)
            {
                $delivery = WorkModel::select('work.*','us.name as nickname','a.avatar')
                    ->where('work.uid',$this->user['id'])
                    ->where('work.task_id',$id)
                    ->where('work.status','>=',2)
                    ->with('childrenAttachment')
                    ->join('user_detail as a','a.uid','=','work.uid')
                    ->leftjoin('users as us','us.id','=','work.uid')
                    ->paginate(5)->setPageName('delivery_page')->toArray();
                $delivery_count = 1;
            }elseif($user_type==1){
                $delivery = WorkModel::findDelivery($id,$data);
                $delivery_count = WorkModel::where('task_id',$id)->where('status','>=',2)->count();

            }
        }
        
        $comment = CommentModel::taskComment($id,$data);

        $comment_count = CommentModel::where('task_id',$id)->count();
        
        $good_comment = CommentModel::where('task_id',$id)->where('type',1)->count();
        $middle_comment = CommentModel::where('task_id',$id)->where('type',2)->count();
        $bad_comment = CommentModel::where('task_id',$id)->where('type',3)->count();
        
        $attatchment_ids = TaskAttachmentModel::where('task_id','=',$id)->lists('attachment_id')->toArray();
        $attatchment_ids = array_flatten($attatchment_ids);
        $attatchment = AttachmentModel::whereIn('id',$attatchment_ids)->get();
        
        $alike_task = TaskModel::findByCate($detail['cate_id'],$id);

        
        $works_rights = [];
        if(Auth::check())
        {
            if($user_type==2)
            {
                $works_rights = WorkModel::select('work.*','us.name as nickname','ud.avatar')
                    ->where('work.uid',$this->user['id'])
                    ->where('task_id',$id)->where('work.status',4)
                    ->with('childrenAttachment')
                    ->join('user_detail as ud','ud.uid','=','work.uid')
                    ->leftjoin('users as us','us.id','=','work.uid')
                    ->paginate(5)->setPageName('delivery_page')->toArray();
                $works_rights_count = 1;
            }elseif($user_type==1)
            {
                $works_rights = WorkModel::findRights($id);
                $works_rights_count = WorkModel::where('task_id',$id)->where('status',4)->count();
            }
        }

        $domain = \CommonClass::getDomain();

        
        $ad = AdTargetModel::getAdInfo('TASKINFO_RIGHT');

        
        $reTarget = RePositionModel::where('code','TASKDETAIL_SIDE')->where('is_open','1')->select('id','name')->first();
        if($reTarget->id){
            $recommend = RecommendModel::getRecommendInfo($reTarget->id)->select('*')->get();
            if(count($recommend)){
                foreach($recommend as $k=>$v){
                    $taskInfo = TaskModel::where('id',$v['recommend_id'])->select('bounty','created_at')->first();
                    if($taskInfo){
                        $v['bounty'] = $taskInfo->bounty;
                        $v['create_time'] = $taskInfo->created_at;
                    }
                    else{
                        $v['bounty'] = 0;
                        $v['create_time'] = 0;
                    }
                    $recommend[$k] = $v;
                }
                $hotList = $recommend;
            }
            else{
                $hotList = [];
            }
        }
        
        $agree = AgreementModel::where('code_name','task_delivery')->first();
        $view = [
            'detail'=>$detail,
            'attatchment'=>$attatchment,
            'alike_task'=>$alike_task,
            'user_type'=>$user_type,
            'works'=> $works,
            'file_type'=>'jpg',
            'is_win_bid'=>$is_win_bid,
            'is_delivery'=>$is_delivery,
            'merge'=>$data,
            'delivery'=>$delivery,
            'domain'=>$domain,
            'comment'=>$comment,
            'good_comment'=>$good_comment,
            'middle_comment'=>$middle_comment,
            'bad_comment'=>$bad_comment,
            'works_count'=>$works_count,
            'delivery_count'=>$delivery_count,
            'comment_count'=>$comment_count,
            'works_bid_count'=>$works_bid_count,
            'merge'=>$data,
            'works_rights'=>$works_rights,
            'works_rights_count'=>$works_rights_count,
            'ad'=>$ad,
            'hotList' => $hotList,
            'targetName' => $reTarget->name,
            'is_rights'=>$is_rights,
            'works_winbid_count'=>$works_winbid_count,
            'agree' => $agree
        ];
        return $this->theme->scope('task.detail', $view)->render();
    }

    
    public function work($id)
    {
        $this->theme->setTitle('竞标投稿');

        
        $agree = AgreementModel::where('code_name','task_draft')->first();

        $task_data = TaskModel::where('id',$id)->first();

        $view =[
            'task'=>$task_data,
            'agree' => $agree
        ];

        return $this->theme->scope('task.work', $view)->render();
    }
    
    public function workCreate(WorkRequest $request)
    {
        $data = $request->except('_token');
        $data['desc'] = \CommonClass::removeXss($data['desc']);
        $data['uid'] = $this->user['id'];
        $data['created_at'] = date('Y-m-d H:i:s',time());


        
        $is_work_able = $this->isWorkAble($data['task_id']);
        
        if(!$is_work_able['able'])
        {
            return redirect()->back()->with('error',$is_work_able['errMsg']);
        }
        
        $workModel = new WorkModel();
        $result = $workModel->workCreate($data);

        if(!$result) return redirect()->back()->with('error','投稿失败！');
        
        
        $task_delivery = MessageTemplateModel::where('code_name','task_delivery')->where('is_open',1)->where('is_on_site',1)->first();
        if($task_delivery)
        {
            $task = TaskModel::where('id',$data['task_id'])->first();
            $user = UserModel::where('id',$task['uid'])->first();

            $site_name = \CommonClass::getConfig('site_name');
            $user_name = Auth::user()['name'];
            
            
            $messageVariableArr = [
                'username'=>$user['name'],
                'name'=>$user_name,
                'task_title'=>$task['title'],
                'website'=>$site_name,
            ];
            $message = MessageTemplateModel::sendMessage('task_delivery',$messageVariableArr);
            $messages = [
                'message_title'=>$task_delivery['name'],
                'code'=>'task_delivery',
                'message_content'=>$message,
                'js_id'=>$user['id'],
                'message_type'=>2,
                'receive_time'=>date('Y-m-d H:i:s',time()),
                'status'=>0,
            ];
            MessageReceiveModel::create($messages);
        }
        return redirect()->to('task/'.$data['task_id']);
    }

    
    public function winBid($work_id,$task_id)
    {
        $data['task_id'] = $task_id;
        $data['work_id'] = $work_id;

        
            
        $task_user = TaskModel::where('id',$task_id)->lists('uid');

        if($task_user[0]!=$this->user['id'])
        {
            return redirect()->back()->with(['error'=>'非法操作,你不是任务的发布者不能选择中标人选！']);
        }
        
        $worker_num = TaskModel::where('id',$task_id)->lists('worker_num');
        
        $win_bid_num = WorkModel::where('task_id',$task_id)->where('status',1)->count();

        
        if($worker_num[0]>$win_bid_num)
        {
            $data['worker_num'] = $worker_num[0];
            $data['win_bid_num'] = $win_bid_num;
            $workModel = new WorkModel();
            $result = $workModel->winBid($data);

            if(!$result) return redirect()->back()->with(['error'=>'操作失败！']);
        }else{
            return redirect()->back()->with(['error'=>'当前中标人数已满！']);
        }

        return redirect()->back()->with(['massage'=>'选稿成功！']);
    }

    
    public function delivery($id)
    {
        $this->theme->setTitle('交付稿件');

        $task_data = TaskModel::where('id',$id)->first();

        
        $ad = AdTargetModel::getAdInfo('TASKDELIVERY_RIGHT_BUTTOM');

        
        $agree = AgreementModel::where('code_name','task_delivery')->first();

        
        $reTarget = RePositionModel::where('code','TASKDELIVERY_SIDE')->where('is_open','1')->select('id','name')->first();
        if($reTarget->id){
            $recommend = RecommendModel::getRecommendInfo($reTarget->id)->select('*')->get();
            if(count($recommend)){
                foreach($recommend as $k=>$v){
                    $taskInfo = TaskModel::where('id',$v['recommend_id'])->select('bounty','created_at')->first();
                    if($taskInfo){
                        $v['bounty'] = $taskInfo->bounty;
                        $v['create_time'] = $taskInfo->created_at;
                    }
                    else{
                        $v['bounty'] = 0;
                        $v['create_time'] = 0;
                    }
                    $recommend[$k] = $v;
                }
                $hotList = $recommend;
            }
            else{
                $hotList = [];
            }
        }

        $view =[
            'task'=>$task_data,
            'ad'=>$ad,
            'hotList' => $hotList,
            'targetName' => $reTarget->name,
            'agree' => $agree

        ];

        return $this->theme->scope('task.delivery', $view)->render();
    }
    
    public function deliverCreate(WorkRequest $request)
    {
        $data = $request->except('_token');
        $data['desc'] = \CommonClass::removeXss($data['desc']);
        $data['uid'] = $this->user['id'];
        $data['status'] = 2;
        $data['created_at'] = date('Y-m-d H:i:s',time());
        
        if(empty($data['task_id']) || empty($data['work_id']))
        {
            return redirect()->back()->with(['error'=>'投稿失败']);
        }
        
        if(!WorkModel::isWinBid($data['task_id'],$this->user['id']))
        {
            return redirect()->back()->with('error','您的稿件没有中标不能通过交付！');
        }
        $is_delivery = WorkModel::where('task_id',$data['task_id'])
            ->where('uid',$this->user['id'])
            ->where('status','>=',2)->first();


        
        if($is_delivery)
        {
            return redirect()->back()->with('error','您已经交付过了！');
        }

        $result = WorkModel::delivery($data);

        if(!$result) return redirect()->back()->with('error','交付失败！');
        
        
        $agreement_documents = MessageTemplateModel::where('code_name','agreement_documents')->where('is_open',1)->where('is_on_site',1)->first();
        if($agreement_documents)
        {
            $task = TaskModel::where('id',$data['task_id'])->first();
            $user = UserModel::where('id',$task['uid'])->first();
            $site_name = \CommonClass::getConfig('site_name');
            $user_name = $this->user['name'];
            $domain = \CommonClass::getDomain();
            
            
            $messageVariableArr = [
                'username'=>$user['name'],
                'initiator'=>$user_name,
                'agreement_link'=>$domain.'/task/'.$task['id'],
                'website'=>$site_name,
            ];
            $message = MessageTemplateModel::sendMessage('agreement_documents',$messageVariableArr);
            $messages = [
                'message_title'=>$agreement_documents['name'],
                'code'=>'agreement_documents',
                'message_content'=>$message,
                'js_id'=>$user['id'],
                'message_type'=>2,
                'receive_time'=>date('Y-m-d H:i:s',time()),
                'status'=>0,
            ];
            MessageReceiveModel::create($messages);
        }
        return redirect()->to('task/'.$data['task_id']);
    }

    
    public function workCheck(Request $request)
    {
        $data = $request->except('_token');
        $data['work_status'] = 3;
        $work_data = WorkModel::where('id',$data['work_id'])->first();
        $data['uid'] = $work_data['uid'];
        
        if(!TaskModel::isEmployer($work_data['task_id'],$this->user['id']))
        return redirect()->back()->with(['error'=>'您不是雇主，您的操作有误！']);
        

        if($work_data['status']!=2)
        return redirect()->back()->with(['error'=>'当前稿件不具备验收资格！']);
        
        $worker_num = TaskModel::where('id',$work_data['task_id'])->first();
        $worker_num = $worker_num['worker_num'];
        
        $win_check = WorkModel::where('work.task_id',$work_data['task_id'])->where('status','>',2)->count();

        $data['worker_num'] = $worker_num;
        $data['win_check'] = $win_check;
        $data['task_id'] = $work_data['task_id'];

        $workModel = new WorkModel();
        $result = $workModel->workCheck($data);
        if(!$result) return redirect()->back()->with(['error'=>'验收失败！']);

        if($result) return redirect()->to('task/'.$data['task_id'])->with(['manage'=>'验收成功！']);
    }
    
    public function lostCheck(Request $request)
    {
        $data = $request->except('_token');
        $data['work_status'] = 4;
        
        if(!TaskModel::isEmployer($data['task_id'],$this->user['id']))
            return response()->json(['errCode'=>0,'error'=>'您不是雇主，您的操作有误！']);
        
        $work_data = WorkModel::where('id',$data['work_id'])->first();
        if($work_data['status']!=2)
            return response()->json(['errCode'=>0,'error'=>'当前稿件不具备验收资格！']);

        $workModel = new WorkModel();
        $result = $workModel->lostCheck($data);
        if(!$result) return response()->back()->with('error','验收失败！');
        
        return response()->json(['errCode'=>1,'id'=>$data['work_id']]);
    }
    
    private function isWorkAble($task_id)
    {
        
        $task_data = TaskModel::where('id',$task_id)->first();
        if($task_data['status']!=(3||4) || strtotime($task_data['begin_at'])>time())
        {
            return ['able' => false, 'errMsg' => '当前任务还未开始投稿！'];
        }
        
        if (!isset($this->user['id'])) {
            return ['able' => false, 'errMsg' => '请登录后再操作！'];
        }
        
        if (WorkModel::isWorker($this->user['id'], $task_id)) {
            return ['able' => false, 'errMsg' => '你已经投过稿了'];
        }
        
        if (TaskModel::isEmployer($task_id, $this->user['id']))
        {
            return ['able' => false, 'errMsg'=>'你是任务发布者不能投稿！'];
        }
        return ['able'=>true];
    }

    
    public function ajaxWorkAttatchment(Request $request)
    {
        $file = $request->file('file');
        
        $attachment = \FileClass::uploadFile($file,'task');
        $attachment = json_decode($attachment,true);
        
        if($attachment['code']!=200)
        {
            return response()->json(['errCode' => 0, 'errMsg' => $attachment['message']]);
        }
        $attachment_data = array_add($attachment['data'],'status',1);
        $attachment_data['created_at'] = date('Y-m-d H:i:s',time());
        
        $result = AttachmentModel::create($attachment_data);
        $result = json_decode($result,true);

        if(!$result)
        {
            return response()->json(['errCode'=>0,'errMsg'=>'文件上传失败！']);
        }
        
        return response()->json(['id'=>$result['id']]);
    }
    
    public function delAttatchment(Request $request)
    {
        $id = $request->get('id');
        $result = AttachmentModel::where('user_id',$this->user['id'])->where('id',$id)->delete();
        if(!$result)
        {
            return response()->json(['errCode'=>0,'errMsg'=>'删除失败！']);
        }
        return response()->json(['errCode'=>1,'errMsg'=>'删除成功！']);
    }

    
    public function download($id)
    {
        $pathToFile = AttachmentModel::where('id',$id)->first();
        $pathToFile = $pathToFile['url'];
        return response()->download($pathToFile);
    }

    
    public function getComment($id)
    {
        $workComment = WorkCommentModel::where('work_id',$id)
            ->with('parentComment')
            ->with('user')
            ->with('users')
            ->get()->toArray();
        
        $domain = \CommonClass::getDomain();
        foreach($workComment as $k=>$v)
        {
            $workComment[$k]['avatar_md5'] = $domain.'/'.$v['user']['avatar'];
            $workComment[$k]['nickname'] = $v['users']['name'];
            if(is_array($v['parent_comment']))
            {
                $workComment[$k]['parent_user'] = $v['parent_comment']['nickname'];
            }
        }
        $data['errCode'] = 1;
        $data['comment'] = $workComment;
        $data['onerror_img'] = \CommonClass::getDomain().'/'.$this->theme->asset()->url('images/defauthead.png');

        return response()->json($data);
    }

    
    public function ajaxComment(CommentRequest $request)
    {
        $data = $request->except('_token');
        $data['comment'] = htmlspecialchars($data['comment']);
        $data['uid'] = $this->user['id'];
        $user = UserDetailModel::where('uid',$this->user['id'])->first();
        $users = UserModel::where('id',$this->user['id'])->first();
        $data['nickname'] = $users['name'];

        $data['created_at'] = date('Y-m-d H:i:s',time());

        
        $result = WorkCommentModel::create($data);

        if(!$result) return response()->json(['errCode'=>0,'errMsg'=>'提交回复失败！']);
        
        $comment_data = WorkCommentModel::where('id',$result['id'])->with('parentComment')->with('user')->with('users')->first()->toArray();
        $domain = \CommonClass::getDomain();
        $comment_data['avatar_md5'] = $domain.'/'.$user['avatar'];

        if(is_array($comment_data['parent_comment']))
        {
            $comment_data['parent_user'] = $comment_data['parent_comment']['nickname'];
        }
        $comment_data['errCode'] = 1;
        $comment_data['onerror_img'] = \CommonClass::getDomain().'/'.$this->theme->asset()->url('images/defauthead.png');

        return response()->json($comment_data);
    }

    
    public function evaluate(Request $request)
    {
        
        $this->theme->setTitle('交易互评');
        $data = $request->all();
        
        $is_checked = WorkModel::where('task_id',$data['id'])
            ->where('uid',$this->user['id'])
            ->where('status',3)->first();
        
        $task = TaskModel::where('id',$data['id'])->first();

        if(!$is_checked && $task['uid']!=$this->user['id'])
        {
            return redirect()->back()->with('error','你不具备评价资格！');
        }
        
        $alike_task = TaskModel::findByCate($task['cate_id'],$data['id']);
        
        if($is_checked)
        {
            $evaluate_people = UserDetailModel::select('user_detail.*','us.name as nickname')
                ->where('uid',$task['uid'])
                ->join('users as us','user_detail.uid','=','us.id')
                ->first();
            $work = WorkModel::where('id',$data['work_id'])->first();
            $comment_people = UserDetailModel::where('uid',$work['uid'])->first();
            $evaluate_from = 0;
        }else if($task['uid']==$this->user['id'])
        {
            $work = WorkModel::where('id',$data['work_id'])->first();
            $evaluate_people = UserDetailModel::select('user_detail.*','us.name as nickname')
                ->where('uid',$work['uid'])
                ->join('users as us','user_detail.uid','=','us.id')
                ->first();
            $comment_people = UserDetailModel::where('uid',$task['uid'])->first();
            $evaluate_from = 1;
        }
        $domain = \CommonClass::getDomain();

        
        $ad = AdTargetModel::getAdInfo('TASKINFO_RIGHT');

        
        $reTarget = RePositionModel::where('code','TASKDETAIL_SIDE')->where('is_open','1')->select('id','name')->first();
        if($reTarget->id){
            $recommend = RecommendModel::getRecommendInfo($reTarget->id)->select('*')->get();
            if(count($recommend)){
                foreach($recommend as $k=>$v){
                    $taskInfo = TaskModel::where('id',$v['recommend_id'])->select('bounty','created_at')->first();
                    if($taskInfo){
                        $v['bounty'] = $taskInfo->bounty;
                        $v['create_time'] = $taskInfo->created_at;
                    }
                    else{
                        $v['bounty'] = 0;
                        $v['create_time'] = 0;
                    }
                    $recommend[$k] = $v;
                }
                $hotList = $recommend;
            }
            else{
                $hotList = [];
            }
        }
        
        $view = [
            'evaluate_people'=>$evaluate_people,
            'task_id'=>$data['id'],
            'work_id'=>$data['work_id'],
            'domain'=>$domain,
            'comment_people'=>$comment_people,
            'evaluate_from'=>$evaluate_from,
            'alike_task'=>$alike_task,
            'hoteList'=>$hotList,
            'ad'=>$ad,
            'hotList' => $hotList,
            'targetName' => $reTarget->name
        ];

        return $this->theme->scope('task.evaluate', $view)->render();
    }


    
    public function evaluateCreate(Request $request)
    {
        $data = $request->except('token');

        
        $is_checked = WorkModel::where('task_id',$data['task_id'])
            ->where('uid',$this->user['id'])
            ->where('status',3)->first();
        
        $task = TaskModel::where('id',$data['task_id'])->first();

        if(!$is_checked && $task['uid']!=$this->user['id'])
        {
            return redirect()->back()->with('error','你不具备评价资格！');
        }
        
        $data['from_uid'] = $this->user['id'];
        $data['comment'] = e($data['comment']);
        $data['created_at'] = date('Y-m-d H:i:s',time());
        
        if($is_checked)
        {
            $data['to_uid'] = $task['uid'];
            $data['comment_by'] = 0;
        }else if($task['uid']==$this->user['id'])
        {
            $work = WorkModel::where('id',$data['work_id'])->first();
            $data['to_uid'] = $work['uid'];
            $data['comment_by'] = 1;
        }


        $is_evaluate =  CommentModel::where('from_uid',$this->user['id'])
            ->where('task_id',$data['task_id'])->where('to_uid',$data['to_uid'])
            ->first();

        if($is_evaluate)
        {
            return redirect()->back()->with(['error'=>'你已经评论过了！']);
        }


        $result = CommentModel::commentCreate($data);

        if(!$result)
        {
            return redirect()->back()->with('error','评论失败！');
        }

        return redirect()->to('task/'.$data['task_id'])->with('massage','评论成功！');
    }

    
    public function ajaxRights(Request $request)
    {
        $data = $request->except('_token');
        $data['desc'] = e($data['desc']);
        $data['status'] = 0;
        $data['created_at'] = date("Y-m-d H:i:s", time());
        $work = WorkModel::where('id',$data['work_id'])->first();
        if($work['status']==4)
        {
            return redirect()->back()->with(['error'=>'当前稿件正在维权']);
        }
        
        $is_checked = WorkModel::where('id',$data['work_id'])
            ->where('status',2)
            ->where('task_id',$data['task_id'])
            ->where('uid',$this->user['id'])
            ->first();
        
        $task = TaskModel::where('id',$data['task_id'])->first();
        
        if(!$is_checked && $task['uid']!=$this->user['id'])
        {
            return redirect()->back()->with(['error'=>'你不具备维权资格！']);
        }
        
        if($is_checked)
        {
            $data['role'] = 0;
            $data['from_uid'] = $this->user['id'];
            $data['to_uid'] = $task['uid'];
        }else if($task['uid']==$this->user['id'])
        {
            $data['role'] = 1;
            $data['from_uid']  = $this->user['id'];

            $data['to_uid'] = $work['uid'];
        }
        $result = TaskRightsModel::rightCreate($data);

        if(!$result)
            return redirect()->back()->with(['error'=>'维权失败！']);
        
        $trading_rights = MessageTemplateModel::where('code_name','trading_rights')->where('is_open',1)->where('is_on_site',1)->first();
        if($trading_rights)
        {

            $task = TaskModel::where('id',$data['task_id'])->first();
            $from_user = UserModel::where('id',$this->user['id'])->first();
            $site_name = \CommonClass::getConfig('site_name');
            
            
            $fromMessageVariableArr = [
                'username'=>$from_user['name'],
                'tasktitle'=>$task['title'],
                'website'=>$site_name,
            ];
            $fromMessage = MessageTemplateModel::sendMessage('trading_rights',$fromMessageVariableArr);
            $messages = [
                'message_title'=>$trading_rights['name'],
                'code'=>'trading_rights',
                'message_content'=>$fromMessage,
                'js_id'=>$from_user['id'],
                'message_type'=>2,
                'receive_time'=>date('Y-m-d H:i:s',time()),
                'status'=>0,
            ];
            MessageReceiveModel::create($messages);
        }
        return redirect()->to('task/'.$data['task_id'])->with(['error'=>'维权成功！']);
    }

    
    public function report(Request $request)
    {
        $data = $request->except('_token');
        $data['desc'] = e($data['desc']);
        $files = $request->file('file');
        
        $is_report = TaskReportModel::where('from_uid',$this->user['id'])
            ->where('task_id',$data['task_id'])
            ->where('work_id',$data['work_id'])
            ->first();

        if($is_report)
        {
            return response()->json(['errCode'=>0,'errMsg'=>'您已经成功举报过，请等候平台处理']);
        }

        $attachement_ids = [];
        if(!empty($files))
        {
            foreach($files as $v){
                $attachment = \FileClass::uploadFile($v);
                $attachment = json_decode($attachment,true);
                $attachment_data = array_add($attachment['data'],'status',1);
                $attachment_data['created_at'] = date('Y-m-d H:i:s',time());
                
                $result = AttachmentModel::create($attachment_data);
                $attachement_ids[] = $result['id'];
            }
        }
        $work_data = WorkModel::where('id',$data['work_id'])->first();
        
        $data['status'] = 0;
        $data['from_uid'] = $this->user['id'];
        $data['to_uid'] = $work_data['uid'];
        $data['attachment_ids'] = json_encode($attachement_ids);
        $data['created_at'] = date('Y-m-d H:s:i',time());
        $result2 = TaskReportModel::create($data);
        if(!$result2)
        {
            return response()->json(['errCode'=>0,'errMsg'=>'举报失败！']);
        }
        
        $task_publish_success = MessageTemplateModel::where('code_name','report')->where('is_open',1)->where('is_on_site',1)->first();
        if($task_publish_success)
        {
            $task = TaskModel::where('id',$data['task_id'])->first();
            $site_name = \CommonClass::getConfig('site_name');
            
            $messageVariableArr = [
                'username'=>$this->user()['name'],
                'task_title'=>$task['title'],
                'website'=>$site_name,
            ];
            $message = MessageTemplateModel::sendMessage('report ',$messageVariableArr);
            $message = [
                'message_title'=>$task_publish_success['name '],
                'code'=>'report',
                'message_content'=>$message,
                'js_id'=>$this->user()['id'],
                'message_type'=>2,
                'receive_time'=>date('Y-m-d H:i:s',time()),
                'status'=>0,
            ];
            MessageReceiveModel::create($message);
        }
        return response()->json(['errCode'=>1,'errMsg'=>'举报成功！']);
    }

    
    public function ajaxPageWorks($id,Request $request)
    {
        $this->initTheme('ajaxpage');
        $data = $request->all();
        $detail = TaskModel::detail($id);

        
        $user_type = 3;
        $is_win_bid = 0;
        
        if($detail['status']>2)
        {
            
            if(WorkModel::isWorker($this->user['id'],$detail['id']))
            {
                $user_type = 2;
                
                $is_win_bid = WorkModel::isWinBid($id,$this->user['id']);
            }
            
            if($detail['uid']==$this->user['id'])
            {
                $user_type = 1;
            }
        }

        $works_data = WorkModel::findAll($id,$data);
        $works_count = WorkModel::where('task_id',$id)->where('status','<=',1)->count();
        $works_bid_count = WorkModel::where('task_id',$id)->where('status','=',1)->count();

        $view = [
            'detail'=>$detail,
            'works'=>$works_data,
            'merge'=>$data,
            'works_count'=>$works_count,
            'works_bid_count'=>$works_bid_count,
            'user_type'=>$user_type,
            'is_win_bid'=>$is_win_bid,
        ];
        return $this->theme->scope('task.pagework', $view)->render();
    }
    
    public function ajaxPageDelivery($id,Request $request)
    {
        $this->initTheme('ajaxpage');
        $data = $request->all();
        $detail = TaskModel::detail($id);

        
        $user_type = 3;
        $is_win_bid = 0;
        $is_delivery = 0;
        
        if($detail['status']>2)
        {
            
            if(WorkModel::isWorker($this->user['id'],$detail['id']))
            {
                $user_type = 2;
                
                $is_win_bid = WorkModel::isWinBid($id,$this->user['id']);
                $is_delivery = WorkModel::where('task_id',$id)->where('status','>',1)->where('uid',$this->user['id'])->first();
            }
            
            if($detail['uid']==$this->user['id'])
            {
                $user_type = 1;
            }
        }

        
        
        
        $delivery = [];
        if(Auth::check())
        {


            if($user_type==2)
            {
                $delivery = WorkModel::select('work.*','us.name as nickname','a.avatar')
                    ->where('work.uid',$this->user['id'])
                    ->where('work.task_id',$id)
                    ->where('work.status','>=',2)
                    ->with('childrenAttachment')
                    ->join('user_detail as a','a.uid','=','work.uid')
                    ->leftjoin('users as us','us.id','=','work.uid')
                    ->paginate(5)->setPageName('delivery_page')->toArray();
                $delivery_count = 1;
            }elseif($user_type==1){
                $delivery = WorkModel::findDelivery($id,$data);
                $delivery_count = WorkModel::where('task_id',$id)->where('status','>=',2)->count();
            }
        }
        $works_data = WorkModel::findAll($id,$data);

        $domain = \CommonClass::getDomain();
        $view = [
            'detail'=>$detail,
            'delivery'=>$delivery,
            'delivery_count'=>$delivery_count,
            'is_delivery'=>$is_delivery,
            'merge'=>$data,
            'user_type'=>$user_type,
            'is_win_bid'=>$is_win_bid,
            'domain'=>$domain,
            'works'=>$works_data
        ];
        return $this->theme->scope('task.pagedelivery', $view)->render();
    }
    
    public function ajaxPageComment($id,Request $request)
    {
        $this->initTheme('ajaxpage');
        $data = $request->all();
        $detail = TaskModel::detail($id);
        $data['task_user_id'] = $detail['uid'];
        
        $user_type = 3;
        $is_win_bid = 0;
        
        if($detail['status']>2)
        {
            
            if(WorkModel::isWorker($this->user['id'],$detail['id']))
            {
                $user_type = 2;
                
                $is_win_bid = WorkModel::isWinBid($id,$this->user['id']);
            }
            
            if($detail['uid']==$this->user['id'])
            {
                $user_type = 1;
            }
        }
        $delivery = WorkModel::findDelivery($id,$data);
        $works_data = WorkModel::findAll($id,$data);
        
        $comment = CommentModel::taskComment($id,$data);
        $comment_count = CommentModel::where('task_id',$id)->count();
        
        $good_comment = CommentModel::where('task_id',$id)->where('type',1)->count();
        $middle_comment = CommentModel::where('task_id',$id)->where('type',2)->count();
        $bad_comment = CommentModel::where('task_id',$id)->where('type',3)->count();
        $domain = \CommonClass::getDomain();

        $view = [
            'detail'=>$detail,
            'merge'=>$data,
            'user_type'=>$user_type,
            'is_win_bid'=>$is_win_bid,
            'comment'=>$comment,
            'comment_count'=>$comment_count,
            'good_comment'=>$good_comment,
            'middle_comment'=>$middle_comment,
            'bad_comment'=>$bad_comment,
            'delivery'=>$delivery,
            'domain'=>$domain,
            'works'=>$works_data,
            'merge'=>$data
        ];

        return $this->theme->scope('task.pageComment', $view)->render();
    }

}
