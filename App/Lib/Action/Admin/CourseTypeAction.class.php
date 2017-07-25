<?php


class CourseTypeAction extends BaseAction
{

    //模型
    private $CourseType_model;


    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo'),
        'addCourseType' => array('ajaxAddCourseType'),
        'editCourseType' => array('ajaxEditCourseType'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->CourseType_model = D('CourseType'); //实例化模型
    }

    /**
     * 列表
     */
    public function index()
    {
        //
        function getTree($data, $pId)
        {
            $tree = '';
            foreach ($data as $k => $v) {
                if ($v['cate_ParentId'] == $pId) {
                    $v['cate_ParentId'] = getTree($data, $v['cate_Id']);
                    $tree[] = $v;
                }
            }
            return $tree;
        }

        function procTrHtml($tree)
        {
            $html = '';

            foreach ($tree as $t) {
                $strnbsp = '';
                for ($t['level']; $t['level'] > 0; $t['level']--) {
                    $strnbsp .= '&nbsp;';
                }
                if ($t['cate_ParentId'] == '') {

                    $html .= "<option value=" . $t['cate_Id'] . ">" . $strnbsp . "{$t['cate_Name']}</option>";
                } else {


                    $html .= "<option value=" . $t['cate_Id'] . ">" . $strnbsp . $t['cate_Name'];
                    $html .= procOptionHtml($t['cate_ParentId']);
                    $html = $html . "</option>";
                }
            }
            return $html;
        }

        //

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数

        $where['cate_ParentId'] = 0;

        //课程姓名
        $CourseType_name = trim(I('get.p_Course_name'));

        if (strlen($CourseType_name) != 0) {

            $where['cate_Name'] = array('like', '%' . $CourseType_name . '%');
            $url_where['cate_Name'] = $CourseType_name;
        }


        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->CourseType_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/CourseType/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $CourseType = $this->CourseType_model
            ->where($where)->limit($first, $row)->order('cate_ParentId')->select();

        $this->page_arr = $page_arr;
        $this->CourseType_list = $CourseType;

        $this->by_p_title = '课程分类';

        $this->display();
    }


