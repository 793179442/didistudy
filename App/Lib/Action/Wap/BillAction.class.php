<?php

/*
	writer:you
	date 2017 7 5
 */

class BillAction extends Action {
	//订单 状态 订单生成
	public function bill_1(){
		$id=trim(I('get.order_id'));
		$this->orderdata=orderdetail($id);
		// var_dump($this->orderdata);
		// exit();
		$this->display();
	}
	//订单 状态 订单支付
	public function bill_2(){
		$this->display();
	}
	//订单 状态 订单完成
	public function bill_3(){
		$this->display();
	}
	//订单 状态 订单取消
	public function bill_4(){
		$this->display();
	}
}


?>