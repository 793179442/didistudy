<?php

/**
 * Description of BuildingModel
 * 楼栋表
 * @author Administrator
 */
class BuildingModel extends Model {

    //字段定义
    protected $fields = array(
        'build_id',
        'residential_quarters_id',
        'building_number',
        'building_name',
        'bu_unit',
        'each_layer_household',
        'building_total_household',
        'elevator_number',
        'building_type_id',
        'use_paroperty_id',
        'group_id',
        'region_id',
        'period_id',
        'total_layer',
        'underground_layer',
        'building_height',
        'remark',
        'is_effective',
        '_pk' => 'build_id',
        '_autoinc' => true,
    );

}
