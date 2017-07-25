<?php

//课程

class AddCourseAction extends Action {


	//课程发布
	public function addCourse() {

		$this->display();
	}
    //课程1
    public function course_1() {
        //get course data
        $courseData=D('Course')->find($_GET['course_id']);
        $this->courseData=$courseData;
        $this->display();
    }
    //课程2
    public function course_2() {

        $this->display();
    }
	//增加课程
    public function ajaxaddcourse() {
        if ($this->isPost()) {
            $data = array();
            // if(empty(session('sc_wap_user_id'))){
            //     echo json_encode(array('status' => 0, 'info' => '请先登录','url'=>U('Wap/Index/index')));
            //    // $this->redirect(U('Wap/Index/index'));
            //     exit();
            // }
            $data['teacher_id']=session('sc_wap_user_id');
            if(empty($_POST['course_name'])){
                echo json_encode(array('status' => 0, 'info' => '请输入课程名称'));
                exit();
            }
            $data['course_name']=trim($_POST['course_name']);
            if(empty($_POST['remark'])){
                echo json_encode(array('status' => 0, 'info' => '请输入课程介绍'));
                exit();
            }
            $data['remark']=trim($_POST['remark']);
            if(!is_numeric($_POST['course_price'])){
                echo json_encode(array('status' => 0, 'info' => '请输入课程收费价格(价格)'));
                exit();
            }
            $data['course_price']=trim($_POST['course_price']);
            if(empty($_POST['course_img'])){
                echo json_encode(array('status' => 0, 'info' => '请选择课程图片'));
                exit();
            }
            $data['course_img']=trim($_POST['course_img']);


            if (strlen($img_src) > 0) {
                $tmp_dir = C('UPLOAD_COURSE_TMP_DIR');
                $admin_id = session('by_p_admin_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $img_src;
                if (is_file($tmp_src)) {
                    $data['course_img'] = $img_src;
                }
            }
            $data['date']=time();
            $re = D('Course')->add($data);

            if ($re) {                
                    $dir = C('UPLOAD_COURSE_IMG_DIR') . '/' . $img_src;
                    rename($tmp_src, $dir);
                    // $dir2 = C('UPLOAD_CERTIFICATES2_TMP_DIR') . '/' . $img_src2;
                    // rename($tmp_src2, $dir);
                echo json_encode(array('status' => 1, 'info' => '课程发布成功', 'url' => U('Wap/Teacher/teacher_3')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '添加失败'));
            } 
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }
     /**
     * 上传课程图片
     */
    public function ajaxUploadImg() {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_COURSE_TMP_DIR');
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
                echo json_encode(array('status' => 1,'tmp_src'=>$filename, 'img_src' => md5($name) . '.' . $ext));
            } else {
                echo json_encode(array('status' => 0, 'info' => '上传失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '上传失败'));
        }
    }

    //提交订单
    public function order(){
        $order=D('OrderInfo')->find($_GET['order_id']);
        
        $courseData=D('Course')->find($order['course_id']);
     
        $this->courseData=$courseData;
        $this->display();
    }
    //处理订单
    public function ajaxorder(){
            D('OrderInfo')->ajaxorder();

    }
}


?>