    public function detailInfo()
    {

        $refererurl = I('server.HTTP_REFERER');

        $CourseType_id = trim(I('get.course_id'));
        if (!is_numeric($CourseType_id) || $CourseType_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $CourseType = $this->CourseType_model->where(array('cate_ParentId' => $CourseType_id))->select();


        $this->customer = $CourseType;
        $this->by_p_title = '子类信息';
        $this->display();
    }

    /**
     * 添加
     */
    public function addCourseType()
    {

        function getTree($data, $pId)
        {
            $tree = '';
            foreach ($data as $k => $v) {
                if ($v['cate_ParentId'] == $pId) {
                    $v['cate_ParentId'] = getTree($data, $v['cate_Id']);
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

                    $html .= "<option value=" . $t['cate_Id'] . ">" . $strnbsp . "{$t['cate_Name']}</option>";
                } else {


                    $html .= "<option value=" . $t['cate_Id'] . ">" . $strnbsp . $t['cate_Name'];
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

        $this->type_data = D('CourseType')->select();
        $f = getTree($this->type_data, 0);

        $this->treedata = procOptionHtml($f);
        $this->by_p_title = '添加分类信息';
        $this->display('addEditCourseType');
    }

    public function ajaxAddCourseType()
    {
        static $level = 0;
        function getlevels($parent_id)
        {
            if ($parent_id == 0) return $level;
            $re = D('CourseType')->where(array('cate_Id' => $parent_id))->find();
            if ($re) {
                $level = $re['level'] + 2;
            }
            return $level;
        }

        if ($this->isPost()) {

            $data = array();

            //分类名
            $type_name = trim(I('post.type_name'));

            if (empty($type_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入分类名'));
                exit();
            }


            $data['cate_Name'] = $type_name;

            //父类id
            $parent_id = trim(I('post.parent_id'));

            if ($parent_id == -1) {
                echo json_encode(array('status' => 0, 'info' => '请选择父类id'));
                exit();
            }
            if ($parent_id == 'se') {
                $data['cate_ParentId'] = 0;
                if (empty($_POST['p_rq_picture'])) {
                    echo json_encode(array('status' => 0, 'info' => '顶级分类需要图片'));
                    exit();
                } else {
                    $img_src = trim(I('post.p_rq_picture1'));

                    if (strlen($img_src) > 0) {
                        $tmp_dir = C('UPLOAD_CourseType_TMP_DIR');
                        $admin_id = session('by_p_admin_id');
                        $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                        $tmp_src = $tmp_dir . '/' . $img_src;
                        if (is_file($tmp_src)) {
                            $data['logo_src'] = $img_src;
                        }
                    }

                }
            } else {
                $data['cate_ParentId'] = $parent_id;
            }


            if ($parent_id != 'se') {
                $data['level'] = getlevels($parent_id);
            } else {
                $data['level'] = 0;
            }

            $re = $this->CourseType_model->add($data);

            if ($re) {
                $dir = C('UPLOAD_CourseType_DIR') . '/' . $img_src;
                rename($tmp_src, $dir);
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/CourseType/index')));
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
    public function editCourseType()
    {

        $this->type_data = D('CourseType')->select();

        $CourseType_id = trim(I('get.course_id'));

        $CourseType = $this->CourseType_model->where(array('cate_Id' => $CourseType_id))->find();


        $this->customer = $CourseType;
        $this->by_p_title = '编辑课程信息';
        $this->display('addEditCourseType');
    }

    public function ajaxEditCourseType()
    {
        if ($this->isPost()) {

            $data = array();

            //分类名
            $type_name = trim(I('post.type_name'));

            if (empty($type_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入分类名'));
                exit();
            }


            $data['cate_Name'] = $type_name;

            //父类id
            $parent_id = trim(I('post.parent_id'));

            if ($parent_id == -1) {
                echo json_encode(array('status' => 0, 'info' => '请选择父类id'));
                exit();
            }
            if ($parent_id == 'se') {
                $data['cate_ParentId'] = 0;
                if (empty($_POST['p_rq_picture'])) {
                    echo json_encode(array('status' => 0, 'info' => '顶级分类需要图片'));
                    exit();
                } else {
                    $img_src = trim(I('post.p_rq_picture1'));

                    if (strlen($img_src) > 0) {
                        $tmp_dir = C('UPLOAD_CourseType_TMP_DIR');
                        $admin_id = session('by_p_admin_id');
                        $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                        $tmp_src = $tmp_dir . '/' . $img_src;
                        if (is_file($tmp_src)) {
                            $data['logo_src'] = $img_src;
                        }
                    }

                }
            } else {
                $data['cate_ParentId'] = $parent_id;
            }


            $re = $this->CourseType_model->where(array('cate_Id' => $_POST['cate_Id']))->save($data);

            if ($re) {
                $dir = C('UPLOAD_CourseType_DIR') . '/' . $img_src;
                rename($tmp_src, $dir);
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/CourseType/index')));
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
    public function ajaxDelCourseType()
    {

        $rq_id = trim(I('get.id'));

        $rq_id_array = explode(',', $rq_id);

        if (count($rq_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败1'));
            exit();
        }

        $count = $this->CourseType_model->where(array('cate_Id' => array('in', $rq_id_array)))->count();

        if (count($rq_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败2'));
            exit();
        }

        //开启事务
        $this->CourseType_model->startTrans();
        foreach ($rq_id_array as $id) {
            $rq_old_img = $this->CourseType_model->where(array('cate_Id' => $id))->find();
            $rq = $this->CourseType_model->where(array('cate_Id' => $id))->delete();

            if (empty($rq)) {
                $this->CourseType_model->rollback();
                echo json_encode(array('status' => 0, 'info' => '删除失败3'));
                exit();
            } else {
                //删除图片
                if (strlen($rq_old_img['CourseType_img']) > 0) {
                    $dir = C('UPLOAD_CourseType_IMG_DIR') . '/' . $rq_old_img['CourseType_img'];
                    unlink($dir);
                }
            }

        }

        $this->CourseType_model->commit(); //提交事务

        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }

    /**
     * 上传图片
     */
    public function ajaxUploadImg()
    {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_CourseType_TMP_DIR');
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
        $treedata = D('CourseType')->where(array('cate_ParentId' => $_GET['id']))->select();
        echo json_encode(array('status' => 1, 'treedata' => $treedata));


    }
}
