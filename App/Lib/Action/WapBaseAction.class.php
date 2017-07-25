<?php

//前台登录判断控制器
class WapBaseAction extends Action {

    public function __construct() {
        parent::__construct();

        //是否登录
        // if(empty(session('sc_wap_user_id'))){
        //     $this->redirect('Wap/Index/index');
        // 
        $this->userdata=userdata();
    }

    /**
     * 空操作
     * @param type $name 操作名
     */
    public function _empty($name) {
        $this->redirect('Wap/Index/index');
    }

}
