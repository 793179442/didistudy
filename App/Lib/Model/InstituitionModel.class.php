<?php

/**
 * Description of InstituitionModel
 * 机构表
 * @author Administrator
 */
class InstituitionModel extends Model {

    //字段定义
    protected $fields = array(
        'ins_id',
        'parent_id',
        'instituition_name',
        'shorter_form',
        'remark',
        'is_effective',
        '_pk' => 'ins_id',
        '_autoinc' => true,
    );

}
