<?php

/**
 * Description of AdminAction
 * 管理员信息管理
 * @author Administrator
 */
class AdminAction extends BaseAction {

    //模型
    private $admin_model;
    //方法关联
    protected $method_relation = array(
        'addAdmin' => array('ajaxAddAdmin'),
        'editAdmin' => array('ajaxEditAdmin'),
    );

    public function __construct() {
        parent::__construct();
        $this->admin_model = D('AdminInfo'); //实例化模型
    }

    /**
     * 列表
     */
    public function index() {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数
        //查询条件：用户名
        $admin_name = trim(I('get.admin_name'));

        if (strlen($admin_name) != 0) {
            $admin_name_str = str_replace('_', '\_', $admin_name); //过滤下划线
            $where['admin_name'] = array('like', '%' . $admin_name_str . '%');
            $url_where['admin_name'] = $admin_name;
        }

        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->admin_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/Admin/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //分页信息 page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        //管理员信息
        $adminlist = $this->admin_model->field('admin_id, admin_name, create_time, role_id')->where($where)->limit($first, $row)->select();

        foreach ($adminlist as $key => $val) {
            $adminlist[$key]['role_name'] = D('RoleInfo')->where(array('role_id' => $val['role_id']))->getField('role_name');
        }

        $this->page_arr = $page_arr;
        $this->adminlist = $adminlist;
        $this->by_p_title = '管理员信息管理';
        $this->display();
    }

    /**
     * 添加
     */
    public function addAdmin() {

        $rolelist = D('RoleInfo')->field('role_id, role_name')->select(); //角色信息

        $this->rolelist = $rolelist;
        $this->by_p_title = '添加管理员信息';
        $this->display('addEditAdmin');
    }

    public function ajaxAddAdmin() {

        if ($this->isPost()) {

            //用户名
            $admin_name = trim(I('post.admin_name'));
            if (strlen($admin_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '用户名不能为空'));
                exit();
            }

            $re = $this->admin_model->where(array('admin_name' => $admin_name))->find();
            if (!empty($re)) {
                echo json_encode(array('status' => 2, 'info' => '用户名已存在'));
                exit();
            }

            $data['admin_name'] = $admin_name;

            //密码
            $admin_pwd = trim(I('post.admin_pwd'));
            if (strlen($admin_pwd) == 0) {
                echo json_encode(array('status' => 0, 'info' => '密码不能为空'));
                exit();
            }

            if (strlen($admin_pwd) < 6 || strlen($admin_pwd) > 16) {
                echo json_encode(array('status' => 0, 'info' => '密码长度为6-16位'));
                exit();
            }

            $re_admin_pwd = trim(I('post.re_admin_pwd'));
            if ($re_admin_pwd != $admin_pwd) {
                echo json_encode(array('status' => 0, 'info' => '确认密码与密码不一致'));
                exit();
            }
            $data['admin_password'] = md5($admin_pwd);

            //角色ID
            $role_id = trim(I('post.role_id'));
            if (!is_numeric($role_id) || $role_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '请选择角色'));
                exit();
            }

            $re = D('RoleInfo')->where(array('role_id' => $role_id))->find();
            if (empty($re)) {
                echo json_encode(array('status' => 0, 'info' => '请选择角色'));
                exit();
            }
            $data['role_id'] = $role_id;

            $data['create_time'] = time();

            $data['update_time'] = time();

            $re = $this->admin_model->add($data);
            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/Admin/index')));
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
    public function editAdmin() {

        $admin_id = trim(I('get.admin_id'));
        if (!is_numeric($admin_id) || $admin_id <= 0) {
            $this->redirect('Admin/Admin/index');
            exit();
        }

        $admin = $this->admin_model->field('admin_id, admin_name, role_id')->where(array('admin_id' => $admin_id))->find();
        if (empty($admin)) {
            $this->redirect('Admin/Admin/index');
            exit();
        }

        $rolelist = D('RoleInfo')->select();

        $this->rolelist = $rolelist;
        $this->admin = $admin;
        $this->by_p_title = '编辑管理员信息';
        $this->display('addEditAdmin');
    }

    public function ajaxEditAdmin() {

        if ($this->isPost()) {

            $admin_id = trim(I('post.admin_id'));
            if (!is_numeric($admin_id) || $admin_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            $admin = $this->admin_model->field('admin_id')->where(array('admin_id' => $admin_id))->find();
            if (empty($admin)) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            //用户名
            $admin_name = trim(I('post.admin_name'));
            if (strlen($admin_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '用户名不能为空'));
                exit();
            }

            $re = $this->admin_model->where(array('admin_id' => array('neq', $admin_id), 'admin_name' => $admin_name))->find();
            if (!empty($re)) {
                echo json_encode(array('status' => 2, 'info' => '用户名已存在'));
                exit();
            }

            $data['admin_name'] = $admin_name;

            //密码
            $admin_pwd = trim(I('post.admin_pwd'));
            if (strlen($admin_pwd) != 0) {
                if (strlen($admin_pwd) < 6 || strlen($admin_pwd) > 16) {
                    echo json_encode(array('status' => 0, 'info' => '密码长度为6-16位'));
                    exit();
                }

                $re_admin_pwd = trim(I('post.re_admin_pwd'));
                if ($re_admin_pwd != $admin_pwd) {
                    echo json_encode(array('status' => 0, 'info' => '确认密码与密码不一致'));
                    exit();
                }
                $data['admin_password'] = md5($admin_pwd);
            }

            //角色ID
            $role_id = trim(I('post.role_id'));
            if (!is_numeric($role_id) || $role_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '请选择角色'));
                exit();
            }

            $re = D('RoleInfo')->where(array('role_id' => $role_id))->find();
            if (empty($re)) {
                echo json_encode(array('status' => 0, 'info' => '请选择角色'));
                exit();
            }
            $data['role_id'] = $role_id;

            $data['update_time'] = time();

            $re = $this->admin_model->where(array('admin_id' => $admin_id))->save($data);
            if ($re !== false) {
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/Admin/index')));
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
    public function ajaxDelAdmin() {

        $admin_id = trim(I('get.admin_id'));
        if (!is_numeric($admin_id) || $admin_id <= 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        $admin = $this->admin_model->field('admin_id, admin_name')->where(array('admin_id' => $admin_id))->find();
        if (empty($admin)) {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        $ad_id = session('admin_id');
        if ($admin_id == $ad_id) {
            echo json_encode(array('status' => 0, 'info' => '无法删除当前账号'));
            exit();
        }

        $re = $this->admin_model->where(array('admin_id' => $admin_id))->delete();

        if ($re) {
            echo json_encode(array('status' => 1, 'info' => '删除成功'));
        } else {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
        }
    }

}
