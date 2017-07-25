<?php

/**
 * Description of CustomerModel
 * 客户表
 * @author Administrator
 */
class CustomerModel extends Model {

    //字段定义
    protected $fields = array(
        'customer_id',
        'residential_quarters_id',
        'customer_name',
        'customer_type',
        'nationality',
        'sex',
        'certificates_name',
        'certificates_number',
        'mobile_phone',
        'fixed_telephone',
        'email_box',
        'remark',
        'is_effective',
        '_pk' => 'customer_id',
        '_autoinc' => true,
    );

}
