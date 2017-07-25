<?php

/**
 * Description of ParkingLotModel
 * 车位表
 * @author Administrator
 */
class ParkingLotModel extends Model {

    //字段定义
    protected $fiellds = array(
        'park_lot_id',
        'residential_quarters_id',
        'parking_id',
        'parking_lot_number',
        'parking_lot_state',
        'parking_lot_area',
        'customer_id',
        'house_id',
        'parking_lot_type',
        'parking_lot_classify_id',
        'plate_number',
        'remark',
        'is_effective',
        '_pk' => 'park_lot_id',
        '_autoinc' => true,
    );

}
