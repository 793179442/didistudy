<?php

/**
 * Description of ChargingItemModel
 * 收费项目表
 * @author Administrator
 */
class ChargingItemModel extends Model {

    //字段定义
    protected $fields = array(
        'ci_id',
        'parent_id',
        'charging_item_name',
        'cost_nature',
        'cost_type',
        'cost_sort',
        'remark',
        'is_effective',
        '_pk' => 'ci_id',
        '_autoinc' => true,
    );

}
