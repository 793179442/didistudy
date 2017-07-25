<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    'TMPL_PARSE_STRING' => array(
        '__ADMIN__' => 'Public/Admin',
    ),
    //小区图片路径
    'UPLOAD_RESIDENTIAL_QUARERS_IMG_TMP_DIR' => 'Uploads/residential_quarters/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_RESIDENTIAL_QUARERS_IMG_DIR' => 'Uploads/residential_quarters', //上传目录
    //轮播图片
    'UPLOAD_INDEX_IMG_TMP_DIR' => 'Uploads/imgshow/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_INDEX_IMG_DIR' => 'Uploads/imgshow', //上传目录
    //LOGO图片
    'UPLOAD_LOGO_TMP_DIR' => 'Uploads/logo/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_LOGO_IMG_DIR' => 'Uploads/logo', //上传目录
);
