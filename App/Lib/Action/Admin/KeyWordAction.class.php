<?php


class KeyWordAction extends BaseAction
{

    //模型
    private $KeyWord_model;


    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo'),
        'addKeyWord' => array('ajaxAddKeyWord'),
        'editKeyWord' => array('ajaxEditKeyWord'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->KeyWord_model = D('KeyWord'); //实例化模型
    }

    /**
     * 列表
     */
    public function index()
    {
        //

        //

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数


        //课程姓名
        $KeyWord_name = trim(I('get.p_Course_name'));

        if (strlen($KeyWord_name) != 0) {

            $where['key_name'] = array('like', '%' . $KeyWord_name . '%');
            $url_where['key_name'] = $KeyWord_name;
        }


        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->KeyWord_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/KeyWord/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $KeyWord = $this->KeyWord_model
            ->where($where)->limit($first, $row)->order('key_id asc')->select();

        $this->page_arr = $page_arr;
        $this->KeyWord_list = $KeyWord;

        $this->by_p_title = '课程分类';

        $this->display();
    }


    public function detailInfo()
    {

        $refererurl = I('server.HTTP_REFERER');

        $KeyWord_id = trim(I('get.course_id'));
        if (!is_numeric($KeyWord_id) || $KeyWord_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $KeyWord = $this->KeyWord_model->where(array('cate_ParentId' => $KeyWord_id))->select();

        // if (empty($KeyWord)) {
        //     $this->redirect($refererurl);
        //     exit();
        // }


        $this->customer = $KeyWord;
        $this->by_p_title = '子类信息';
        $this->display();
    }

    /**
     * 添加
     */
    public function addKeyWord()
    {

        function getTree($data, $pId)
        {
            $tree = '';
            foreach ($data as $k => $v) {
                if ($v['cate_ParentId'] == $pId) {
                    $v['cate_ParentId'] = getTree($data, $v['key_id']);
                    $tree[] = $v;
                }
            }
            return $tree;
        }

        function procOptionHtml($tree)
        {
            $html = '';

            foreach ($tree as $t) {
                $strnbsp = '';
                for ($t['level']; $t['level'] > 0; $t['level']--) {
                    $strnbsp .= '---';
                }
                if ($t['cate_ParentId'] == '') {

                    $html .= "<option value=" . $t['key_id'] . ">" . $strnbsp . "{$t['cate_Name']}</option>";
                } else {


                    $html .= "<option value=" . $t['key_id'] . ">" . $strnbsp . $t['cate_Name'];
                    $html .= procOptionHtml($t['cate_ParentId']);
                    $html = $html . "</option>";
                }
            }
            return $html;
        }

        function procHtml($tree)
        {
            $html = '';
            foreach ($tree as $t) {
                if ($t['cate_ParentId'] == '') {
                    $html .= "<li>{$t['cate_Name']}</li>";
                } else {
                    $html .= "<li>" . $t['cate_Name'];
                    $html .= procHtml($t['cate_ParentId']);
                    $html = $html . "</li>";
                }
            }
            return $html ? '<ul>' . $html . '</ul>' : $html;
        }

        $this->type_data = D('KeyWord')->select();
        $f = getTree($this->type_data, 0);

        $this->treedata = procOptionHtml($f);
        $this->by_p_title = '添加分类信息';
        $this->display('addEditKeyWord');
    }

    public function ajaxAddKeyWord()
    {

        if ($this->isPost()) {

            $data = array();

            //分类名
            $key_name = trim(I('post.key_name'));

            if (empty($key_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入订阅词'));
                exit();
            }


            $data['key_name'] = $key_name;


            $re = $this->KeyWord_model->add($data);

            if ($re) {

                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/KeyWord/index')));
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
    public function editKeyWord()
    {

        $this->type_data = D('KeyWord')->select();

        $KeyWord_id = trim(I('get.key_id'));

        $KeyWord = $this->KeyWord_model->where(array('key_id' => $KeyWord_id))->find();


        $this->customer = $KeyWord;
        $this->by_p_title = '编辑订阅词';
        $this->display('addEditKeyWord');
    }

    //编辑订阅词
    public function ajaxEditKeyWord()
    {
        if ($this->isPost()) {

            $data = array();

            //订阅词
            $key_name = trim(I('post.key_name'));

            if (empty($key_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入订阅词'));
                exit();
            }


            $data['key_name'] = $key_name;


            $re = $this->KeyWord_model->where(array('key_id' => $_POST['key_id']))->save($data);

            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/KeyWord/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 删除
     */
    public function ajaxDelKeyWord()
    {

        $rq_id = trim(I('get.id'));

        $rq_id_array = explode(',', $rq_id);

        if (count($rq_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败1'));
            exit();
        }

        $count = $this->KeyWord_model->where(array('key_id' => array('in', $rq_id_array)))->count();

        if (count($rq_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败2'));
            exit();
        }

        //开启事务
        $this->KeyWord_model->startTrans();
        foreach ($rq_id_array as $id) {
            $rq_old_img = $this->KeyWord_model->where(array('key_id' => $id))->find();
            $rq = $this->KeyWord_model->where(array('key_id' => $id))->delete();

            if (empty($rq)) {
                $this->KeyWord_model->rollback();
                echo json_encode(array('status' => 0, 'info' => '删除失败3'));
                exit();
            } else {
                //删除图片
                if (strlen($rq_old_img['KeyWord_img']) > 0) {
                    $dir = C('UPLOAD_KeyWord_IMG_DIR') . '/' . $rq_old_img['KeyWord_img'];
                    unlink($dir);
                }
            }

        }

        $this->KeyWord_model->commit(); //提交事务

        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }

    /**
     * 上传图片
     */
    public function ajaxUploadImg()
    {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_KeyWord_TMP_DIR');
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

    public function gettree()
    {
        $treedata = D('KeyWord')->where(array('cate_ParentId' => $_GET['id']))->select();
        echo json_encode(array('status' => 1, 'treedata' => $treedata));


    }
}
