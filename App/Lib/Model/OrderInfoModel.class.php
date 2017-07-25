<?php

class OrderInfoModel extends Model {
    //获取订单数据
    public function getorderdata($id){

    }
    // //提交订单
    // public function ajaxorder(){
    //     if(empty(session('sc_wap_user_id'))){
    //         echo json_encode(array('status' => 0, 'info' => '请登录'));
    //         exit();     
    //     }
    //     if(empty(trim($_POST['order_id']))){
    //         echo json_encode(array('status' => 0, 'info' => '订单失败'));
    //         exit();              
    //     }
    //    $dataS=D('MemberInfo')->find(session('sc_wap_user_id'));
    //    if($dataS['coupon_num']<=0){
    //         echo json_encode(array('status' => 0, 'info' => '优惠券数量不足'));
    //         exit();         
    //    }
    //    //扣优惠券
    //    $data['coupon_num']=$dataS['coupon_num']-1;
    //    $data['status']=1;
    //    $se=D('OrderInfo')->where(array('order_id'=>trim($_POST['order_id'])))->save($data);
    //    if($se){
    //         echo json_encode(array('status' => 1,'info'=>'订单提交成功','url'=>U('Wap/Student/index')));
    //    }else{
    //         echo json_encode(array('status' => 0, 'info' => '提单失败'));
    //    }        
    // }    
}
