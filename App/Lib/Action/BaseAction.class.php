<?php

/**
 * Description of BaseAction
 * 后台基础类
 * @author Administrator
 */
class BaseAction extends Action {

    protected $method_relation = array(); //操作方法关联

    public function __construct() {
        parent::__construct();

        //是否登录
        $re = IndexAction::is_login();

        if (!$re) {
            $this->redirect('Admin/Index/index');
            exit();
        }

        $action = MODULE_NAME;
        $mehod = str_replace('_', '\_', ACTION_NAME);

        $fm_id = D('FunctionModule')->where(array('fm_action' => $action, 'fm_method' => $mehod, 'is_show' => 1))->getField('fm_id');

        $jurisdiction = session('by_p_jurisdiction');
        if (!in_array($fm_id, $jurisdiction)) {

            $method_relation = $this->method_relation;

            if (count($method_relation)) {
                $i = 0;
                foreach ($method_relation as $p_mehod => $val) {
                    if (in_array($mehod, $val)) {
                        $fm_id = D('FunctionModule')->where(array('fm_action' => $action, 'fm_method' => $p_mehod, 'is_show' => 1))->getField('fm_id');
                        if (empty($fm_id)) {
                            $this->error('非法访问1');
                            exit();
                        } else {
                            break;
                        }
                    }
                    $i++;
                }
                //什么意思 看不懂
                // if ($i == count($method_relation)) {
                //     echo $i; echo count($method_relation);
                //     exit();
                //     $this->error('非法访问2');
                // }
            } else {
                $this->error('非法访问3');
                exit();
            }
        }

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
    }

    /**
     * 空操作
     * @param type $name 操作名
     */
    public function _empty($name) {
        $this->redirect('Admin/Index/login');
    }

}
