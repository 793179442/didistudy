<?php

/**
 * Description of FunctionModuleModel
 * 功能模块表
 * @author Administrator
 */
class FunctionModuleModel extends Model {

    //字段定义
    protected $fields = array(
        'fm_id',
        'fm_name',
        'parent_id',
        'fm_action',
        'fm_method',
        'is_show',
        'sort',
        '_pk' => 'fm_id',
        '_autoinc' => true,
    );

}
