<?php


class ServiceAction extends BaseAction
{

    //模型
    private $Service_model;

    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo'),
        'addService' => array('ajaxAddService'),
        'editService' => array('ajaxEditService'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->Service_model = D('Service'); //实例化模型
    }

    /**
     * 列表
     */
    public function index()
    {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数

        // $where['is_effective'] = 1;

        //教师姓名
        $Service_name = trim(I('get.p_Service_name'));

        if (strlen($Service_name) != 0) {

            $where['title'] = array('like', '%' . $Service_name . '%');
            $url_where['title'] = $Service_name;
        }


        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->Service_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/Service/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $Service = $this->Service_model
            ->where($where)->limit($first, $row)->select();


        $this->page_arr = $page_arr;
        $this->Service_list = $Service;
        //var_dump($this->Service_list);exit();
        $this->by_p_title = '服务信息设置';
        $this->display();
    }

    public function detailInfo()
    {

        $refererurl = I('server.HTTP_REFERER');

        $Service_id = trim(I('get.service_id'));
        if (!is_numeric($Service_id) || $Service_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $Service = $this->Service_model->where(array('service_id' => $Service_id))->find();

        if (empty($Service)) {
            $this->redirect($refererurl);
            exit();
        }


        //教师类型
        // $Service['Service_type_name'] = $this->Service_type_array[$Service['Service_type']];

        // //性别或单位
        // $Service['sex_name'] = $this->sex_array[$Service['sex']];

        $this->customer = $Service;
        $this->by_p_title = '教师信息';
        $this->display();
    }

    /**
     * 添加
     */
    public function addService()
    {

        // //小区信息
        // $residential_quarters = D('ResidentialQuarters')->field('rq_id, residential_quarters')->where(array('is_effective' => 1))->select();
        // $this->residential_quarters = $residential_quarters;

        // //教师类型
        // $this->Service_type_list = $this->Service_type_array;

        //性别
        $this->sex_list = $this->sex_array;
        $this->by_p_title = '添加教师信息';
        $this->display('addEditService');
    }

    public function ajaxAddService()
    {
        if ($this->isPost()) {

            $data = array();

            //教师姓名
            $title = trim(I('post.title'));

            if (empty($title)) {
                echo json_encode(array('status' => 0, 'info' => '请输入服务标题'));
                exit();
            }


            $data['title'] = $title;

            // //教师姓名
            // $Service_name = trim(I('post.p_Service_name'));

            // if (strlen($Service_name) == 0) {
            //     echo json_encode(array('status' => 0, 'info' => '请输入教师姓名'));
            //     exit();
            // }
            // $data['Service_name'] = $Service_name;

            // //教师类型
            // $Service_type = trim(I('post.p_Service_type'));

            // if (!array_key_exists($Service_type, $this->Service_type_array)) {
            //     echo json_encode(array('status' => 0, 'info' => '请重新选择教师类型'));
            //     exit();
            // }
            // $data['Service_type'] = $Service_type;

            //国籍
            // $nationality = trim(I('post.p_nationality'));
            // $data['nationality'] = $nationality;

            //性别
            // $sex = trim(I('post.p_sex'))-1;

            // if (!array_key_exists($sex, $this->sex_array)) {
            //     echo json_encode(array('status' => 0, 'info' => '请重新选择性别'));
            //     exit();
            // }
            // $data['sex'] = $sex;

            //证件名称
            $content = trim(I('post.content'));

            if (strlen($content) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入服务内容'));
                exit();
            }
            $data['content'] = $content;

            // //证件号码
            // $certificates_number = trim(I('post.p_certificates_number'));

            // if (strlen($certificates_number) == 0) {
            //     echo json_encode(array('status' => 0, 'info' => '请输入证件号码'));
            //     exit();
            // }

            // //移动电话
            // $mobile_phone = trim(I('post.p_mobile_phone'));

            // if (strlen($mobile_phone) == 0) {
            //     echo json_encode(array('status' => 0, 'info' => '请输入移动电话'));
            //     exit();
            // }
            // $data['mobile_phone'] = $mobile_phone;

            // //固定电话
            // $fixed_telephone = trim(I('post.p_fixed_telephone'));
            // $data['fixed_telephone'] = $fixed_telephone;

            // //电子邮箱
            // $email_box = trim(I('post.p_email_box'));
            // $data['email_box'] = $email_box;

            // //备注
            // $remark = trim(I('post.p_remark'));
            // $data['remark'] = $remark;
            $data['date'] = time();
            $re = $this->Service_model->add($data);
            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/Service/index')));
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
    public function editService()
    {


        $Service_id = trim(I('get.service_id'));

        $Service = $this->Service_model->where(array('service_id' => $Service_id))->find();


        // //性别
        // $this->sex_list = $this->sex_array;

        $this->customer = $Service;
        $this->by_p_title = '编辑教师信息';
        $this->display('addEditService');
    }

    public function ajaxEditService()
    {
        if ($this->isPost()) {

            $service_id = trim(I('post.service_id'));

            if (!is_numeric($service_id) || $service_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败1'));
                exit();
            }

            $Service = $this->Service_model->where(array('service_id' => $service_id))->find();

            if (empty($Service)) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败2'));
                exit();
            }
            $data = array();

            // //所属小区
            // $residential_quarters_id = trim(I('post.p_residential_quarters_id'));

            // if (!is_numeric($residential_quarters_id) || $residential_quarters_id <= 0) {
            //     echo json_encode(array('status' => 0, 'info' => '请重新选择所属小区'));
            //     exit();
            // }

            // $re = D('ResidentialQuarters')->where(array('rq_id' => $residential_quarters_id, 'is_effective' => 1))->count();

            // if (!$re) {
            //     echo json_encode(array('status' => 0, 'info' => ''));
            //     exit();
            // }
            // $data['residential_quarters_id'] = $residential_quarters_id;

            //服务标题
            $title = trim(I('post.title'));

            if (strlen($title) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入服务标题'));
                exit();
            }
            $data['title'] = $title;

            //服务内容
            $content = trim(I('post.content'));

            if (strlen($content) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入服务内容'));
                exit();
            }
            $data['content'] = $content;
            // //教师类型
            // $Service_type = trim(I('post.p_Service_type'));

            // if (!array_key_exists($Service_type, $this->Service_type_array)) {
            //     echo json_encode(array('status' => 0, 'info' => '请重新选择教师类型'));
            //     exit();
            // }
            // $data['Service_type'] = $Service_type;

            //国籍
            // $nationality = trim(I('post.p_nationality'));
            // $data['nationality'] = $nationality;

            //性别或单位
            // $sex = trim(I('post.p_sex'))-1;

            // if (!array_key_exists($sex, $this->sex_array)) {
            //     echo json_encode(array('status' => 0, 'info' => '请重新选择性别或单位'));
            //     exit();
            // }
            // $data['sex'] = $sex;

            // //证件名称
            // $certificates_name = trim(I('post.p_certificates_name'));

            // if (strlen($certificates_name) == 0) {
            //     echo json_encode(array('status' => 0, 'info' => '请输入证件名称'));
            //     exit();
            // }
            // $data['certificates_name'] = $certificates_name;

            // //证件号码
            // $certificates_number = trim(I('post.p_certificates_number'));

            // if (strlen($certificates_number) == 0) {
            //     echo json_encode(array('status' => 0, 'info' => '请输入证件号码'));
            //     exit();
            // }
            // $data['certificates_number'] = $certificates_number;

            // //移动电话
            // $mobile_phone = trim(I('post.p_mobile_phone'));

            // if (strlen($mobile_phone) == 0) {
            //     echo json_encode(array('status' => 0, 'info' => '请输入移动电话'));
            //     exit();
            // }
            // $data['mobile_phone'] = $mobile_phone;

            // //固定电话
            // $fixed_telephone = trim(I('post.p_fixed_telephone'));
            // $data['fixed_telephone'] = $fixed_telephone;

            // //电子邮箱
            // $email_box = trim(I('post.p_email_box'));
            // $data['email_box'] = $email_box;

            // //备注
            // $remark = trim(I('post.p_remark'));
            // $data['remark'] = $remark;

            $re = $this->Service_model->where(array('service_id' => $service_id))->save($data);
            if ($re !== false) {
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/Service/index')));
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
    public function ajaxDelService()
    {

        $rq_id = trim(I('get.id'));

        $rq_id_array = explode(',', $rq_id);

        if (count($rq_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败1'));
            exit();
        }

        $count = $this->Service_model->where(array('service_id' => array('in', $rq_id_array)))->count();

        if (count($rq_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败2'));
            exit();
        }

        //开启事务
        $this->Service_model->startTrans();
        foreach ($rq_id_array as $id) {
            $rq = $this->Service_model->where(array('Service_id' => $id))->delete();

            if (empty($rq)) {
                $this->Service_model->rollback();
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

        $this->Service_model->commit(); //提交事务
        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }


}
