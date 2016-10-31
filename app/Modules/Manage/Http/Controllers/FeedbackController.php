<?php

namespace App\Modules\Manage\Http\Controllers;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ManageController;
use App\Modules\Manage\Model\FeedbackModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\User\Model\MessageReceiveModel;
use Illuminate\Http\Request;
use Theme;
use App\Modules\User\Model\UserModel;
use Validator;

class FeedbackController extends ManageController
{
    public function __construct()
    {
        parent::__construct();
        $this->theme->setTitle('用户反馈');
        $this->initTheme('manage');
    }

    
    public function listInfo(Request $request)
    {
        $merge = $request->all();
        $where = '1 = 1';

        if($request->get('id') !== null){
            $where .= " and id like '%" . $request->get('id'). "%'";
        }
        if ($request->get('user') == '1') {
            $where .= " and uid != 0 ";
        }
        else if($request->get('user') == '2'){
            $where .= " and uid = 0 ";
        }

        if($request->get('status') != 0){
            $where .= " and status =" . $request->get('status');
        }
        $paginate = $request->get('paginate') ? $request->get('paginate') : 10;

        $feedbackList = FeedbackModel::whereRaw($where)->orderBy('id','desc')->paginate($paginate);
        $feedbackListArr = $feedbackList->toArray();
        if($feedbackList->total()){
            foreach($feedbackList->items() as $k=>$v){
                $userInfo = UserModel::where('id',$v->uid)->select('name')->get();
                if(count($userInfo)){
                    $v->name = $userInfo[0]['name'];
                }
                else{
                    $v->name = null;
                }

            }
        }
        $view = array(
            'merge'        => $merge,
            'feedbackArr'  => $feedbackListArr,
            'feedbackList' => $feedbackList,
            'id'           => $request->get('id'),
            'user'         => $request->get('user'),
            'status'       => $request->get('status'),
            'paginate'     => $request->get('paginate')

        );
        $this->theme->setTitle('投诉建议列表');
        return $this->theme->scope('manage.feedbacklist', $view)->render();
    }

    
    public function deletefeedback($id){
        $res = FeedbackModel::destroy($id);
        if($res){
            return redirect()->to('/manage/feedbackList')->with(['massage'=>'删除成功！']);
        }
        else{
            return redirect()->to('/manage/feedbackList')->with(['error'=>'删除失败！']);
        }
    }
    

    public function feedbackReplay($id){
        $feedbackDetail = FeedbackModel::find(intval($id));
        if(!$feedbackDetail){
            return redirect()->back()->with(['error'=>'传送参数错误！']);
        }
        $userInfo = UserModel::where('id',$feedbackDetail->uid)->select('name')->first();
        if(count($userInfo)){
            $feedbackDetail->name = $userInfo['name'];
        }
        else{
            $feedbackDetail->name = null;
        }

        $view = [
            'feedbackDetail' => $feedbackDetail,
            'id'             => $id
        ];
        $this->theme->setTitle('反馈投诉建议');
        return $this->theme->scope('manage.feedbackReplay',$view)->render();
    }

    
    public function feedbackUpdate(Request $request){
        $validator = Validator::make($request->all(),[
            'replay' => 'required|max:255'
        ],
        [
            'replay.required' => '请输入投诉建议',
            'replay.max'      => '投诉建议字数超过限制'


        ]);
        if($validator->fails()){
            return redirect()->to('/manage/feedbackList')->withErrors($validator);
        }
        $feedbackDetail = FeedbackModel::find(intval($request->get('id')));
        if(!$feedbackDetail){
            return redirect()->back()->withErrors(['error'=>'传送参数错误！']);
        }
        $newdata = [
            'handle_time' => date('Y-m-d h:i:s',time()),
            'status'      => 2,
            'replay'      => $request->get('replay')
        ];
        $res = $feedbackDetail->update($newdata);
        if($res){

            
            $uid = $request->get('uid');
            $newArr = array(
                'username' => $request->get('username'),
                'content'  => $request->get('replay')
            );
            
            $codeName = 'feedback';
            
            $messageTem = MessageTemplateModel::where('code_name',$codeName)->where('is_open',1)->where('is_on_site',1)->first();
            if(!empty($messageTem)){
                $messageContent = MessageTemplateModel::sendMessage($codeName,$newArr);
                $message = array(
                    'js_id' => $uid,
                    'code_name' => $codeName,
                    'message_title' => '意见反馈处理通知',
                    'message_content' => $messageContent,
                    'message_type' => 1,
                    'receive_time' => date('Y-m-d H:i:s',time()),
                    'status' => 0
                );
                MessageReceiveModel::create($message);
            }

            return redirect('/manage/feedbackList')->with(['massage'=>'修改成功！']);
        }
        else{
            return redirect()->back()->with(['error'=>'修改失败！']);
        }

    }

    
    public function feedbackDetail($id){
        $feedbackDetail = FeedbackModel::find(intval($id));
        if(!$feedbackDetail){
            return redirect()->back()->with(['error'=>'传送参数错误！']);
        }
        $userInfo = UserModel::where('id',$feedbackDetail->uid)->select('name')->first();
        if(count($userInfo)){
            $feedbackDetail->name = $userInfo['name'];
        }
        else{
            $feedbackDetail->name = null;
        }

        $view = [
            'feedbackDetail' => $feedbackDetail
        ];
        return $this->theme->scope('manage.feedbackDetail',$view)->render();
    }



}
