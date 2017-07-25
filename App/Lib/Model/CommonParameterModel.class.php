<?php

/**
 * Description of CommonParameterModel
 * 公共参数表
 * @author Administrator
 */
class CommonParameterModel extends Model {

    //字段定义
    protected $fields = array(
        'cp_id',
        'parameter_name',
        'parameter_val',
        'operate_id',
        'create_time',
        'is_effective',
        '_pk' => 'cp_id',
        '_autoinc' => true,
    );

}
