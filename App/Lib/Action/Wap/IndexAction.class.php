<?php
//登录注册控制器
class IndexAction extends Action {
    //new 
    public function login(){
        if($_GET['teacher']==1){
            session('teacher',1);
        }
        $this->display();
    }
    //new 
    public function registered(){
        $this->display();
    }    
    //ajaxregisterd
    //new 
    public function ajaxregisterd(){
       judgeempty($_POST['name']);
       judgeempty($_POST['pwd']);
      $fe= D('MemberInfo')->where(array('name'=>$_POST['name']))->find();
      if($fe){
        echo json_encode(array('status' => 0, 'info' => '账号已经注册'));
        exit();
      }else{
        $se=D('MemberInfo')->add(array('name'=>$_POST['name'],'member_password'=>md5($_POST['pwd'])));
            if($se){
                echo json_encode(array('status' => 1, 'info' => '注册成功','url'=>U('Wap/Order/order_1')));
            }else{
                echo json_encode(array('status' => 0, 'info' => '注册失败'));
            }
      }
    } 
    //ajaxloginf
    //new 
    public function ajaxloginf(){
       judgeempty($_POST['name']);
       judgeempty($_POST['pwd']);
      $fe= D('MemberInfo')->where(array('name'=>$_POST['name'],'member_password'=>md5($_POST['pwd'])))->find();
      if($fe){
        if($fe['member_type']==1){
            cookie('sc_wap_user_id',$fe['member_id'],48*3600);
            session("sc_wap_user_id",$fe['member_id']);
            echo json_encode(array('status' => 1, 'info' => '登录成功 正在跳转..',"url"=>U('Wap/Teacher/teacher_2')));
        }else{
        echo json_encode(array('status' => 1, 'info' => '登录成功 正在跳转..',"url"=>U('Wap/Order/order_2')));
        }
        cookie('sc_wap_user_id',$fe['member_id'],48*3600);
        session("sc_wap_user_id",$fe['member_id']);
        exit();
      }else{
        echo json_encode(array('status' => 0, 'info' => '账号或密码错误'));
      }
    }          
	public function index() {
        if(is_login()==true){
            $this->redirect(U("Wap/Student/Index"));
        }
	 $this->display();
	}
	public function Index_login(){

		$this->display();
	}
    //teacher login 
    public function ajaxteacherlogin(){

       $teacertype= D('MemberInfo')->find(session('sc_wap_user_id'));
       if($teacertype['member_type']==1){
            $this->redirect(U('Wap/Teacher/teacher_1'));
       }else{
            $this->redirect(U('Wap/Index/addteacherinfo'));
       }
    }

