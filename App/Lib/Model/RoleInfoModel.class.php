<?php

/**
 * Description of RoleInfoModel
 * 角色信息表
 * @author Administrator
 */
class RoleInfoModel extends Model {

    //字段定义
    protected $fields = array(
        'role_id',
        'role_name',
        'jurisdiction',
        'explain',
        '_pk' => 'role_id',
        '_autoinc' => true,
    );

}
