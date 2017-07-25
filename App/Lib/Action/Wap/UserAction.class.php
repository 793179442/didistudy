<?php
//用户
class UserAction extends Action {

	public function user() {

		$this->display();
	}
//UserInformation
	public function UserInformation() {
		judgeempty($_POST['name']);
		judgeempty($_POST['aboutme']);
		judgeempty($_POST['company']);
		judgeempty($_POST['profession']);
		judgeempty($_POST['region']);
		judgeempty($_POST['Birthday']);
		judgeempty($_POST['img_head']);
		$data['name']=I('post.name');
		$data['aboutme']=I('post.aboutme');
		$data['company']=I('post.company');
		$data['profession']=I('post.profession');
		$data['region']=I('post.region');
		$data['Birthday']=I('post.Birthday');
		$img_src=I('post.img_head');
        if (strlen($img_src) > 0) {
                $tmp_dir = C('UPLOAD_USER_HEAD_TMP_DIR');
                $admin_id = session('sc_wap_user_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $img_src;
                if (is_file($tmp_src)) {
                    $data['img_head'] = $img_src;
                }
        }
		$se=D('MemberInfo')->where(array('member_id'=>session('sc_wap_user_id')))->save($data);
		if($se){
			 $dir = C('UPLOAD_USER_HEAD_DIR') . '/' . $img_src;
             rename($tmp_src, $dir);
			echo json_encode(array('status'=>1,'info'=>'保存成功!'));
		}else{
			echo json_encode(array('status'=>0,'info'=>'保存失败 请输入正确的数据!'));
		}
	}
	public function ajaxUploadImg(){
		ajaxUploadImgCom(C('UPLOAD_USER_HEAD_TMP_DIR'));
	}
	//我的课程
	public function user_1() {

		$this->data=userdata();
		$this->display();
	}
	//订单信息
	public function user_2() {
		//session("sc_wap_user_id",1);

		$data=memberorder();
		
		$this->order=$data;
		$this->display();
	}
	//设置
	public function user_3() {

		$this->display();
	}
	//邀请好友
	public function user_4() { 
		$this->display();
	}
	//支付设置
	public function user_10() { 
		$this->display();
	}
	public function  phpqrcode(){
		//导入第三方类库
		include 'ThinkPHP/Extend/phpqrcode/phpqrcode.php';
		//$_GET['order_id'];
		$url=U('Wap/User/getcode',array('order_id'=>$_GET['order_id']));
		QRcode::png($url); 


	}
	public function about(){
		$this->display();
	}
}


?>