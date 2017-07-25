<?php

/**
 * Description of IndexAction
 *
 * @author Administrator
 */
class IndexAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 空操作
     */
    public function _empty()
    {
        $this->redirect('Admin/Index/login');

        echo json_encode();
    }

    /**
     * 首页s
     */
    public function index()
    {
        //是否登录
        $re = self::is_login();
        if (!$re) {
            $this->redirect('Admin/Index/login');
            exit();
        }

        $jurisdiction = session('by_p_jurisdiction'); //权限
        //菜单
        $menu_list = D('MenuInfo')->where(array('parent_id' => 0, 'is_show' => 1))->order('sort asc')->select();

        foreach ($menu_list as $key => $val) {
            $menu = D('MenuInfo')->where(array('parent_id' => $val['mi_id'], 'is_show' => 1))->order('sort asc')->select();

            foreach ($menu as $key_me => $val_me) {
                $fm_id = D('FunctionModule')->where(array('fm_action' => $val_me['mi_action'], 'fm_method' => $val_me['mi_method'], 'is_show' => 1))->getField('fm_id');
                if (in_array($fm_id, $jurisdiction)) {
                    $url = 'Admin/' . $val_me['mi_action'] . '/' . $val_me['mi_method'];
                    $menu[$key_me]['url'] = U($url);
                } else {
                    unset($menu[$key_me]);
                }
            }

            if (count($menu) == 0) {
                $action = $menu_list[$key]['mi_action'];
                $method = $menu_list[$key]['mi_method'];
                if (count($action) == 0 && count($method) == 0) {
                    unset($menu_list[$key]);
                } else {
                    $fm_id = D('FunctionModule')->where(array('fm_action' => $action, 'fm_method' => $method, 'is_show' => 1))->getField('fm_id');
                    if (in_array($fm_id, $jurisdiction)) {
                        $menu_list[$key]['url'] = U('Admin/' . $action . '/' . $method);
                    } else {
                        unset($menu_list[$key]);
                    }
                }
            } else {
                $menu_list[$key]['sub_menu'] = $menu;
                $menu_list[$key]['sub_menu_num'] = count($menu);
            }
        }

        $this->menu_info_list = $menu_list;

        $this->by_p_title = '首页';
        $this->display();
    }

    /**
     * 登录
     */
    public function login()
    {

        //是否登录
        $re = self::is_login();
        if ($re) {
            $this->redirect('Admin/Index/index');
            exit();
        }

        $this->by_p_title = '登录';
        $this->display();
    }

    public function ajaxLogin()
    {
        if ($this->isPost()) {

            //用户名
            $admin_name = trim(I('post.admin_name'));
            if (strlen($admin_name) == 0) {
                echo json_encode(array('status' => 0, 'info' => '用户名不能为空'));
                exit();
            }
            $data['admin_name'] = $admin_name;

            //密码
            $admin_pwd = trim(I('post.admin_pwd'));
            if (strlen($admin_pwd) == 0) {
                echo json_encode(array('status' => 0, 'info' => '密码不能为空'));
                exit();
            }
            $data['admin_password'] = md5($admin_pwd);

            //用户是否存在
            $admin = D('AdminInfo')->field('admin_id, admin_name, role_id')->where($data)->find();
            if (empty($admin)) {
                //登录失败，提示信息
                echo json_encode(array('status' => 0, 'info' => '用户名或密码错误'));
            } else {
                session('by_p_admin_id', $admin['admin_id']); //ID
                session('by_p_admin_name', $admin['admin_name']); //用户名
                $jurisdiction = D('RoleInfo')->where(array('role_id' => $admin['role_id']))->getField('jurisdiction');
                session('by_p_jurisdiction', explode(',', $jurisdiction)); //权限
                //登录成功，跳转到首页
                echo json_encode(array('status' => 1, 'info' => '登录成功', 'url' => U('Admin/Index/index')));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 退出
     */
    public function logout()
    {

        //清空session
        session('by_p_admin_id', null);
        session('by_p_admin_name', null);
        session('by_p_jurisdiction', null);
        $this->redirect('Admin/Index/index');
    }

    /**
     * 是否登录
     */
    static function is_login()
    {

        $admin_id = session('by_p_admin_id'); //登录ID

        if (empty($admin_id)) {
            return false;
        } else {
            return true;
        }
    }

}
