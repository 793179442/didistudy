<?php

//学生
//author shuang
class StudentAction extends WapBaseAction {
	//选择是学生端还是老师端
	public function checkmembertype(){
		$this->display("index");
	}

	public function index() {
		
		
		//Index index jump to student console set tag cookie teacher_tag true judge show button 
        if($_GET['teacher_tag']==1){
            cookie('is_teacher', 1, 3600 * 24 * 365);
        }else{
            cookie('is_teacher', 0, 3600 * 24 * 365);
        }
        //haven login
		$id=session('sc_wap_user_id');

		//student demand
		$demand_data=D('DemandOrder')->where(array('student_id'=>$id))->select();

		foreach ($demand_data as $key => $value) {
			$arr=explode(',',$value['course_name']);
		
			foreach ($arr as $ke => $va) {
				if($ke==0){
					unset($arr[$ke]);
				}
			}
			$demand_data[$key]['course_name']=implode(',',$arr);
		}
		$this->demand_data=$demand_data;

		$levelOnetype=D('CourseType')->where(array('cate_ParentId'=>0))->limit(4)->select();
		$member_id=session('sc_wap_user_id');
		$member_data=D('MemberInfo')->where(array('member_id' => $member_id ))->find();

		$this->levelOnetype=$levelOnetype;

		$this->member_data=$member_data;
		$teacher_type=D('MemberInfo')->where(array('member_id'=>session('sc_wap_user_id')))->find();
		if($teacher_type['member_type']==1){
			$this->isteacher=true;
		}

		$this->display('student_1');
	}
	public function student_2(){
		//get demand id
		$demand_id=trim(I('get.demand_id'));
		//get demand data from demand table
		$demanddata=D('DemandOrder')->find($demand_id);
		//key word get
		$keyword=D('KeyWord')->find($demanddata['key']);
		$demanddata['keyword']=$keyword['key_name'];
		//assgin html demand data
		$this->demanddata=$demanddata;


		//get teacher order
		$teachergetorderdata=D('OrderInfo')->where(array('demand_id'=>$demand_id,'status'=>0))->select();
		foreach ($teachergetorderdata as $key => $value) {
			$teacherdata=D('MemberInfo')->find($value['teacher_id']);
			$teachergetorderdata[$key]['teacher_name']=$teacherdata['name'];
		}
		$this->teachergetorderdata=$teachergetorderdata;

		

		$member_id=session('sc_wap_user_id');
		$member_data=D('MemberInfo')->where(array('member_id' => $member_id ))->find();

		$demand=D('DemandOrder')->where(array('student_id'=>$member_id))->order('date desc')->find();
		$deArr=explode(',',$demand['course_name']);
		$str='';
		for ($i=1; $i <count($deArr) ; $i++) { 
			$str.=$deArr[$i];
		}
		$demand['course_name']=$str;
		$this->keyword=D('KeyWord')->where(array('key_id'=>$demand['key']))->find();
		$this->member_data=$member_data;
		$this->demand=$demand;
		$this->display();
	}
	//消息处理
	public function messagedetail(){
		$message_data=D('StudentMessage')->where(array('student_id'=>session('student_id')))->select();
		$this->message_data=$message_data;
	}
	//消息回复
	public function sendmessage(){
		
	}
	// 发布课程需求
	public function studydemand(){
		//学生id
		$student_id = session('student_id');
		$this->student_id=$student_id;
		$this->display('studydemand');
	}
	public function ajaxstudydemand(){
		$student_id = session('sc_wap_user_id');
		if(empty($student_id)){
			echo json_encode(array('status' => 3, 'info' => '请先登录','url'=>U('Wap/Index/Index_login')));
            exit();		
		}
		//课程名
		$course_name=trim(I('post.course_name'));
		if(empty($course_name)){
            echo json_encode(array('status' => 0, 'info' => '请输入课程名'));
            exit();			
		}
		$data['course_name']=$course_name;
		//课程类型 例如课内辅导
		$course_type=trim(I('post.course_type'));
		if(empty($course_type)){
            echo json_encode(array('status' => 0, 'info' => '请选择课程类型'));
            exit();			
		}
		$data['course_type']=$course_type;		
		//需求条件
		$course_key=trim(I('post.course_key'));
		if(empty($course_key)){
            echo json_encode(array('status' => 0, 'info' => '请选择需求条件'));
            exit();			
		}
		$data['course_key']=$course_key;
		//发布类型
		$course_public_type=trim(I('post.course_public_type'));
		if(empty($course_public_type)){
            echo json_encode(array('status' => 0, 'info' => '请选择发布类型'));
            exit();			
		}
		$data['course_public_type']	= $course_public_type;	
		//发布者名称
		$username=trim(I('post.username'));
		if(empty($username)){
            echo json_encode(array('status' => 0, 'info' => '请输入发布者名称'));
            exit();			
		}
		$data['username']	= $username;	
		//添加
		$re=D('Student')->where(array('student_id'=>$student_id))->save($data);	
		if($re){
			$url=U('Wap/Student/studydemand');
			echo json_encode(array('status' => 1, 'info' => '发布成功','url'=>$url));
			exit();
		}else{
            echo json_encode(array('status' => 0, 'info' => '发布失败'));
            exit();				
		}
	}

