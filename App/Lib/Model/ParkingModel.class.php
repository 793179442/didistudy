<?php

/**
 * Description of ParkingModel
 * 停车场表
 * @author Administrator
 */
class ParkingModel extends Model {

    //字段定义
    protected $fields = array(
        'park_id',
        'residential_quarters_id',
        'parking_name',
        'parking_type',
        'vehicle_type',
        'remark',
        'is_effective',
        '_pk' => 'park_id',
        '_autoinc' => true,
    );

}
