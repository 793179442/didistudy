<?php

class StudentDemandAction extends BaseAction
{

    //模型
    private $StudentDemand_model;

    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo'),
        'addStudentDemand' => array('ajaxAddStudentDemand'),
        'editStudentDemand' => array('ajaxEditStudentDemand'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->StudentDemand_model = D('DemandOrder'); //实例化模型
    }

    /**
     * 列表
     */
    public function index()
    {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数

        // $where['is_effective'] = 1;

        //需求姓名
        $StudentDemand_name = trim(I('get.p_StudentDemand_name'));

        if (strlen($StudentDemand_name) != 0) {

            $where['key_name'] = array('like', '%' . $StudentDemand_name . '%');
            $url_where['key_name'] = $StudentDemand_name;
        }


        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->StudentDemand_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/StudentDemand/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $StudentDemand = $this->StudentDemand_model
            ->where($where)->limit($first, $row)->select();

        foreach ($StudentDemand as $key => $val) {
            $student_data = D('MemberInfo')->where(array('member_id' => $val['student_id']))->find();
            $StudentDemand[$key]['sex_name'] = $this->sex_array[$val['sex']];
            $StudentDemand[$key]['student_name'] = $student_data['name'];
            $key_data = D('KeyWord')->where(array('key_id' => $val['key']))->find();
            $StudentDemand[$key]['key_word'] = $key_data['key_name'];
        }

        $this->page_arr = $page_arr;
        $this->StudentDemand_list = $StudentDemand;
        // echo "<pre>";
        // echo "<meta charset='utf-8'>";
        // var_dump($this->StudentDemand_list);
        // exit();
        //var_dump($this->StudentDemand_list);exit();
        $this->by_p_title = '需求信息设置';
        $this->display();
    }

    public function detailInfo()
    {

        $refererurl = I('server.HTTP_REFERER');

        $StudentDemand_id = trim(I('get.demand_id'));
        if (!is_numeric($StudentDemand_id) || $StudentDemand_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $StudentDemand = $this->StudentDemand_model->where(array('demand_id' => $StudentDemand_id))->find();
        $student_data = D('MemberInfo')->where(array('member_id' => $StudentDemand['student_id']))->find();
        $StudentDemand['student_name'] = $student_data['name'];
        $key_data = D('KeyWord')->where(array('key_id' => $StudentDemand['key']))->find();
        $StudentDemand['key_word'] = $key_data['key_name'];
        if (empty($StudentDemand)) {
            $this->redirect($refererurl);
            exit();
        }


        $this->customer = $StudentDemand;
        $this->by_p_title = '需求信息';
        $this->display();
    }

    /**
     * 添加
     */
    public function addStudentDemand()
    {

        $this->sex_list = $this->sex_array;
        $this->by_p_title = '添加需求信息';
        $this->display('addEditStudentDemand');
    }

    public function ajaxAddStudentDemand()
    {
        if ($this->isPost()) {

            $data = array();

            //需求姓名
            $course_name = trim(I('post.course_name'));

            if (empty($course_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入课程'));
                exit();
            }


            $data['course_name'] = $course_name;
            $data['date'] = time();


            $re = $this->StudentDemand_model->add($data);
            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/StudentDemand/index')));
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
    public function editStudentDemand()
    {


        $demand_id = trim(I('get.demand_id'));

        $StudentDemand = $this->StudentDemand_model->where(array('demand_id' => $demand_id))->find();


        //性别
        // $this->sex_list = $this->sex_array;

        $this->customer = $StudentDemand;
        $this->by_p_title = '编辑需求信息';
        $this->display('addEditStudentDemand');
    }

    public function ajaxEditStudentDemand()
    {
        if ($this->isPost()) {

            $StudentDemand_id = trim(I('post.demand_id'));

            if (!is_numeric($StudentDemand_id) || $StudentDemand_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            $StudentDemand = $this->StudentDemand_model->where(array('demand_id' => $StudentDemand_id))->find();

            if (empty($StudentDemand)) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }
            $data = array();


            //课程名称
            $course_name = trim(I('post.course_name'));

            if (strlen($course_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入课程名'));
                exit();
            }
            $data['course_name'] = $course_name;


            $re = $this->StudentDemand_model->where(array('demand_id' => $StudentDemand_id))->save($data);
            if ($re !== false) {
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/StudentDemand/index')));
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
    public function ajaxDelStudentDemand()
    {

        $rq_id = trim(I('get.id'));

        $rq_id_array = explode(',', $rq_id);

        if (count($rq_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败1'));
            exit();
        }

        $count = $this->StudentDemand_model->where(array('demand_id' => array('in', $rq_id_array)))->count();

        if (count($rq_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败2'));
            exit();
        }

        //开启事务
        $this->StudentDemand_model->startTrans();
        foreach ($rq_id_array as $id) {
            $rq = $this->StudentDemand_model->where(array('demand_id' => $id))->delete();

            if (empty($rq)) {
                $this->StudentDemand_model->rollback();
                echo json_encode(array('status' => 0, 'info' => '删除失败3'));
                exit();
            }

            // $re = $this->residential_quarters_model->where(array('rq_id' => $id, 'is_effective' => 1))->save(array('is_effective' => 0));
            // if ($re === false) {
            //     $this->residential_quarters_model->rollback();
            //     echo json_encode(array('status' => 0, 'info' => '删除失败'));
            //     exit();
            // } else {
            //     if (strlen($rq['rq_picture']) > 0) {
            //         $dir = C('UPLOAD_RESIDENTIAL_QUARERS_IMG_DIR') . '/' . $rq['rq_picture'];
            //         unlink($dir);
            //     }
            // }
        }

        $this->StudentDemand_model->commit(); //提交事务
        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }


}