	public function  student_3(){
		
		$member_id=session('sc_wap_user_id');
		$member_data=D('MemberInfo')->where(array('member_id' => $member_id ))->find();
		$this->member_data=$member_data;


		$this->keyword=D('KeyWord')->select();
		$data=D('CourseType')->where(array('cate_Id'=>47))->find();
		$data1=D('CourseType')->where(array('cate_ParentId'=>47))->select();
		$data2=D('CourseType')->where(array('cate_ParentId'=>$data1['0']['cate_Id']))->select();
		$data3=D('CourseType')->where(array('cate_ParentId'=>$data2['0']['cate_Id']))->select();
		$this->data=$data;
		$this->data1=$data1;
		$this->data2=$data2;
		$this->data3=$data3;
		$this->display();
	}
	public function publicdemand(){
	if($this->isPost()){
		$login_id=session('sc_wap_user_id');
		if(empty($login_id)){
			echo json_encode(array('status' => 3, 'info' => '请先登录','url'=>U('Wap/Index/Index_login')));
            exit();					
		}
		// $radio=trim(I('post.radio'));
		// if(empty($radio)){
		// 	echo json_encode(array('status' => 0, 'info' => '请选择关键词'));
		// 	exit();
		// }
		// $data['key']=$radio;
		$remark=trim(I('post.remark'));
		if(empty($remark)){
			echo json_encode(array('status' => 0, 'info' => '请填写备注资料'));
			exit();
		}
		$data['remark']=$remark;
		$se=trim(I('post.se'));
		if(empty($se)){
			echo json_encode(array('status' => 0, 'info' => '请选择课程'));
			exit();
		}
		$data['course_name']=$se;
		// $status=trim(I('post.status'));
		 //echo json_encode(array('status' => 0, 'info' => $_POST['radio']));
		 //exit();		
		 }	
		 // $data['status']=$status;
		 //	
		 $data['student_id']=session('sc_wap_user_id');
		 $data['date']=time();
		//发布者名称
		// $username=trim(I('post.username'));
		// if(empty($username)){
  //           echo json_encode(array('status' => 0, 'info' => '请输入发布者名称'));
  //           exit();			
		// }
		// $data['username']	= $username;	
		$re = D('DemandOrder')->add($data);
		if($re){
			echo json_encode(array('status' => 1, 'info' => '发布成功','url'=>U('Wap/Order/order_2')));
		 	exit();		
		}
	}
	public function checklogin(){
		if(is_login()){
			echo json_encode(array('status' => 1));
		 	exit();				
		}else{
			echo json_encode(array('status' => 0, 'info' => '请先登录','url'=>U('Wap/Student/checkmembertype')));
			exit();			
		}
	}
}


?>