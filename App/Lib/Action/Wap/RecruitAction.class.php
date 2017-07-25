<?php

//招募

class RecruitAction extends Action {

	public function index() {

		$this->display('index_login');
	}

	//机构
	public function  organization(){

		$this->display();
	}

	//老师招募
	public function  TeacherRecruit(){

		$this->display();
	}
	//添加机构
    public function ajaxaddorganizition() {
        if ($this->isPost()) {
            $data = array();
            if(empty($_POST['organizition_name'])){
                echo json_encode(array('status' => 0, 'info' => '请输入机构名称'));
                exit();
            }
            $data['organizition_name']=trim($_POST['organizition_name']);
            if(empty($_POST['organizition_number'])){
                echo json_encode(array('status' => 0, 'info' => '请输入营业证号'));
                exit();
            }
            $data['organizition_number']=trim($_POST['organizition_number']);
            if(empty($_POST['organizition_address'])){
                echo json_encode(array('status' => 0, 'info' => '请输入地址'));
                exit();
            }
            $data['organizition_address']=trim($_POST['organizition_address']);
            if(empty($_POST['organizition_person'])){
                echo json_encode(array('status' => 0, 'info' => '请输入联系人'));
                exit();
            }
            $data['organizition_person']=trim($_POST['organizition_person']);

            if(empty($_POST['organizition_range'])){
                echo json_encode(array('status' => 0, 'info' => '请输入经营范围'));
                exit();
            }
            $data['organizition_range']=trim($_POST['organizition_range']);

            if(empty($_POST['organizition_img'])){
                echo json_encode(array('status' => 0, 'info' => '请选择营业执照'));
                exit();
            }
            $img_src=trim($_POST['organizition_img']);
            $data['organizition_img']=$img_src;
            if (strlen($img_src) > 0) {
                $tmp_dir = C('UPLOAD_ORGANIZITION_TMP_DIR');
                $admin_id = session('sc_wap_user_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $img_src;
                if (is_file($tmp_src)) {
                    $data['organizition_img'] = $img_src;
                }
            }
            $data['member_id']=session('sc_wap_user_id');
            $re = D('OrganizationInfo')->add($data);

            if ($re) {                
                    $dir = C('UPLOAD_ORGANIZITION_IMG_DIR') . '/' . $img_src;
                    rename($tmp_src, $dir);
                    // $dir2 = C('UPLOAD_CERTIFICATES2_TMP_DIR') . '/' . $img_src2;
                    // rename($tmp_src2, $dir);
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Wap/Student/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '添加失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }	
     /**
     * 上传机构图片
     */
    public function ajaxUploadImg() {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_ORGANIZITION_TMP_DIR');
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
}


?>