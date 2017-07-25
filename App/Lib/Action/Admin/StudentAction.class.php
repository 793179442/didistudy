<?php

/**
 * Description of StudentAction
 * 学生信息设置
 * @author Studentistrator
 */
class StudentAction extends BaseAction
{

    //模型
    private $Student_model;
    // //学生类型
    // private $Student_type_array = array(
    //     0 => '业主',
    //     1 => '租户',
    // );
    //性别或单位
    private $sex_array = array(
        0 => '女',
        1 => '男'
    );
    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo'),
        'addStudent' => array('ajaxAddStudent'),
        'editStudent' => array('ajaxEditStudent'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->Student_model = D('Student'); //实例化模型
    }

    /**
     * 列表
     */
    public function index()
    {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数

        // $where['is_effective'] = 1;

        //学生姓名
        $Student_name = trim(I('get.p_Student_name'));

        if (strlen($Student_name) != 0) {

            $where['student_name'] = array('like', '%' . $Student_name . '%');
            $url_where['student_name'] = $Student_name;
        }


        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->Student_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/Student/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $Student = $this->Student_model
            ->where($where)->limit($first, $row)->select();

        foreach ($Student as $key => $val) {
            // $residential_quarters = D('ResidentialQuarters')->where(array('rq_id' => $val['residential_quarters_id'], 'is_effective' => 1))->getField('residential_quarters');
            // $Student[$key]['residential_quarters_name'] = $residential_quarters;

            // $Student[$key]['Student_type_name'] = $this->Student_type_array[$val['Student_type']];
            $Student[$key]['sex_name'] = $this->sex_array[$val['sex']];
        }

        $this->page_arr = $page_arr;
        $this->Student_list = $Student;


        $this->by_p_title = '学生信息设置';
        $this->display();
    }

