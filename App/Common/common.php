<?php
    //去除字符串第一个，前的元素
    function deletechar($str)
    {
        $arr=explode(",",$str);
        unset($arr[0]);
        return implode(",",$arr);
    }
    //判断用户是否登录
    function is_login()
    {
        if(session('sc_wap_user_id')>0||cookie('sc_wap_user_id')>1){
            session('sc_wap_user_id',cookie('sc_wap_user_id'));
            return true;
        }else{
            return false;
        }
    }
    //数据类型判断 $data 要判断的数据 $i 判断的类型 $str 返回的数据
    function judgeempty($data){
        
            if(empty($data)){
                echo json_encode(array('status' => 0, 'info' => '请输入正确的数据'));
                exit();
            }
        
    }
    //短信系统
    function  messageSystem($send,$get){

    }
    //订单详情
    function orderdetail($id)
    {
        $data=D('OrderInfo')->find($id);
        $demand=D('DemandOrder')->find($data['demand_id']);
        $student=D('MemberInfo')->find($data['student_id']);
        $data['course_name']=deletechar($demand['course_name']);
        $data['student_name']=$student['name'];
        return $data;
    }
    //用户订单
    function memberorder(){
        $data=D('OrderInfo')->where(array('student_id'=>session('sc_wap_user_id')))->order('date desc')->select();
        foreach ($data as $key => $value) {
            $demand=D('DemandOrder')->find($value['demand_id']);
            $data[$key]['course_name']=deletechar($demand['course_name']);

            $student=D('MemberInfo')->find($value['student_id']);
            $data[$key]['student_name']=$student['name'];
            switch ($value['status']) {
                case 0:
                   $data[$key]['status']="未付款";
                    break;
                case 1:
                   $data[$key]['status']="已付款";
                    break;
                case 2:
                   $data[$key]['status']="已完成";
                    break;                    
                default:
                    # code...
                    break;
            }
        }
        return $data;        
    }
    //获取学生需求
    function studentdemandStatus1()
    {
        $data=D('DemandOrder')->where(['student_id]'=>session('sc_wap_user_id'),'status'=>1])->order('date desc')->select();
        return $data;
    }
    //获取学生需求 已经有老师接单
    function studentdemandStatus2()
    {
        $data=D('DemandOrder')->where(['student_id]'=>session('sc_wap_user_id'),'status'=>2])->order('date desc')->select();
        return $data;
    }
    //获取登录用户数据
    function userdata()
    {
        $fe=D('MemberInfo')->find(session('sc_wap_user_id'));
        if($fe){
            $fe['img_head']=C('UPLOAD_USER_HEAD_DIR').'/'.$fe['img_head'];
        }
        return $fe;
    }
    //注册
    function register($data){
        $get=D('MemberInfo')->where(array('name'=>$data['name']))->find();
        if($get){
            return false;
        }else{
            $get2=D('MemberInfo')->save($data);
            if($get2){
                return true;
            }else{
                return false;
            }
        }
    }
    //获取课程分类
    function getcoursetype(){

    }
    //获取所有需求
    function  getdemand(){
        $se = D('DemandOrder')->select();
        return $se;
    }
    //获取发布课程信息
    function getallcourseinfo($id){
        return D('Course')->where(array('teacher_id'=>$id))->select();
    }
    
     /**
     * 上传图片
     */
     function ajaxUploadImgCom($tmp_dir_type) {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = $tmp_dir_type;
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
                echo json_encode(array('status' => 1,'tmp_dir'=>$filename, 'img_src' => md5($name) . '.' . $ext));
            } else {
                echo json_encode(array('status' => 0, 'info' => '上传失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '上传失败'));
        }
    }
   ?>