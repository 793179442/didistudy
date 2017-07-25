<?php

//用户指南
class IndexMenuAction extends BaseAction
{

    private $menu_model; //模型
    //方法关联
    protected $method_relation = array(
        'addMenu' => array('ajaxAddMenu'),
        'editMenu' => array('ajaxEditMenu'),
    );

    public function __construct()
    {
        parent::__construct();

        $this->menu_model = D('IndexMenu'); //实例化
    }

    /**
     * 列表
     */
    public function index()
    {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数


        $menu_data = $this->menu_model->order('content')->select();


        //$this->add_url = U('Admin/IndexMenu/addMenu', array('parent_id' => $parent_id));

        //$this->list = $list;
        $this->menu_data = $menu_data;
        //$this->instituition = $instituition;
        $this->by_p_title = '首页指南设置';

        $this->display();
    }

    /**
     * 查看指南
     */
    public function checkDetailMenu()
    {

        // $where = array(); //SQL查询条件
        // $url_where = array(); //url参数

        $menu_data = D('IndexMenu')->where(array('id' => $_GET['id']))->find();


        // echo "<pre>";
        // var_dump($menu_data);
        // exit();
        //$this->add_url = U('Admin/IndexMenu/addMenu', array('parent_id' => $parent_id));

        //$this->list = $list;
        $this->customer = $menu_data;
        //$this->instituition = $instituition;
        $this->by_p_title = '菜单设置';
        $this->menu_name = $_GET['name'];
        $this->parent_id = $_GET['id'];
        $this->display();
    }


    /**
     * 添加
     */
    public function addMenu()
    {

        //上级分类
        $parent_id = trim(I('get.parent_id'));

        if (!is_numeric($parent_id) || $parent_id < 0) {
            $parent_id = 0;
        } else {
            $re = $this->menu_model->where(array('ins_id' => $parent_id, 'is_effective' => 1))->find();
            if (empty($re)) {
                $parent_id = 0;
            }
        }
        $this->parent_id = $parent_id;

        $ins_list = $this->menu_model->field('ins_id, menu_name')->where(array('parent_id' => 0, 'is_effective' => 1))->select();

        $this->ins_list = $ins_list;
        $this->by_p_title = '添加指南信息';
        $this->display('addEditMenu');
    }

