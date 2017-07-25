<?php


class CourseAction extends BaseAction
{

    //模型
    private $Course_model;

    //性别或单位
    private $sex_array = array(
        0 => '女',
        1 => '男'
    );
    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo'),
        'addCourse' => array('ajaxAddCourse'),
        'editCourse' => array('ajaxEditCourse'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->Course_model = D('Course'); //实例化模型
    }

    /**
     * 列表
     */
    public function index()
    {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数

        // $where['is_effective'] = 1;

        //课程姓名
        $Course_name = trim(I('get.p_Course_name'));

        if (strlen($Course_name) != 0) {

            $where['course_name'] = array('like', '%' . $Course_name . '%');
            $url_where['course_name'] = $Course_name;
        }


        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->Course_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/Course/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $Course = $this->Course_model
            ->where($where)->limit($first, $row)->select();


        $this->page_arr = $page_arr;
        $this->Course_list = $Course;
        //var_dump($this->Course_list);exit();
        $this->by_p_title = '课程信息设置';
        $this->display();
    }

    public function detailInfo()
    {

        $refererurl = I('server.HTTP_REFERER');

        $Course_id = trim(I('get.course_id'));
        if (!is_numeric($Course_id) || $Course_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $Course = $this->Course_model->where(array('course_id' => $Course_id))->find();

        if (empty($Course)) {
            $this->redirect($refererurl);
            exit();
        }


        $this->customer = $Course;
        $this->by_p_title = '课程信息';
        $this->display();
    }

    /**
     * 添加
     */
    public function addCourse()
    {


        //性别
        $this->sex_list = $this->sex_array;
        $this->by_p_title = '添加课程信息';
        $this->display('addEditCourse');
    }

    public function ajaxAddCourse()
    {
        if ($this->isPost()) {

            $data = array();

            //课程姓名
            $Course_name = trim(I('post.p_customer_name'));

            if (empty($Course_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入课程姓名'));
                exit();
            }


            $data['course_name'] = $Course_name;

            //价格：
            $course_price = trim(I('post.course_price'));

            if (!is_numeric($course_price)) {
                echo json_encode(array('status' => 0, 'info' => '请输入价格'));
                exit();
            }
            $data['course_price'] = $course_price;

            //门市价
            $course_shop_price = trim(I('post.course_shop_price'));

            if (!is_numeric($course_shop_price)) {
                echo json_encode(array('status' => 0, 'info' => '请输入门市价'));
                exit();
            }
            $data['course_shop_price'] = $course_shop_price;

            //课时
            $course_time = trim(I('post.course_time'));

            if (!is_numeric($course_time)) {
                echo json_encode(array('status' => 0, 'info' => '请输入课时'));
                exit();
            }
            $data['course_time'] = $course_time;

            //图片介绍：
            $course_img_text = trim(I('post.course_img_text'));

            if (empty($course_img_text)) {
                echo json_encode(array('status' => 0, 'info' => '请输入课时'));
                exit();
            }
            $data['course_img_text'] = $course_img_text;

            //地址：
            $address = trim(I('post.address'));

            if (empty($address)) {
                echo json_encode(array('status' => 0, 'info' => '请输入地址'));
                exit();
            }
            $data['address'] = $address;
            //介绍：
            $remark = trim(I('post.remark'));

            if (empty($remark)) {
                echo json_encode(array('status' => 0, 'info' => '请输入介绍'));
                exit();
            }
            $data['remark'] = $remark;
            //课程联系号码：
            $course_phone = trim(I('post.course_phone'));

            if (empty($course_phone)) {
                echo json_encode(array('status' => 0, 'info' => '请输入课程联系号码'));
                exit();
            }
            $data['course_phone'] = $course_phone;
            //开始时间：
            $time_start = trim(I('post.time_start'));

            if (empty($time_start)) {
                echo json_encode(array('status' => 0, 'info' => '请输入开始时间：'));
                exit();
            }
            $data['time_start'] = $time_start;
            //结束时间
            $time_end = trim(I('post.time_end'));

            if (empty($time_end)) {
                echo json_encode(array('status' => 0, 'info' => '请输入结束时间：'));
                exit();
            }
            $data['time_end'] = $time_end;

            //规则：
            $rule = trim(I('post.rule'));

            if (empty($rule)) {
                echo json_encode(array('status' => 0, 'info' => '请输入规则'));
                exit();
            }
            $data['rule'] = $rule;
            //适用人数
            $person_range = trim(I('post.person_range'));

            if (!is_numeric($person_range)) {
                echo json_encode(array('status' => 0, 'info' => '请输入适用人数'));
                exit();
            }
            $data['person_range'] = $person_range;
            //套餐包含服务：
            $detail = trim(I('post.detail'));

            if (empty($detail)) {
                echo json_encode(array('status' => 0, 'info' => '请输入适用人数'));
                exit();
            }
            $data['detail'] = $detail;
            //图片
            $img_src = trim(I('post.p_rq_picture'));

            if (strlen($img_src) > 0) {
                $tmp_dir = C('UPLOAD_COURSE_TMP_DIR');
                $admin_id = session('by_p_admin_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $img_src;
                if (is_file($tmp_src)) {
                    $data['course_img'] = $img_src;
                }
            }

            $re = $this->Course_model->add($data);

            if ($re) {
                if (strlen($data['course_img'])) {
                    $dir = C('UPLOAD_COURSE_IMG_DIR') . '/' . $img_src;
                    rename($tmp_src, $dir);
                }
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/Course/index')));
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
    public function editCourse()
    {


        $Course_id = trim(I('get.course_id'));

        $Course = $this->Course_model->where(array('course_id' => $Course_id))->find();


        $this->customer = $Course;
        $this->by_p_title = '编辑课程信息';
        $this->display('addEditCourse');
    }

    public function ajaxEditCourse()
    {
        if ($this->isPost()) {

            $Course_id = trim(I('post.course_id'));

            if (!is_numeric($Course_id) || $Course_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            $Course = $this->Course_model->where(array('course_id' => $Course_id))->find();

            if (empty($Course)) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }
            $data = array();

            //课程姓名
            $Course_name = trim(I('post.p_customer_name'));

            if (empty($Course_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入课程姓名'));
                exit();
            }


            $data['course_name'] = $Course_name;

            //价格：
            $course_price = trim(I('post.course_price'));

            if (!is_numeric($course_price)) {
                echo json_encode(array('status' => 0, 'info' => '请输入价格'));
                exit();
            }
            $data['course_price'] = $course_price;

            //门市价
            $course_shop_price = trim(I('post.course_shop_price'));

            if (!is_numeric($course_shop_price)) {
                echo json_encode(array('status' => 0, 'info' => '请输入门市价'));
                exit();
            }
            $data['course_shop_price'] = $course_shop_price;

            //课时
            $course_time = trim(I('post.course_time'));

            if (!is_numeric($course_time)) {
                echo json_encode(array('status' => 0, 'info' => '请输入课时'));
                exit();
            }
            $data['course_time'] = $course_time;

            //图片介绍：
            $course_img_text = trim(I('post.course_img_text'));

            if (empty($course_img_text)) {
                echo json_encode(array('status' => 0, 'info' => '请输入课时'));
                exit();
            }
            $data['course_img_text'] = $course_img_text;

            //地址：
            $address = trim(I('post.address'));

            if (empty($address)) {
                echo json_encode(array('status' => 0, 'info' => '请输入地址'));
                exit();
            }
            $data['address'] = $address;
            //介绍：
            $remark = trim(I('post.remark'));

            if (empty($remark)) {
                echo json_encode(array('status' => 0, 'info' => '请输入介绍'));
                exit();
            }
            $data['remark'] = $remark;
            //课程联系号码：
            $course_phone = trim(I('post.course_phone'));

            if (empty($course_phone)) {
                echo json_encode(array('status' => 0, 'info' => '请输入课程联系号码'));
                exit();
            }
            $data['course_phone'] = $course_phone;
            //开始时间：
            $time_start = trim(I('post.time_start'));

            if (empty($time_start)) {
                echo json_encode(array('status' => 0, 'info' => '请输入开始时间：'));
                exit();
            }
            $data['time_start'] = $time_start;
            //结束时间
            $time_end = trim(I('post.time_end'));

            if (empty($time_end)) {
                echo json_encode(array('status' => 0, 'info' => '请输入结束时间：'));
                exit();
            }
            $data['time_end'] = $time_end;

            //规则：
            $rule = trim(I('post.rule'));

            if (empty($rule)) {
                echo json_encode(array('status' => 0, 'info' => '请输入规则'));
                exit();
            }
            $data['rule'] = $rule;
            //适用人数
            $person_range = trim(I('post.person_range'));

            if (!is_numeric($person_range)) {
                echo json_encode(array('status' => 0, 'info' => '请输入适用人数'));
                exit();
            }
            $data['person_range'] = $person_range;
            //套餐包含服务：
            $detail = trim(I('post.detail'));

            if (empty($detail)) {
                echo json_encode(array('status' => 0, 'info' => '请输入适用人数'));
                exit();
            }
            $data['detail'] = $detail;

            //图片
            $img_src = trim(I('post.p_rq_picture'));
            $old_img = $this->Course_model->where(array('ourse_id' => $Course_id))->find();
            if ($old_img['course_img'] == $$img_src) {
                $data['course_img'] = $img_src;
                $is_have_old_img = 1;
            } else {
                if (strlen($img_src) > 0) {
                    $tmp_dir = C('UPLOAD_COURSE_TMP_DIR');
                    $admin_id = session('by_p_admin_id');
                    $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                    $tmp_src = $tmp_dir . '/' . $img_src;
                    if (is_file($tmp_src)) {
                        $data['course_img'] = $img_src;
                    }
                }
            }


            $re = $this->Course_model->where(array('course_id' => $Course_id))->save($data);
            if ($re !== false) {
                if ($is_have_old_img != 1) {
                    if (strlen($data['course_img'])) {
                        $dir = C('UPLOAD_COURSE_IMG_DIR') . '/' . $img_src;
                        rename($tmp_src, $dir);
                    }
                }
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/Course/index')));
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
    public function ajaxDelCourse()
    {

        $rq_id = trim(I('get.id'));

        $rq_id_array = explode(',', $rq_id);

        if (count($rq_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败1'));
            exit();
        }

        $count = $this->Course_model->where(array('course_id' => array('in', $rq_id_array)))->count();

        if (count($rq_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败2'));
            exit();
        }

        //开启事务
        $this->Course_model->startTrans();
        foreach ($rq_id_array as $id) {
            $rq_old_img = $this->Course_model->where(array('course_id' => $id))->find();
            $rq = $this->Course_model->where(array('course_id' => $id))->delete();

            if (empty($rq)) {
                $this->Course_model->rollback();
                echo json_encode(array('status' => 0, 'info' => '删除失败3'));
                exit();
            } else {
                //删除图片
                if (strlen($rq_old_img['course_img']) > 0) {
                    $dir = C('UPLOAD_COURSE_IMG_DIR') . '/' . $rq_old_img['course_img'];
                    unlink($dir);
                }
            }

        }

        $this->Course_model->commit(); //提交事务

        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }

    /**
     * 上传图片
     */
    public function ajaxUploadImg()
    {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_COURSE_TMP_DIR');
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
