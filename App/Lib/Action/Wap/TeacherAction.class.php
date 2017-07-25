<?php
//教师
class TeacherAction extends WapBaseAction {
    
    // public function __construct(){
    //     echo "ffe";
    //     echo session('sc_wap_user_id');
    //     echo __FILE__.'<br>';
    //     echo __SELF__.'<br>';
    //     print_r(C('TMPL_PARSE_STRING')) ;
    //     echo "<a href='Public/Wap/css/mui.css'>aasf</>";
    //     echo "<script>alert();</script>";
    //     exit();
    // }

	public function index() {

		$this->display('teacher_1');
	}
	//订单
	public function teacher_1() {
        //get new order of sutdnent
        $newOrder=D('OrderInfo')->where(array('status'=>0))->order('date desc')->limit(3)->select();

        foreach ($newOrder as $k => $va) {
            $forStuData=D('MemberInfo')->where(array('member_id'=>$va['student_id']))->field('name')->find();
            $newOrder[$k]['student_name']=$forStuData['name'];
        }

        $this->newOrder=$newOrder;

        $data=D('MemberInfo')->where(array('member_id'=>session('sc_wap_user_id')))->field('name')->find();

        //获取最新需求
        $lastDemand=D('DemandOrder')->order('date')->find();
        //获取多条需求
        $MoreDemand=D('DemandOrder')->order('date desc')->limit(4)->select();

        foreach ($MoreDemand as $key => $value) {
            $RE=D('KeyWord')->where(array('key_id'=>$value['key']))->find();
            $MoreDemand[$key]['KeyWord']=$RE['key_name'];
        }
        foreach ($MoreDemand as $k => $v) {
            $arr = explode(',',$v['course_name']);
            foreach ($arr as $keys => $values) {
                if($keys==0){
                    unset($arr[$keys]);
                }
            }
            $MoreDemand[$k]['course_name']=implode(',',$arr);
        }
        //session('lenght',count($MoreDemand));
        $this->MoreDemand=$MoreDemand;

        $this->lastDemand=$lastDemand;

        $this->data=$data;

		$this->display();
	}
    function ajaxUploadcousrseImg(){
        ajaxUploadImgCom(C('UPLOAD_COURSE_TMP_DIR'));
    }
    function ajaxaddteachercourse(){
        if($this->isPost()){

            judgeempty($_POST['course_name']);
            judgeempty($_POST['course_remark']);
            judgeempty($_POST['course_img']);
            judgeempty($_POST['course_type']);
            judgeempty($_POST['course_price']);
            judgeempty($_POST['unit']);

            judgeempty($_POST['feature']);
            $data['feature'] = trim(I('post.feature'));  
            $data['course_name'] = trim(I('post.course_name'));  
            $data['course_remark'] = trim(I('post.course_remark')); 
            $data['course_img'] = trim(I('post.course_img')); 
            $data['course_type'] = trim(I('post.course_types')); 
            $data['course_price'] = trim(I('post.course_price')); 
            $data['unit'] = trim(I('post.unit')); 
            $data['date'] =time() ;  
            $data['teacher_id'] =session('sc_wap_user_id') ; 
            $k=D('Course')->add($data);  
            if($k){
                //添加订阅词
                $s=D('TakeWork')->where(['teacher_id'=>session('sc_wap_user_id')])->find();
                if($s==null){
                        $sdata['take_name']=$data['course_name'];
                        $sdata['teacher_id']=session('sc_wap_user_id');
                        D('TakeWork')->add($sdata);
                }else{
                    $s['take_name']=$s['take_name'].','.$data['course_name'];
                    $sdata['take_name']=$s['take_name'];
                    D('TakeWork')->where(['teacher_id'=>session('sc_wap_user_id')])->save($sdata);
                }
                echo json_encode(array('status' => 1, 'info' => '发布课程成功',url=>U('Wap/Teacher/teacher_3')));  
                 exit(); 
            }else{
                echo json_encode(array('status' => 0, 'info' => "失败"));    
            }    
        }
    }
    //ajax获取更多的学习需求
    public function ajaxGetMoreDemand(){
        if($this->isPost()){
            $datas=D('DemandOrder')->where(array('date'=>array('gt',$_POST['time'])))->order('date desc')->limit(4)->select();
            foreach ($datas as $key => $value) {
                $RE=D('KeyWord')->where(array('key_id'=>$value['key']))->find();
                $datas[$key]['KeyWord']=$RE['key_name'];
            }
            echo json_encode(array('status' => 1, 'data' => $datas));     
            exit();
        }
        //echo json_encode(array('status' => 1, 'info' => '添加成功'));        
    }
	//接单
	public function teacher_2() {
        //get new demand
        $demand_course = $this->demand_course=D('DemandOrder')->find($_GET['id']);
        $arr=explode(',',$demand_course['course_name']);
        foreach ($arr as $k => $v) {
            if($k==0){
                unset($arr[$k]);
            }
        }
        $demand_course['course_name']=implode(',',$arr);
        $student_name=D('MemberInfo')->where(array('member_id'=>$demand_course['student_id']))->field('name')->find();
        $demand_course['student_name']=$student_name['name'];
        //keyword get
        $keydata=D('KeyWord')->find($demand_course['key']);
        $demand_course['key_name']=$keydata['key_name'];
        $this->demand_course=$demand_course;

        //获取最新需求
        $lastDemand=D('DemandOrder')->order('date desc')->find();
        $memberName=D('MemberInfo')->where(array('member_id'=>$lastDemand['student_id']))->find();
        $lastDemand['memberName']=$memberName['name'];
        $se=D('KeyWord')->where(array('key_id'=>$lastDemand['key']))->find();
        $lastDemand['key']=$se['key_name'];
            $ar1=explode(',',$lastDemand['course_name']);
            $ar_new1="";
            foreach ($ar1 as $key2 => $value2) {
                if($key2!=0){
                    $ar_new1.=$value2;
                }
            }
            $lastDemand['course_name']=$ar_new1;        
        //获取老师发布的课程
        $reses=D('Course')->where(array('teacher_id'=>session('sc_wap_user_id')))->order('date desc')->select();

        $this->lastDemand=$lastDemand;
        $this->reses=$reses;
        $this->demanddata=getdemand();
		$this->display();
	}
	//课程发布
	public function teacher_3() {
        $se=D('Course')->where(array('teacher_id'=>session('sc_wap_user_id')))->order('course_id desc')->select();
		$this->CourseData=$se;
        $this->display();
	}
	//关注课程
	public function teacher_4() {
        $id=session('sc_wap_user_id');
        $da=D('MemberInfo')->where(array('member_id'=>$id))->find();
        $ar=explode(',',$da['concern_type']);
        for ($i=0; $i < count($ar) ; $i++) { 
            $ar01=D('CourseType')->where(array('cate_Id'=>$ar[$i]))->find();
            $data[]=$ar01;
        }
        $this->typeData=$data;
        // var_dump($data);exit;
		$this->display();
	}
	//设置模式
	public function teacher_5() {
        $id=session('sc_wap_user_id');
        $da=D('MemberInfo')->where(array('member_id'=>$id))->find();
        $ar=explode(',',$da['self_type']);
        for ($i=0; $i < count($ar) ; $i++) { 
            $ar01=D('CourseType')->where(array('cate_Id'=>$ar[$i]))->find();
            $data[]=$ar01;
        }
        $this->typeset=D('CourseType')->where(array('cate_ParentId'=>0))->select();
        $this->typeData=$data;        
        
		$this->display();
	}
	//增加教师接单分类
	public function ajaxaddteachertype(){
        if($this->isPost()){

            if($_POST['concern_type']=='nocheck'){
                 echo json_encode(array('status' => 0, 'info' => '请选择分类'));
                exit();               
            }
            $data=D('MemberInfo')->where(array('member_id'=>session('sc_wap_user_id')))->find();
            if(empty($data['self_type'])){
                $savedata['self_type']=$_POST['concern_type'];
            }else{
                $savedata['self_type']=$data['self_type'].','.$_POST['concern_type'];
            }
            if($_POST['id']){
                $ar=explode(',',$data['self_type']);
                foreach ($ar as $key => $value) {
                    if($value==$_POST['id']){
                        $ar[$key]=$_POST['concern_type'];
                    }
                }
                $savedata['self_type']=implode(',', $ar);
                $re=D('MemberInfo')->where(array('member_id'=>session('sc_wap_user_id')))->save($savedata);
            }else{
                $re=D('MemberInfo')->where(array('member_id'=>session('sc_wap_user_id')))->save($savedata);
            }
            
            if($re){
                echo json_encode(array('status' => 1, 'info' => '添加成功'));
            }
        }
	}
	//增加教师
    public function ajaxaddteacher() {
        if ($this->isPost()) {

            if(empty($_POST['teacher_name'])){
                echo json_encode(array('status' => 0, 'info' => '请输入真实姓名'));
                exit();
            }
            if(empty($_POST['certificates_number'])){
                echo json_encode(array('status' => 0, 'info' => '请输入证件号码'));
                exit();
            }
            if(!isset($_POST['sex'])){
                echo json_encode(array('status' => 0, 'info' => '请选择性别'));
                exit();
            }
            if(empty($_POST['certificates_phone1'])){
                echo json_encode(array('status' => 0, 'info' => '请选择证件照正面1'));
                exit();
            }
            if(empty($_POST['certificates_phone2'])){
                echo json_encode(array('status' => 0, 'info' => '请选择证件照背面'));
                exit();
            }
            $data = array();
            //证件照正面
            $img_src = trim(I('post.certificates_phone1'));

            if (strlen($img_src) > 0) {
                $tmp_dir = C('UPLOAD_CERTIFICATES1_TMP_DIR');
                $admin_id = session('sc_wap_user_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $img_src;
                if (is_file($tmp_src)) {
                    $data['certificates_phone1'] = $img_src;
                }
            }

            //证件照反面
            $img_src2 = trim(I('post.certificates_phone2'));

            if (strlen($img_src2) > 0) {
                $tmp_dir = C('UPLOAD_CERTIFICATES2_TMP_DIR');
                $admin_id = session('sc_wap_user_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src2 = $tmp_dir . '/' . $img_src2;
                if (is_file($tmp_src2)) {
                    $data['certificates_phone2'] = $img_src2;
                }
            }

            $data['teacher_name']=trim(I('post.teacher_name'));
            //排序
            $data['certificates_number']=trim(I('post.certificates_number'));
    
            $re = D('Teacher')->add($data);



            if ($re) {                
                    $dir = C('UPLOAD_CERTIFICATES1_IMG_DIR') . '/' . $img_src;
                    rename($tmp_src, $dir);
                    $dir2 = C('UPLOAD_CERTIFICATES2_TMP_DIR') . '/' . $img_src2;
                    rename($tmp_src2, $dir2);
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Wap/Student/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '添加失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }
     /**
     * 上传图片 身份证正面
     */
    public function ajaxUploadImg() {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_CERTIFICATES1_TMP_DIR');
            if (strlen($sc_dir) == 0) {
                echo json_encode(array('status' => 0, 'info' => '上传失败'));
                exit();
            }

            $admin_id = session('sc_wap_user_id');
            $sc_dir = str_replace('$admin_id', $admin_id, $sc_dir);
            $dir_array = explode('/', $sc_dir);

            $dir_str = $dir_array[0];
            for ($i = 0; $i < count($dir_array); $i++) {
                if (!is_dir($dir_str)) {
                    mkdir($dir_str);
                }
                $dir = $dir_array[$i + 1];
                $dir_str = $dir_str . "/" . $dir;
            }
            $type = $_FILES["rq_img"]["type"];

            if ($type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif') {
                echo json_encode(array('status' => 0, 'info' => '图片必须为（jpg,jpeg,png,gif）的类型'));
                exit();
            }

            $size = $_FILES["rq_img"]["size"];

            if ($size > 2 * 1024 * 1024) {
                echo json_encode(array('status' => 0, 'info' => '图片大小不能大于2M'));
                exit();
            }


            $org = $_FILES["rq_img"]["name"];
            $ext_array = explode('.', $org);
            $ext = strtolower($ext_array[count($ext_array) - 1]);

            $name = "";
            $i = 0;
            while ($i <= 10) {
                $name = $name . rand(0, 9);
                $i++;
            }
            $name = date("YmdHis", time()) . $name;

            $filename = $dir_str . md5($name) . '.' . $ext;

            $re = move_uploaded_file($_FILES["rq_img"]["tmp_name"], $filename);

            if ($re) {
                echo json_encode(array('status' => 1, 'tmp_src'=>$filename,'img_src' => md5($name) . '.' . $ext));
            } else {
                echo json_encode(array('status' => 0, 'info' => '上传失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '上传失败'));
        }
    }
     /**
     * 上传图片 身份证反面
     */
    public function ajaxUploadImg2() {
        if (array_key_exists("rq_img2", $_FILES) && $_FILES["rq_img2"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_CERTIFICATES2_TMP_DIR');
            if (strlen($sc_dir) == 0) {
                echo json_encode(array('status' => 0, 'info' => '上传失败'));
                exit();
            }

            $admin_id = session('by_p_admin_id');
            $sc_dir = str_replace('$admin_id', $admin_id, $sc_dir);
            $dir_array = explode('/', $sc_dir);

            $dir_str = $dir_array[0];
            for ($i = 0; $i < count($dir_array); $i++) {
                if (!is_dir($dir_str)) {
                    mkdir($dir_str);
                }
                $dir = $dir_array[$i + 1];
                $dir_str = $dir_str . "/" . $dir;
            }
            $type = $_FILES["rq_img2"]["type"];

            if ($type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif') {
                echo json_encode(array('status' => 0, 'info' => '图片必须为（jpg,jpeg,png,gif）的类型'));
                exit();
            }

            $size = $_FILES["rq_img2"]["size"];

            if ($size > 2 * 1024 * 1024) {
                echo json_encode(array('status' => 0, 'info' => '图片大小不能大于2M'));
                exit();
            }


            $org = $_FILES["rq_img2"]["name"];
            $ext_array = explode('.', $org);
            $ext = strtolower($ext_array[count($ext_array) - 1]);

            $name = "";
            $i = 0;
            while ($i <= 10) {
                $name = $name . rand(0, 9);
                $i++;
            }
            $name = date("YmdHis", time()) . $name;

            $filename = $dir_str . md5($name) . '.' . $ext;

            $re = move_uploaded_file($_FILES["rq_img2"]["tmp_name"], $filename);

            if ($re) {
                echo json_encode(array('status' => 1,'tmp_src'=>$filename, 'img_src' => md5($name) . '.' . $ext));
            } else {
                echo json_encode(array('status' => 0, 'info' => '上传失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '上传失败'));
        }
    }
    public function getCourseOrder(){
        //$id equal demand id;
        $id=trim($_POST['id']);
        if(empty($id)){
            echo json_encode(array('status' => 0, 'info' => '接单失败'));
            exit();
        }
        $data['demand_id']=$id;
        //check member is login
        $user_id=session('sc_wap_user_id');
        if(empty($user_id)){
            echo json_encode(array('status' => 0, 'info' => '接单失败'));
            exit();            
        }
        //member is teacher_type;
         $data['teacher_id']=$user_id;
         //save create order time
         $data['date']=time();

         $se=D('DemandOrder')->where(array('demand_id'=>$id))->find();
         //save student id from demand table 
         $data['student_id']=$se['student_id'];
         $typeid=trim(I('post.typeid'));
         $typeid=explode(',',$typeid);
            unset($typeid[0]);
            //add data category course id from submit course data 
            foreach ($typeid as $key => $value) {
                $data['course_id']=$value;
                $re=D('OrderInfo')->add($data);
            }
        
         if($re){
                echo json_encode(array('status' => 1, 'info' => '接单成功', 'url' => U('Wap/Teacher/teacher_1')));

         }else{
                echo json_encode(array('status' => 0, 'info' => '接单失败3'));
        }
    }
    public function order(){
        $historyOrder=D('OrderInfo')->where(array('teacher_id'=>session('sc_wap_user_id')))->order('date desc')->limit(6)->select();

        foreach ($historyOrder as $key => $value) {

            $getDemandName=D('DemandOrder')->where(array('demand_id'=>$value['demand_id']))->find();
            $teacher=D('MemberInfo')->find($value['teacher_id']);
            $historyOrder[$key]['teacher_name']=$teacher['name'];
            $ar=explode(',',$getDemandName['course_name']);
            $ar_new="";
            foreach ($ar as $key1 => $value2) {
                if($key1!=0){
                    $ar_new.=$value2;
                }
            }
            $historyOrder[$key]['demandName']=$ar_new;


            if($value['status']==0){
                $historyOrder[$key]['status']="支付";
            }else if($value['status']==1){
                $historyOrder[$key]['status']="以支付";
            }else{
                $historyOrder[$key]['status']="完成";
            }
        }

        $this->historyOrder=$historyOrder;        
        $this->display();
    }

}


?>