    public function ajaxLogin() {
        if ($this->isPost()) {

            $user_name = trim(I('post.sc_user_name'));

            $user_pwd = trim(I('post.sc_user_pwd'));

            $referurl = urldecode(trim(I('post.referurl')));
            $referurl =U('Wap/Student/index');
            $member = D('MemberInfo')->where(array('phone_number' => $user_name, 'member_password' => md5($user_pwd)))->find();

            if (empty($member)) {
                echo json_encode(array('status' => 0, 'info' => '用户名或密码错误'));
            } else {
                session('sc_wap_user_id', $member['member_id']);
                // cookie('sc_user_name', $user_name, 3600 * 24 * 365);
                // cookie('sc_user_pwd', md5($user_pwd), 3600 * 24 * 365);
                if(cookie('is_teacher')==1){
                    if($member['member_type']!=1){
                        session('is_teacher','2');
                        echo json_encode(array('status' => 0, 'info' => '该账号不是老师请注册！','url'=>U('Wap/Index/addteacherinfo')));
                        exit();
                    }
                     session('is_teacher','1');
                    $referurl=U('Wap/Teacher/teacher_1');
                }
                echo json_encode(array('status' => 1, 'info' => '登录成功', 'url' => $referurl));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

	/**
     * 注册
     */
    public function Index_register() {
    	$this->referurl=urlencode($_SERVER['HTTP_REFERER']);
    	$this->display();
    }

    /**
     * 退出
     */
    public function logout() {
        session('sc_wap_user_id', null);
        session('teacher',null);
        cookie('sc_wap_user_id',null);
        $this->redirect("Wap/Student/index");
        
    }
    public function ajaxRegister() {
        if ($this->isPost()) {

            //手机号码
            $phone_number = trim(I('post.sc_phone'));

            if (strlen($phone_number) == 0) {
                echo json_encode(array('status' => 0, 'info' => '手机号码不能为空'));
                exit();
            }
            $data['phone_number'] = $phone_number;
			$re = D('MemberInfo')->where(array('phone_number'=>$phone_number))->find();
			if($re){
            	$this->error('该手机号码已注册');
				exit();
			}

            $name = trim(I('post.name'));
            if (strlen($name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '姓名不能空'));
                exit();
            }
            $data['name'] = $name;

            $sex = trim(I('post.sex'));
            if (strlen($sex) == 0) {
                echo json_encode(array('status' => 0, 'info' => '性别不能空'));
                exit();
            }
            $data['sex'] = md5($sex);

            $member_password = trim(I('post.sc_password'));
            if (strlen($member_password) == 0) {
                echo json_encode(array('status' => 0, 'info' => '密码不能空'));
                exit();
            }
            if (strlen($member_password) < 6 || strlen($member_password) > 16) {
                echo json_encode(array('status' => 0, 'info' => '密码长度为6-16位'));
                exit();
            }
            $re_member_password = trim(I('post.sc_re_password'));
            if ($re_member_password != $member_password) {
                echo json_encode(array('status' => 0, 'info' => '确认密码与密码不一致'));
                exit();
            }
            $data['member_password'] = md5($member_password);

            $referurl = urldecode(trim(I('post.referurl')));
			

            $data['create_time'] = time();

            $re = D('MemberInfo')->add($data);

            if ($re) {

                session('sc_wap_user_id', $re);
                if(cookie('is_teacher')==1){
                    $referurl=U('Wap/Index/addteacherinfo',array('member_id'=>$re));
                }
                echo json_encode(array('status' => 1, 'info' => '注册成功', 'url' => $referurl));
            } else {
                echo json_encode(array('status' => 0, 'info' => '注册失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }	
    public function addteacherinfo(){
       $this->typedata=D('CourseType')->where(array('cate_ParentId'=>0))->select();
      
        $this->display();
    }
    public function getchildtype(){
        $childtype=D('CourseType')->where(array('cate_ParentId'=>$_GET['parent_id']))->select();
        if($childtype){
            echo json_encode(array('status' => 1, 'childtypedata' => $childtype));
        }else{
            echo json_encode(array('status' => 0, 'childtypedata' => $childtype));
        }
    }
    public function ajaxaddteacherinfo(){
        if($this->isPost()){
            $member_id=session('sc_wap_user_id');
            if(empty($member_id)){
                echo json_encode(array('status' => 0, 'info' => '注册失败'));
                exit();
            }
            $member=D('MemberInfo')->where(array('member_id'=>$member_id))->find();
            if(empty($member)) {
                echo json_encode(array('status' => 0, 'info' => '注册失败'));
                exit();                
            }
            $name=trim(I('post.name'));
            if(empty($name)){
                echo json_encode(array('status' => 0, 'info' => '名称不能为空'));
                exit();
            }
            $data['name']=$name;
            $member_type=trim(I('post.member_type'));
            if(empty($member_type)){
                echo json_encode(array('status' => 0, 'info' => '请选择老师或者机构！'));
                exit();
            }
            $data['member_type']=$member_type;
            $remark=trim(I('post.remark'));
            if(empty($remark)){
                echo json_encode(array('status' => 0, 'info' => '请填写简介！'));
                exit();
            }
            $data['remark']=$remark;


            $data['self_type']=$self_type;
            $re=D('MemberInfo')->where(array('member_id'=>session('sc_wap_user_id')))->save($data);
            if($re){
                echo json_encode(array('status' => 1, 'info' => '注册成功!','url'=>U('Wap/Teacher/teacher_1')));
                exit();
            }

        }
    }
}


?>