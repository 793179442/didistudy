<?php

/**
 * Description of TeacherAction
 * 会员信息设置
 * @author Teacheristrator
 */
class TeacherAction extends BaseAction
{

    //模型
    private $Teacher_model;
    //会员类型
    private $Teacher_type_array = array(
        0 => '业主',
        1 => '租户',
    );

    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo'),
        'addTeacher' => array('ajaxAddTeacher'),
        'editTeacher' => array('ajaxEditTeacher'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->Teacher_model = D('MemberInfo'); //实例化模型
    }

    /**
     * 列表
     */
    public function index()
    {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数

        // $where['is_effective'] = 1;

        //会员姓名
        $Teacher_name = trim(I('get.p_Teacher_name'));

        if (strlen($Teacher_name) != 0) {

            $where['name'] = array('like', '%' . $Teacher_name . '%');
            $url_where['name'] = $Teacher_name;
        }


        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->Teacher_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/Teacher/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $Teacher = $this->Teacher_model
            ->where($where)->limit($first, $row)->select();

        foreach ($Teacher as $key => $val) {
            if ($val['sex'] == 1) {
                $Teacher[$key]['sex_name'] = '男';
            } else {
                $Teacher[$key]['sex_name'] = '女';
            }

            if ($val['member_type'] == 0) {
                $Teacher[$key]['member_type'] = '学生';
            } else if ($val['member_type'] == 1) {
                $Teacher[$key]['member_type'] = '老师';
            } else {
                $Teacher[$key]['member_type'] = '机构';
            }
        }

        $this->page_arr = $page_arr;
        $this->Teacher_list = $Teacher;
        //var_dump($this->Teacher_list);exit();
        $this->by_p_title = '会员信息设置';
        $this->display();
    }

    public function detailInfo()
    {

        $refererurl = I('server.HTTP_REFERER');

        $teacher_id = trim(I('get.member_id'));
        if (!is_numeric($teacher_id) || $teacher_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $Teacher = $this->Teacher_model->where(array('member_id' => $teacher_id))->find();

        if ($Teacher['sex'] == 1) {
            $Teacher['sex_name'] = '男';
        } else {
            $Teacher['sex_name'] = '女';
        }

        if (empty($Teacher)) {
            $this->redirect($refererurl);
            exit();
        }


        $this->customer = $Teacher;
        $this->by_p_title = '会员信息';
        $this->display();
    }

    /**
     * 添加
     */
    public function addTeacher()
    {

        // //小区信息
        // $residential_quarters = D('ResidentialQuarters')->field('rq_id, residential_quarters')->where(array('is_effective' => 1))->select();
        // $this->residential_quarters = $residential_quarters;

        // //会员类型
        // $this->Teacher_type_list = $this->Teacher_type_array;

        //性别
        $this->sex_list = $this->sex_array;
        $this->by_p_title = '添加会员信息';
        $this->display('addEditTeacher');
    }

    public function ajaxAddTeacher()
    {
        if ($this->isPost()) {

            $data = array();

            //会员名称
            $name = trim(I('post.p_customer_name'));

            if (empty($name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入会员姓名'));
                exit();
            }


            $data['name'] = $name;


            //性别
            $sex = trim(I('post.p_sex'));

            if ($sex == 0) {
                echo json_encode(array('status' => 0, 'info' => '请重新选择性别'));
                exit();
            }
            $data['sex'] = $sex;


            //证件号码
            $certificates_number = trim(I('post.p_certificates_number'));

            if (strlen($certificates_number) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入证件号码'));
                exit();
            }
            $data['certificates_number'] = $certificates_number;

            //密码
            $password = trim(I('post.password'));

            if (strlen($password) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入会员密码'));
                exit();
            }
            $data['member_password'] = md5($password);

            //移动电话
            $mobile_phone = trim(I('post.p_mobile_phone'));

            if (strlen($mobile_phone) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入移动电话'));
                exit();
            }
            $data['coupon_num'] = trim(I('post.p_mobile_phone'));
            $data['accept_coupon_num'] = trim(I('post.accept_coupon_num'));
            $data['phone_number'] = $mobile_phone;

            //固定电话
            $fixed_telephone = trim(I('post.p_fixed_telephone'));
            $data['fixed_telephone'] = $fixed_telephone;

            //电子邮箱
            $email_box = trim(I('post.p_email_box'));
            $data['email_box'] = $email_box;

            //备注
            $remark = trim(I('post.p_remark'));
            $data['remark'] = $remark;

            $re = $this->Teacher_model->add($data);
            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/Teacher/index')));
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
    public function editTeacher()
    {


        $teacher_id = trim(I('get.member_id'));

        $Teacher = $this->Teacher_model->where(array('member_id' => $teacher_id))->find();


        $this->customer = $Teacher;
        $this->by_p_title = '编辑会员信息';
        $this->display('addEditTeacher');
    }

    public function ajaxEditTeacher()
    {
        if ($this->isPost()) {

            $Teacher_id = trim(I('post.member_id'));

            if (!is_numeric($Teacher_id) || $Teacher_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            $Teacher = $this->Teacher_model->where(array('member_id' => $Teacher_id))->find();

            if (empty($Teacher)) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }
            $data = array();


            //会员姓名
            $Teacher_name = trim(I('post.p_customer_name'));

            if (strlen($Teacher_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入会员姓名'));
                exit();
            }
            $data['name'] = $Teacher_name;


            $sex = trim(I('post.p_sex'));

            if ($sex == 0) {
                echo json_encode(array('status' => 0, 'info' => '请重新选择性别'));
                exit();
            }
            $data['sex'] = $sex;


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
            $data['phone_number'] = $mobile_phone;
            //移动电话
            $password = trim(I('post.password'));
            //密码
            // if (strlen($password) == 0) {
            //     echo json_encode(array('status' => 0, 'info' => '请输入密码'));
            //     exit();
            // }
            if (!empty($password)) {
                $data['member_password'] = md5($password);
            }

            //固定电话
            $fixed_telephone = trim(I('post.p_fixed_telephone'));
            $data['fixed_telephone'] = $fixed_telephone;

            //电子邮箱
            $email_box = trim(I('post.p_email_box'));
            $data['email_box'] = $email_box;

            $data['coupon_num'] = trim(I('post.p_mobile_phone'));
            $data['accept_coupon_num'] = trim(I('post.accept_coupon_num'));
            //备注
            $remark = trim(I('post.p_remark'));
            $data['remark'] = $remark;

            $re = $this->Teacher_model->where(array('member_id' => $Teacher_id))->save($data);
            if ($re !== false) {
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/Teacher/index')));
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
    public function ajaxDelTeacher()
    {

        $rq_id = trim(I('get.id'));

        $rq_id_array = explode(',', $rq_id);

        if (count($rq_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败1'));
            exit();
        }

        $count = $this->Teacher_model->where(array('member_id' => array('in', $rq_id_array)))->count();

        if (count($rq_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败2'));
            exit();
        }

        //开启事务
        $this->Teacher_model->startTrans();
        foreach ($rq_id_array as $id) {
            $rq = $this->Teacher_model->where(array('member_id' => $id))->delete();

            if (empty($rq)) {
                $this->Teacher_model->rollback();
                echo json_encode(array('status' => 0, 'info' => '删除失败3'));
                exit();
            }


        }

        $this->Teacher_model->commit(); //提交事务
        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }


}