    public function ajaxaddMenu()
    {
        if ($this->isPost()) {

            $data = array();

            //指南名称
            $menu_name = trim(I('post.menu_name'));

            if (strlen($menu_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入指南名称2'));
                exit();
            }
            $data['menu_name'] = $menu_name;

            //上级指南
            //$parent_id = trim(I('post.p_parent_id'));

            // if (!is_numeric($parent_id) || $parent_id <= 0) {
            //     $parent_id = 0;
            // } else {
            //     $re = $this->menu_model->where(array('ins_id' => $parent_id, 'is_effective' => 1))->find();

            //     if (empty($re)) {
            //         $parent_id = 0;
            //     }
            // }
            // $data['parent_id'] = $parent_id;

            //指南简称
            $content = trim(I('post.content'));

            if (!is_numeric($content)) {
                echo json_encode(array('status' => 0, 'info' => '请输入内容数字'));
                exit();
            }
            $data['content'] = $content;

            //备注
            // $remark = trim(I('post.p_remark'));
            // $data['remark'] = $remark;

            // $data['is_effective'] = 1;

            $re = $this->menu_model->add($data);

            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/IndexMenu/index', array('parent_id' => $parent_id))));
            } else {
                echo json_encode(array('status' => 0, 'info' => '添加失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    //编辑指南
    public function ajaxEditMenu()
    {
        if ($this->isPost()) {

            $data = array();

            //指南名称
            $menu_name = trim(I('post.menu_name'));

            if (strlen($menu_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入指南名称'));
                exit();
            }
            $data['menu_name'] = $menu_name;

            //上级指南
            //$parent_id = trim(I('post.p_parent_id'));

            // if (!is_numeric($parent_id) || $parent_id <= 0) {
            //     $parent_id = 0;
            // } else {
            //     $re = $this->menu_model->where(array('ins_id' => $parent_id, 'is_effective' => 1))->find();

            //     if (empty($re)) {
            //         $parent_id = 0;
            //     }
            // }
            // $data['parent_id'] = $parent_id;

            //指南简称
            $content = trim(I('post.content'));

            if (!is_numeric($content)) {
                echo json_encode(array('status' => 0, 'info' => '请输入内容数字'));
                exit();
            }
            $data['content'] = $content;

            //备注
            // $remark = trim(I('post.p_remark'));
            // $data['remark'] = $remark;

            // $data['is_effective'] = 1;

            $re = $this->menu_model->where(array('id' => $_POST['id']))->save($data);

            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/IndexMenu/index', array('parent_id' => $parent_id))));
            } else {
                echo json_encode(array('status' => 0, 'info' => '添加失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 编辑
     */
    public function editMenu()
    {

        $id = trim(I('get.id'));

        // if (!is_numeric($ins_id) || $ins_id < 0) {
        //     $this->redirect('Admin/Instituition/index');
        //     exit();
        // }

        $ci_menu_data = $this->menu_model->where(array('id' => $id))->find();

        // if (empty($instituition)) {
        //     $this->redirect('Admin/Instituition/index');
        //     exit();
        // }

        $sub_count = $this->menu_model->where(array('parent_id' => $ins_id, 'is_effective' => 1))->count();
        $instituition['sub_count'] = $sub_count;

        $ins_list = $this->menu_model->field('ins_id, menu_name')->where(array('ins_id' => array('neq', $ins_id), 'parent_id' => 0, 'is_effective' => 1))->select();

        $this->parent_id = $instituition['parent_id'];
        $this->ins_list = $ins_list;
        $this->menu_ids = $id;
        $this->ci_menu_data = $ci_menu_data;
        $this->by_p_title = '编辑指南信息';
        $this->display('addEditMenu');
    }

    public function ajaxEditDetail()
    {
        if ($this->isPost()) {

            $data = array();

            $img_src = trim(I('post.p_rq_picture'));

            if (strlen($img_src) > 0) {
                $tmp_dir = C('UPLOAD_LOGO_TMP_DIR');
                $admin_id = session('by_p_admin_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $img_src;
                if (is_file($tmp_src)) {
                    $data['img_src'] = $img_src;
                }
            }

            //菜单名
            $name = trim(I('post.name'));

            if (strlen($name) > 0) {
                $data1['name'] = $name;
            } else {
                echo json_encode(array('status' => 0, 'info' => '请输入菜单名称'));
                exit();
            }

            //跳转路径
            $url_a = trim(I('post.url_a'));

            if (strlen($url_a) > 0) {
                $data1['url_a'] = $url_a;
            } else {
                echo json_encode(array('status' => 0, 'info' => '请输入跳转路径'));
                exit();
            }

            // $data['is_effective'] = 1;
            $data1['logo_src'] = $data['img_src'];

            $re = D('MenuDetail')->where(array('id' => $_POST['id']))->save($data1);

            if ($re) {
                if (strlen($data['img_src'])) {
                    $dir = C('UPLOAD_LOGO_IMG_DIR') . '/' . $img_src;
                    rename($tmp_src, $dir);
                }
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/IndexMenu/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => "添加失败"));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 删除
     */
    public function ajaxDelMenu()
    {

        $id = trim(I('get.id'));

        $re = $this->menu_model->where(array('id' => $id))->delete();
        if ($re === false) {
            $this->menu_model->rollback();
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }

    public function addDetail()
    {


        $this->sid_data = D('MenuDetail')->where(array('id' => $_GET['sid']))->find();
        $this->by_p_title = '子类菜单';
        $this->parent_id = $_GET['parent_id'];
        $this->display('addEditDetail');

    }

    public function ajaxAddDetail()
    {
        if ($this->isPost()) {

            $data = array();
            //轮播图片
            $img_src = trim(I('post.p_rq_picture'));

            if (strlen($img_src) > 0) {
                $tmp_dir = C('UPLOAD_LOGO_TMP_DIR');
                $admin_id = session('by_p_admin_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $img_src;
                if (is_file($tmp_src)) {
                    $data['img_src'] = $img_src;
                }
            }

            //菜单名
            $name = trim(I('post.name'));

            if (strlen($name) > 0) {
                $data1['name'] = $name;
            } else {
                echo json_encode(array('status' => 0, 'info' => '请输入菜单名称'));
                exit();
            }
            //跳转路径
            $url_a = trim(I('post.url_a'));

            if (strlen($url_a) > 0) {
                $data1['url_a'] = $url_a;
            } else {
                echo json_encode(array('status' => 0, 'info' => '请输入跳转路径'));
                exit();
            }
            // $data['is_effective'] = 1;
            $data1['logo_src'] = $data['img_src'];
            $data1['menu_id'] = trim(I('post.parent_id'));
            $re = D('MenuDetail')->add($data1);

            if ($re) {
                if (strlen($data['img_src'])) {
                    $dir = C('UPLOAD_LOGO_IMG_DIR') . '/' . $img_src;
                    rename($tmp_src, $dir);
                }
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/IndexMenu/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => "添加失败"));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    //删除菜单
    public function ajaxDelMenuDetail()
    {


        $rq = D('MenuDetail')->where(array('id' => $_GET['id']))->find();

        if (empty($rq)) {

            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        $re = D('MenuDetail')->where(array('id' => $_GET['id']))->delete();
        if ($re === false) {

            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        } else {
            if (strlen($rq['logo_src']) > 0) {
                $dir = C('UPLOAD_LOGO_IMG_DIR') . '/' . $rq['logo_src'];
                unlink($dir);
            }
        }


        echo json_encode(array('status' => 1, 'info' => '删除成功'));

    }


    /**
     * 上传图片
     */
    public function ajaxUploadImg()
    {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_LOGO_TMP_DIR');
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
