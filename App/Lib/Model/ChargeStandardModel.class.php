<?php

/**
 * Description of ChargeStandardModel
 * 收费标准表
 * @author Administrator
 */
class ChargeStandardModel extends Model {

    protected $fields = array(
        'cs_id',
        'charging_item_id',
        'charge_standard_name',
        'billing_mode',
        'billing_cycle',
        'rounding_multiple',
        'is_allow',
        'standard_property',
        'currency_charge_standard',
        'enable_date',
        'disable_date',
        '_pk' => 'cs_id',
        '_autoinc' => true,
    );

}
