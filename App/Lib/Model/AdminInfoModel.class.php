<?php

/**
 * Description of AdminInfoModel
 * 管理员信息表
 * @author Administrator
 */
class AdminInfoModel extends Model {

    //字段定义
    protected $fields = array(
        'admin_id',
        'admin_name',
        'admin_password',
        'role_id',
        'create_time',
        'update_time',
        '_pk' => 'admin_id',
        '_autoinc' => true,
    );

}
