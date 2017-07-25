<?php

/**
 * Description of RoleAction
 * 角色信息管理
 * @author Administrator
 */
class RoleAction extends BaseAction
{

    private $role_model; //模型
    //方法关联
    protected $method_relation = array(
        'addRole' => array('ajaxAddRole'),
        'editRole' => array('ajaxEditRole'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->role_model = D('RoleInfo');
    }

    /**
     * 列表
     */
    public function index()
    {

        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->role_model->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/Role/index'); //跳转URL 

        if (is_null($count)) {
            $count = 0;
        }
        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $role = $this->role_model->limit($first, $row)->select();

        $this->page_arr = $page_arr;
        $this->rolelist = $role;
        $this->by_p_title = '角色信息管理';
        $this->display();
    }

    /**
     * 添加
     */
    public function addRole()
    {

        $jurisdiction_list = D('FunctionModule')->field('fm_id, fm_name')->where(array('parent_id' => 0, 'is_menu' => 0))->order('sort asc')->select();

        foreach ($jurisdiction_list as $key => $val) {
            $jurisdiction = D('FunctionModule')->field('fm_id, fm_name')->where(array('parent_id' => $val['fm_id'], 'is_menu' => 0))->order('sort asc')->select();
            $jurisdiction_list[$key]['sub'] = $jurisdiction;
        }

        $this->jurisdiction_list = $jurisdiction_list;
        $this->by_p_title = '添加角色信息';
        $this->display('addEditRole');
    }

    public function ajaxAddRole()
    {
        if ($this->isPost()) {

            //角色名称
            $role_name = trim(I('post.role_name'));
            if (strlen($role_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '角色名称不能为空'));
                exit();
            }
            $data['role_name'] = $role_name;

            //说明
            $explain = trim(I('post.role_text'));
            $data['explain'] = $explain;

            //权限
            $jurisdiction_id_arr = I('post.jurisdiction_id');
            if (count($jurisdiction_id_arr) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请选择权限'));
                exit();
            }
            $data['jurisdiction'] = implode(',', $jurisdiction_id_arr);

            $re = $this->role_model->add($data);

            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/Role/index')));
                exit();
            } else {
                echo json_encode(array('status' => 0, 'info' => '添加失败'));
                exit();
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 编辑
     */
    public function editRole()
    {

        $role_id = trim(I('get.role_id'));
        if (!is_numeric($role_id) || $role_id <= 0) {
            $this->redirect('Admin/Role/index');
            exit();
        }

        $re = $this->role_model->where(array('role_id' => $role_id))->find();
        if (empty($re)) {
            $this->redirect('Admin/Role/index');
            exit();
        }

        $jurisdiction_arr = explode(',', $re['jurisdiction']);
        $re['jurisdiction_arr'] = $jurisdiction_arr;

        $jurisdiction_list = D('FunctionModule')->field('fm_id, fm_name')->where(array('parent_id' => 0, 'is_show' => 1))->order('sort asc')->select();

        foreach ($jurisdiction_list as $key => $val) {
            $jurisdiction = D('FunctionModule')->field('fm_id, fm_name')->where(array('parent_id' => $val['fm_id'], 'is_show' => 1))->order('sort asc')->select();
            $jurisdiction_list[$key]['sub'] = $jurisdiction;
        }

        $this->jurisdiction_list = $jurisdiction_list;
        $this->role = $re;
        $this->by_p_title = '修改角色信息';
        $this->display('addEditRole');
    }

    public function ajaxEditRole()
    {
        if ($this->isPost()) {

            $role_id = trim(I('post.role_id'));
            if (!is_numeric($role_id) || $role_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            $re = $this->role_model->where(array('role_id' => $role_id))->find();
            if (empty($re)) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            //角色名称
            $role_name = trim(I('post.role_name'));
            if (strlen($role_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '角色名称不能为空'));
                exit();
            }
            $data['role_name'] = $role_name;

            //说明
            $explain = trim(I('post.role_text'));
            $data['explain'] = $explain;

            //权限
            $jurisdiction_id_arr = I('post.jurisdiction_id');
            if (count($jurisdiction_id_arr) == 0) {
                echo json_encode(array('status' => 0, 'info' => '请选择权限'));
                exit();
            }
            $data['jurisdiction'] = implode(',', $jurisdiction_id_arr);

            $re = $this->role_model->where(array('role_id' => $role_id))->save($data);

            if ($re !== false) {
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/Role/index')));
                exit();
            } else {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 删除
     */
    public function ajaxDelRole()
    {

        $role_id = trim(I('get.role_id'));
        if (!is_numeric($role_id) || $role_id <= 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        $re = $this->role_model->where(array('role_id' => $role_id))->find();
        if (empty($re)) {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        $re = $this->role_model->where(array('role_id' => $role_id))->delete();
        if ($re) {
            echo json_encode(array('status' => 1, 'info' => '删除成功', 'url' => U('Admin/Role/index')));
        } else {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
        }
    }

}
