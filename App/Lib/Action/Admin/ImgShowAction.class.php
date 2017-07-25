<?php


class ImgShowAction extends BaseAction
{

    //模型
    private $img_model;

    public function __construct()
    {
        parent::__construct();
        $this->img_model = D('IndexImg'); //实例化模型
    }

    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo'),
        'addImg' => array('ajaxAddImg'),
    );

    /**
     * 列表
     */
    public function index()
    {

        $img_data = $this->img_model->order('img_sort')->select();

        //$img_data[0]['update_time']=date("Y-m-d",$img_data[0]['update_time']);
        $this->img_data = $img_data;

        //var_dump($news_data);
        $this->by_p_title = '轮播图设置';
        $this->display();
    }

    /**
     * 添加
     */
    public function addImg()
    {

        //小区信息
        $residential_quarters = D('ResidentialQuarters')->field('img_id, residential_quarters')->where(array('is_effective' => 1))->select();
        $this->residential_quarters = $residential_quarters;

        //停车场类型
        $this->parking_type_list = $this->parking_type_array;

        //车辆类别
        $this->vehicle_type_list = $this->vehicle_type_array;

        $this->by_p_title = '轮播图信息';
        $this->display('addEditImg');

    }

    public function ajaxAddImg()
    {
        if ($this->isPost()) {

            if (empty($_POST['img_url']) || empty($_POST['img_sort'])) {
                echo json_encode(array('status' => 0, 'info' => '排序或跳转路径不能为空'));
                exit();
            }
            if (!is_numeric($_POST['img_sort'])) {
                echo json_encode(array('status' => 0, 'info' => '排序必须输入数字'));
                exit();
            }
            $data = array();
            //轮播图片
            $img_src = trim(I('post.p_rq_picture'));

            if (strlen($img_src) > 0) {
                $tmp_dir = C('UPLOAD_INDEX_IMG_TMP_DIR');
                $admin_id = session('by_p_admin_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $img_src;
                if (is_file($tmp_src)) {
                    $data['img_src'] = $img_src;
                }
            }


            // $data['is_effective'] = 1;
            $data1['img_src'] = $data['img_src'];
            //排序
            $data1['img_sort'] = trim(I('post.img_sort'));
            $data1['img_url'] = trim(I('post.img_url'));
            $re = $this->img_model->add($data1);


            if ($re) {
                if (strlen($data['img_src'])) {
                    $dir = C('UPLOAD_INDEX_IMG_DIR') . '/' . $img_src;
                    rename($tmp_src, $dir);
                }
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/ImgShow/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '添加失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    public function ajaxDelImg()
    {


        $rq = $this->img_model->field('img_id, img_src')->where(array('img_id' => $_GET['id']))->find();

        if (empty($rq)) {

            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        $re = $this->img_model->where(array('img_id' => $_GET['id']))->delete();
        if ($re === false) {

            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        } else {
            if (strlen($rq['img_src']) > 0) {
                $dir = C('UPLOAD_INDEX_IMG_DIR') . '/' . $rq['img_src'];
                unlink($dir);
            }
        }


        echo json_encode(array('status' => 1, 'info' => '删除成功'));

    }

    /**
     *
     * 编辑
     */
    public function editImg()
    {

        $this->img_data = D('IndexImg')->find($_GET['img_id']);

        $this->display('addEditImg');
    }

    public function ajaxEditImg()
    {
        if ($this->isPost()) {

            if (empty($_POST['img_id'])) {
                echo json_encode(array('status' => 0, 'info' => '没有编辑目标'));
                exit();
            }
            if (empty($_POST['img_url']) || empty($_POST['img_sort'])) {
                echo json_encode(array('status' => 0, 'info' => '排序或跳转路径不能为空'));
                exit();
            }
            if (!is_numeric($_POST['img_sort'])) {
                echo json_encode(array('status' => 0, 'info' => '排序必须输入数字'));
                exit();
            }
            $data = array();
            //轮播图片
            $img_src = trim(I('post.p_rq_picture'));

            if (strlen($img_src) > 0) {
                $tmp_dir = C('UPLOAD_INDEX_IMG_TMP_DIR');
                $admin_id = session('by_p_admin_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $img_src;
                if (is_file($tmp_src)) {
                    $data['img_src'] = $img_src;
                }
            }

            // $data['is_effective'] = 1;
            $data1['img_src'] = $data['img_src'];
            //排序
            $data1['img_sort'] = trim(I('post.img_sort'));
            $data1['img_url'] = trim(I('post.img_url'));
            //先获取原来的图片路径
            $old_img_url = $this->img_model->where(array('img_id' => $_POST['img_id']))->find();
            $re = $this->img_model->where(array('img_id' => $_POST['img_id']))->save($data1);


            if ($re) {
                if (strlen($data['img_src'])) {
                    $dir = C('UPLOAD_INDEX_IMG_DIR') . '/' . $img_src;
                    rename($tmp_src, $dir);
                    //删除原来的图片
                    $ord_dir = C('UPLOAD_INDEX_IMG_DIR') . '/' . $old_img_url['img_url'];
                    unlink($ord_dir);
                }
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/ImgShow/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 上传图片
     */
    public function ajaxUploadImg()
    {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_INDEX_IMG_TMP_DIR');
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
                echo json_encode(array('status' => 1, 'img_src' => md5($name) . '.' . $ext));
            } else {
                echo json_encode(array('status' => 0, 'info' => '上传失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '上传失败'));
        }
    }

}
