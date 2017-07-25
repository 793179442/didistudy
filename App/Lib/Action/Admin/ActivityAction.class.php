<?php


class ActivityAction extends BaseAction
{

    private $Activity_model; //模型
    public $parameter_name_array; //参数名称
    //方法关联
    protected $method_relation = array(
        'addActivity' => array('ajaxAddActivity'),
        'editActivity' => array('ajaxEditActivity'),
    );

    public function __construct()
    {
        parent::__construct();

        $this->Activity_model = D('ActivityInfo'); //实例化

    }

    /**
     * 列表
     */
    public function index()
    {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数

        //$where['is_effective'] = 1;

        //参数名称
        // $parameter_name = trim(I('get.p_parameter_name'));
        // $parameter_name_array = $this->parameter_name_array;
        // if (array_key_exists($parameter_name, $parameter_name_array)) {

        $condition = trim(I('get.p_Activity_name'));
        $where['activity_name'] = array('like', '%' . $condition . '%');
        //     $url_where['p_parameter_name'] = $parameter_name;
        // }

        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->Activity_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/Activity/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //分页信息 page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        //信息
        $Activity = $this->Activity_model->where($where)->limit($first, $row)->select();



        $this->page_arr = $page_arr;
        $this->Activity = $Activity;
        //$this->parameter_name = $this->parameter_name_array;
        $this->by_p_title = '活动信息管理';
        $this->display();
    }

    public function detailInfo()
    {

        $refererurl = I('server.HTTP_REFERER');

        $activity_id = trim(I('get.activity_id'));
        if (!is_numeric($activity_id) || $activity_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $activity = $this->Activity_model->where(array('activity_id' => $activity_id))->find();

        if (empty($activity)) {
            $this->redirect($refererurl);
            exit();
        }




        $this->customer = $activity;
        $this->by_p_title = '活动信息';
        $this->display();
    }

    /**
     * 添加
     */
    public function addActivity()
    {

        $this->parameter_name = $this->parameter_name_array;
        $this->by_p_title = '添加活动信息';
        $this->display('addEditActivity');
    }

    public function ajaxAddActivity()
    {

        if ($this->isPost()) {

            $data = array();

            //名称
            $activity_name = trim(I('post.activity_name'));

            if (empty($activity_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入活动名称'));
                exit();
            }
            $data['activity_name'] = $activity_name;
            //开始时间
            $start_time = trim(I('post.start_time'));

            if (empty($start_time)) {
                echo json_encode(array('status' => 0, 'info' => '请选择开始时间'));
                exit();
            }
            $data['start_time'] = $start_time;
            //结束时间
            $end_time = trim(I('post.end_time'));

            if (empty($end_time)) {
                echo json_encode(array('status' => 0, 'info' => '请选择结束时间'));
                exit();
            }
            $data['end_time'] = $end_time;
            //活动内容
            $activity_content1 = trim(I('post.activity_content'));

            if (empty($activity_content1)) {
                echo json_encode(array('status' => 0, 'info' => '请输入活动内容'));
                exit();
            }
            $data['activity_content'] = $activity_content1;
            //链接
            $acitvity_url = trim(I('post.acitvity_url'));

            if (empty($acitvity_url)) {
                echo json_encode(array('status' => 0, 'info' => '请输入活动链接'));
                exit();
            }
            $data['acitvity_url'] = $acitvity_url;
            //备注
            $remark = trim(I('post.remark'));

            if (empty($remark)) {
                echo json_encode(array('status' => 0, 'info' => '请输入备注'));
                exit();
            }
            $data['remark'] = $remark;


            // $data['operate_id'] = session('by_p_admin_id');
            $data['create_time'] = time();
            $data['is_use'] = 1;

            $re = $this->Activity_model->add($data);

            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/Activity/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '添加失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 修改
     */
    public function editActivity()
    {

        $activity_id = trim(I('get.activity_id'));

        if (!is_numeric($activity_id) || $activity_id <= 0) {
            $this->redirect('Admin/Activity/index');
            exit();
        }

        $cp = $this->Activity_model->where(array('activity_id' => $activity_id))->find();

        if (empty($cp)) {
            $this->redirect('Admin/Activity/index');
            exit();
        }

        $this->customer = $cp;
        $this->parameter_name = $this->parameter_name_array;
        $this->by_p_title = '修改活动信息';
        $this->display('addEditActivity');
    }

    public function ajaxEditActivity()
    {

        if ($this->isPost()) {

            $activity_id = trim(I('post.activity_id'));

            if (!is_numeric($activity_id) || $activity_id <= 0) {
                $this->redirect('Admin/Activity/index');
                exit();
            }

            $cp = $this->Activity_model->where(array('activity_id' => $activity_id))->find();

            if (empty($cp)) {
                $this->redirect('Admin/Activity/index');
                exit();
            }

            $data = array();

            //名称
            $activity_name = trim(I('post.activity_name'));

            if (empty($activity_name)) {
                echo json_encode(array('status' => 0, 'info' => '请输入活动名称'));
                exit();
            }
            $data['activity_name'] = $activity_name;
            //开始时间
            $start_time = trim(I('post.start_time'));

            if (empty($start_time)) {
                echo json_encode(array('status' => 0, 'info' => '请选择开始时间'));
                exit();
            }
            $data['start_time'] = $start_time;
            //结束时间
            $end_time = trim(I('post.end_time'));

            if (empty($end_time)) {
                echo json_encode(array('status' => 0, 'info' => '请选择结束时间'));
                exit();
            }
            $data['end_time'] = $end_time;
            //活动内容
            $activity_content1 = trim(I('post.activity_content'));

            if (empty($activity_content1)) {
                echo json_encode(array('status' => 0, 'info' => '请输入活动内容'));
                exit();
            }
            $data['activity_content'] = $activity_content1;
            //链接
            $acitvity_url = trim(I('post.acitvity_url'));

            if (empty($acitvity_url)) {
                echo json_encode(array('status' => 0, 'info' => '请输入活动链接'));
                exit();
            }
            $data['acitvity_url'] = $acitvity_url;
            //备注
            $remark = trim(I('post.remark'));

            if (empty($remark)) {
                echo json_encode(array('status' => 0, 'info' => '请输入备注'));
                exit();
            }
            $data['remark'] = $remark;

            $data['is_use'] = 1;

            $re = $this->Activity_model->where(array('activity_id' => $activity_id))->save($data);

            if ($re !== false) {
                echo json_encode(array('status' => 1, 'info' => '修改成功', 'url' => U('Admin/Activity/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '修改失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 删除
     */
    public function ajaxDelActivity()
    {

        $cp_id = trim(I('get.id'));

        $cp_id_array = explode(',', $cp_id);

        if (count($cp_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        $count = $this->Activity_model->where(array('activity_id' => array('in', $cp_id_array)))->count();

        if (count($cp_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        $re = $this->Activity_model->where(array('activity_id' => array('in', $cp_id_array)))->delete();

        if ($re != false) {
            echo json_encode(array('status' => 1, 'info' => '删除成功'));
        } else {
            echo json_encode(array('status' => 0, 'info' => '删除失败1'));
        }

    }

}
