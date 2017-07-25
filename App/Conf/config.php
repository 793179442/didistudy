<?php

return array(

    'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
    //'配置项'=>'配置值'
    'VAR_FILTERS'=>'htmlspecialchars',
     'URL_MODEL' => 0, //URL模式
    'LOAD_EXT_CONFIG' => 'db', // 加载扩展配置文件
    'APP_GROUP_LIST' => 'Admin,Wap', //项目分组设定
    'DEFAULT_GROUP' => 'Wap', //默认分组
     //课程图片
    'UPLOAD_COURSE_TMP_DIR' => 'Uploads/course/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_COURSE_IMG_DIR' => 'Uploads/course', //上传目录
     //课程图片
    'UPLOAD_CourseType_TMP_DIR' => 'Uploads/courseType/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_CourseType_DIR' => 'Uploads/courseType', //上传目录
     //教师身份证正面
    'UPLOAD_CERTIFICATES1_TMP_DIR' => 'Uploads/certificates1/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_CERTIFICATES1_IMG_DIR' => 'Uploads/certificates1', //上传目录
     //教师身份证反面
    'UPLOAD_CERTIFICATES2_TMP_DIR' => 'Uploads/certificates2/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_CERTIFICATES2_IMG_DIR' => 'Uploads/certificates2', //上传目录
     //课程
    'UPLOAD_COURSE_TMP_DIR' => 'Uploads/course/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_COURSE_IMG_DIR' => 'Uploads/course', //上传目录
    //用户头像
    'UPLOAD_USER_HEAD_TMP_DIR' => 'Uploads/userhead/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_USER_HEAD_DIR' => 'Uploads/userhead', //上传目录
     //营业执照
    'UPLOAD_ORGANIZITION_TMP_DIR' => 'Uploads/organization/tmp/$admin_id', //缓存目录 $admin_id:用户ID
    'UPLOAD_ORGANIZITION_IMG_DIR' => 'Uploads/organization', //上传目录
        'TMPL_PARSE_STRING' => array(
        '__ADMIN__' => 'Public/Admin',
        '__WAP__'=>'Public/Wap',
    ),
);
?>
