<?php

/**
 * Description of MenuInfoModel
 * 菜单信息表
 * @author Administrator
 */
class MenuInfoModel extends Model {

    //字段定义
    protected $fields = array(
        'mi_id',
        'mi_menu_name',
        'parent_id',
        'mi_action',
        'mi_method',
        'mi_icon',
        'is_show',
        'sort',
        '_pk' => 'mi_id',
        '_autoinc' => true,
    );

}