    public function detailInfo()
    {

        $refererurl = I('server.HTTP_REFERER');

        $Student_id = trim(I('get.student_id'));
        if (!is_numeric($Student_id) || $Student_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $Student = $this->Student_model->where(array('student_id' => $Student_id))->find();

        if (empty($Student)) {
            $this->redirect($refererurl);
            exit();
        }


        //学生类型
        // $Student['Student_type_name'] = $this->Student_type_array[$Student['Student_type']];

        //性别或单位
        $Student['sex'] = $this->sex_array[$Student['sex']];

        $this->customer = $Student;
        $this->by_p_title = '学生信息';
        $this->display();
    }

    /**
     * 添加
     */
    public function addStudent()
    {

        // //小区信息
        // $residential_quarters = D('ResidentialQuarters')->field('rq_id, residential_quarters')->where(array('is_effective' => 1))->select();
        // $this->residential_quarters = $residential_quarters;

        // //学生类型
        // $this->Student_type_list = $this->Student_type_array;

        //性别
        $this->sex_list = $this->sex_array;
        $this->by_p_title = '添加学生信息';
        $this->display('addEditStudent');
    }

    public function ajaxAddStudent()
    {
        if ($this->isPost()) {

            $data = array();

            //学生姓名
            $Student_name = trim(I('post.student_name'));

            if (empty($Student_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入学生姓名'));
                exit();
            }


            $data['student_name'] = $Student_name;

            // //学生姓名
            // $Student_name = trim(I('post.p_Student_name'));

            // if (strlen($Student_name) == 0) {
            //     echo json_encode(array('status' => 0, 'info' => '请输入学生姓名'));
            //     exit();
            // }
            // $data['Student_name'] = $Student_name;

            // //学生类型
            // $Student_type = trim(I('post.p_Student_type'));

            // if (!array_key_exists($Student_type, $this->Student_type_array)) {
            //     echo json_encode(array('status' => 0, 'info' => '请重新选择学生类型'));
            //     exit();
            // }
            // $data['Student_type'] = $Student_type;

            //国籍
            // $nationality = trim(I('post.p_nationality'));
            // $data['nationality'] = $nationality;

            //性别
            $sex = trim(I('post.p_sex')) - 1;

            if (!array_key_exists($sex, $this->sex_array)) {
                echo json_encode(array('status' => 0, 'info' => '请重新选择性别'));
                exit();
            }
            $data['sex'] = $sex;

            //证件名称
            $certificates_name = trim(I('post.p_certificates_name'));

            if (strlen($certificates_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入证件名称'));
                exit();
            }
            $data['certificates_name'] = $certificates_name;

            //证件号码
            $certificates_number = trim(I('post.p_certificates_number'));

            if (strlen($certificates_number) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入证件号码'));
                exit();
            }

            //移动电话
            $mobile_phone = trim(I('post.p_mobile_phone'));

            if (strlen($mobile_phone) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入移动电话'));
                exit();
            }
            $data['mobile_phone'] = $mobile_phone;

            //固定电话
            $fixed_telephone = trim(I('post.p_fixed_telephone'));
            $data['fixed_telephone'] = $fixed_telephone;

            //电子邮箱
            $email_box = trim(I('post.p_email_box'));
            $data['email_box'] = $email_box;

            //备注
            $remark = trim(I('post.p_remark'));
            $data['remark'] = $remark;

            $re = $this->Student_model->add($data);
            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/Student/index')));
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
    public function editStudent()
    {


        $Student_id = trim(I('get.student_id'));

        $Student = $this->Student_model->where(array('student_id' => $Student_id))->find();


        //性别
        $this->sex_list = $this->sex_array;


        $this->customer = $Student;
        $this->by_p_title = '编辑学生信息';
        $this->display('addEditStudent');
    }

    public function ajaxEditStudent()
    {
        if ($this->isPost()) {

            $Student_id = trim(I('post.student_id'));

            if (!is_numeric($Student_id) || $Student_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            $Student = $this->Student_model->where(array('student_id' => $Student_id))->find();

            if (empty($Student)) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }
            $data = array();


            //学生姓名
            $Student_name = trim(I('post.student_name'));

            if (strlen($Student_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入学生姓名'));
                exit();
            }
            $data['student_name'] = $Student_name;

            // //学生类型
            // $Student_type = trim(I('post.p_Student_type'));

            // if (!array_key_exists($Student_type, $this->Student_type_array)) {
            //     echo json_encode(array('status' => 0, 'info' => '请重新选择学生类型'));
            //     exit();
            // }
            // $data['Student_type'] = $Student_type;

            //国籍
            // $nationality = trim(I('post.p_nationality'));
            // $data['nationality'] = $nationality;

            //性别
            $sex = trim(I('post.p_sex')) - 1;

            if (!array_key_exists($sex, $this->sex_array)) {
                echo json_encode(array('status' => 0, 'info' => '请重新选择性别'));
                exit();
            }
            $data['sex'] = $sex;

            //证件名称
            $certificates_name = trim(I('post.p_certificates_name'));

            if (strlen($certificates_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入证件名称'));
                exit();
            }
            $data['certificates_name'] = $certificates_name;

            //证件号码
            $certificates_number = trim(I('post.p_certificates_number'));

            if (strlen($certificates_number) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入证件号码'));
                exit();
            }
            $data['certificates_number'] = $certificates_number;

            //移动电话
            $mobile_phone = trim(I('post.p_mobile_phone'));

            if (strlen($mobile_phone) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入移动电话'));
                exit();
            }
            $data['mobile_phone'] = $mobile_phone;

            //固定电话
            $fixed_telephone = trim(I('post.p_fixed_telephone'));
            $data['fixed_telephone'] = $fixed_telephone;

            //电子邮箱
            $email_box = trim(I('post.p_email_box'));
            $data['email_box'] = $email_box;

            //备注
            $remark = trim(I('post.p_remark'));
            $data['remark'] = $remark;

            $re = $this->Student_model->where(array('student_id' => $Student_id))->save($data);
            if ($re !== false) {
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/Student/index')));
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
    public function ajaxDelStudent()
    {

        $rq_id = trim(I('get.id'));

        $rq_id_array = explode(',', $rq_id);

        if (count($rq_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败1'));
            exit();
        }

        $count = $this->Student_model->where(array('student_id' => array('in', $rq_id_array)))->count();

        if (count($rq_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败2'));
            exit();
        }

        //开启事务
        $this->Student_model->startTrans();
        foreach ($rq_id_array as $id) {
            $rq = $this->Student_model->where(array('student_id' => $id))->delete();

            if (empty($rq)) {
                $this->Student_model->rollback();
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

        $this->Student_model->commit(); //提交事务
        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }


}
