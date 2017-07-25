<?php
//订单控制器
class OrderAction extends WapBaseAction {
    public function order_1(){
        if(session('sc_wap_user_id')==null){
            $this->redirect(U('Wap/Index/login'));exit();
        }
        $this->display();
    }
    public function order_2(){
        //获取学生发布的需求信息
        $data1=studentdemandStatus1();
        $this->studentData1=$data1;
        $data2=studentdemandStatus2();
        $this->studentData2=$data2;
        $this->display();
    }
    public function order_3(){
        $this->display();
    }
    public function order_4(){
        $this->display();
    }
    public function order_5(){
        $this->display();
    }
}


?>