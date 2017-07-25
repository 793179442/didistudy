<?php

/**
 * Description of ResidentialQuartersModel
 * 小区表
 * @author Administrator
 */
class ResidentialQuartersModel extends Model {

    //字段定义
    protected $fields = array(
        'rq_id',
        'residential_quarters',
        'instituition_id',
        'rq_developers',
        'floor_area',
        'covers_area',
        'total_household',
        'parking_lot_number',
        'greening_rate',
        'volume_rate',
        'general_situation',
        'address',
        'building_number',
        'rq_picture',
        'remark',
        'is_effective',
        '_pk' => 'rq_id',
        '_autoinc' => true,
    );

}
