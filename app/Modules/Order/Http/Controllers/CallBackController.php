<?php

namespace App\Modules\Order\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Order\Model\OrderModel;
use App\Modules\Order\Model\ShopOrderModel;
use App\Modules\Shop\Models\GoodsModel;
use Illuminate\Http\Request;
use Omnipay;

class CallBackController extends Controller
{
    
    public function alipayReturn(Request $request)
    {
        $gateway = Omnipay::gateway('alipay');

        $options = [
            'request_params' => $_REQUEST,
        ];

        $response = $gateway->completePurchase($options)->send();

        if ($response->isSuccessful() && $response->isTradeStatusOk()) {
            $data = array(
                'pay_account' => $request->get('buyer_email'),
                'code' => $request->get('out_trade_no'),
                'pay_code' => $request->get('trade_no'),
                'money' => $request->get('total_fee'),
            );

            $type = ShopOrderModel::handleOrderCode($data['code']);

            $this->alipayReturnHandle($type, $data);

        } else {
            
            exit('支付失败');
        }
    }

    
    public function alipayNotify(Request $request)
    {
        $gateway = Omnipay::gateway('alipay');

        $options = [
            'request_params' => $_REQUEST,
        ];

        $response = $gateway->completePurchase($options)->send();

        if ($response->isSuccessful() && $response->isTradeStatusOk()) {
            $data = array(
                'pay_account' => $request->get('buyer_email'),
                'code' => $request->get('out_trade_no'),
                'pay_code' => $request->get('trade_no'),
                'money' => $request->get('total_fee'),
            );

            $type = ShopOrderModel::handleOrderCode($data['code']);

            $this->alipayNotifyHandle($type, $data);

        } else {
            
            exit('支付失败');
        }
    }

    
    public function alipayReturnHandle($type, $data)
    {
        switch ($type){
            case 'cash':
                $res = OrderModel::where('code', $data['code'])->first();
                if (!empty($res) && $res->status == 0) {
                    $orderModel = new OrderModel();
                    $status = $orderModel->recharge('alipay', $data);
                    if ($status) {
                        echo '支付成功';
                        return redirect('finance/cash');
                    }
                }
                break;
            case 'pub task':
                break;
            case 'pub goods':
                $data['pay_type'] = 2;
                $shopOrder = ShopOrderModel::where(['code' => $data['code'], 'status' => 0, 'object_type' => 3])->first();
                if (!empty($shopOrder)){
                    $status = ShopOrderModel::thirdBuyShopService($shopOrder->code, $data);
                    if ($status){
                        
                        echo('支付成功');
                        return redirect('user/waitGoodsHandle/'.$shopOrder->object_id);
                    }
                }
                break;
            case 'pub service':
                break;
            case 'buy goods':
                $data['pay_type'] = 2;
                $res = ShopOrderModel::where(['code'=>$data['code'],'status'=>0,'object_type' => 2])->first();
                if (!empty($res)){
                    $status = ShopOrderModel::thirdBuyGoods($res->code, $data);
                    if ($status) {
                        
                        $goodsInfo = GoodsModel::where('id',$res->object_id)->first();
                        
                        $salesNum = intval($goodsInfo->sales_num + 1);
                        GoodsModel::where('id',$goodsInfo->id)->update(['sales_num' => $salesNum]);
                        echo '支付成功';
                        return redirect('shop/confirm/'.$res->id);
                    }
                }
                break;
            case 'buy service':
                break;
            case 'buy shop service':
                break;
        }
    }

    
    public function wechatNotify()
    {
        
        $arrNotify = \CommonClass::xmlToArray($GLOBALS['HTTP_RAW_POST_DATA']);


        if ($arrNotify['result_code'] == 'SUCCESS' && $arrNotify['return_code'] == 'SUCCESS') {
            $data = array(
                'pay_account' => $arrNotify['openid'],
                'code' => $arrNotify['out_trade_no'],
                'pay_code' => $arrNotify['transaction_id'],
                'money' => $arrNotify['total_fee'] / 100,
            );

            $type = ShopOrderModel::handleOrderCode($data['code']);

            $this->wechatNotifyHandle($type, $data);
        }
    }

    
    public function alipayNotifyHandle($type, $data)
    {
        switch ($type){
            case 'cash':
                $res = OrderModel::where('code', $data['code'])->first();
                if (!empty($res) && $res->status == 0) {
                    $orderModel = new OrderModel();
                    $staus = $orderModel->recharge('alipay', $data);
                    if ($staus) {
                        exit('支付成功');
                    }
                }
                break;
            case 'pub task':
                break;
            case 'pub goods':
                $data['pay_type'] = 2;
                $shopOrder = ShopOrderModel::where(['code' => $data['code'], 'status' => 0, 'object_type' => 3])->first();
                if (!empty($shopOrder)){
                    $status = ShopOrderModel::thirdBuyShopService($shopOrder->code, $data);
                    if ($status){
                        
                        exit('支付成功');
                    }
                }
                break;
            case 'pub service':
                break;
            case 'buy goods':
                $data['pay_type'] = 2;
                $res = ShopOrderModel::where(['code'=>$data['code'],'status'=>0,'object_type' => 2])->first();
                if (!empty($res)){
                    $status = ShopOrderModel::thirdBuyGoods($res->code, $data);
                    if ($status) {
                        
                        $goodsInfo = GoodsModel::where('id',$res->object_id)->first();
                        
                        $salesNum = intval($goodsInfo->sales_num + 1);
                        GoodsModel::where('id',$goodsInfo->id)->update(['sales_num' => $salesNum]);
                        echo '支付成功';
                    }
                }
                break;
            case 'buy service':
                break;
            case 'buy shop service':

                break;
        }
    }

    
    public function wechatNotifyHandle($type, $data)
    {
        $content = '<xml>
                    <return_code><![CDATA[SUCCESS]]></return_code>
                    <return_msg><![CDATA[OK]]></return_msg>
                    </xml>';

        switch ($type){
            case 'cash':
                $res = OrderModel::where('code', $data['code'])->first();
                if (!empty($res) && $res->status == 0) {
                    $orderModel = new OrderModel();
                    $status = $orderModel->recharge('wechat', $data);
                }
                break;
            case 'pub task':
                break;
            case 'pub goods':
                $data['pay_type'] = 3;
                $shopOrder = ShopOrderModel::where(['code' => $data['code'], 'status' => 0, 'object_type' => 3])->first();
                if (!empty($shopOrder)){
                    $status = ShopOrderModel::thirdBuyShopService($shopOrder->code, $data);
                }
                break;
            case 'pub service':
                break;
            case 'buy goods':
                $data['pay_type'] = 3;
                $res = ShopOrderModel::where(['code'=>$data['code'],'status'=>0,'object_type' => 2])->first();
                if (!empty($res)){
                    $status = ShopOrderModel::thirdBuyGoods($res->code, $data);
                    if ($status) {
                        
                        $goodsInfo = GoodsModel::where('id',$res->object_id)->first();
                        
                        $salesNum = intval($goodsInfo->sales_num + 1);
                        GoodsModel::where('id',$goodsInfo->id)->update(['sales_num' => $salesNum]);
                        echo '支付成功';
                    }
                }
                break;
            case 'buy service':
                break;
            case 'buy shop service':

                break;
        }

        if ($status)
            
            return response($content)->header('Content-Type', 'text/xml');
    }


}
