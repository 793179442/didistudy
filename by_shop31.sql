# Host: localhost  (Version: 5.5.40)
# Date: 2011-01-14 08:29:19
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "by_activity_info"
#

DROP TABLE IF EXISTS `by_activity_info`;
CREATE TABLE `by_activity_info` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(30) DEFAULT NULL COMMENT '活动名称',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `start_time` int(10) DEFAULT NULL COMMENT '活动开始时间',
  `end_time` int(10) DEFAULT NULL COMMENT '活动结束时间',
  `activity_content` varchar(200) DEFAULT NULL COMMENT '活动内容',
  `acitvity_url` varchar(60) DEFAULT NULL COMMENT '活动链接',
  `is_use` tinyint(1) DEFAULT NULL COMMENT '0未启动  1启动活动',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='活动表';

#
# Data for table "by_activity_info"
#

INSERT INTO `by_activity_info` VALUES (3,'1',1294943777,11,1,'11','1',1,'1'),(4,'2',1294943790,2,22,'2','22',1,'22');

#
# Structure for table "by_admin_info"
#

DROP TABLE IF EXISTS `by_admin_info`;
CREATE TABLE `by_admin_info` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_name` varchar(32) NOT NULL COMMENT '用户名',
  `admin_password` varchar(32) NOT NULL COMMENT '密码',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员信息表';

#
# Data for table "by_admin_info"
#

INSERT INTO `by_admin_info` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e',1,1487922045,1294962565),(2,'test','e10adc3949ba59abbe56e057f20f883e',2,1487922131,1487922131);

#
# Structure for table "by_adv_news"
#

DROP TABLE IF EXISTS `by_adv_news`;
CREATE TABLE `by_adv_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '公告id',
  `news_content` text COMMENT '公告内容',
  `update_time` int(11) DEFAULT NULL COMMENT '公告更新日期',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='公告';

#
# Data for table "by_adv_news"
#

INSERT INTO `by_adv_news` VALUES (1,'4664646',1294957600);

#
# Structure for table "by_building"
#

DROP TABLE IF EXISTS `by_building`;
CREATE TABLE `by_building` (
  `build_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `residential_quarters_id` int(10) unsigned NOT NULL COMMENT '所属小区',
  `building_number` varchar(20) NOT NULL COMMENT '楼栋编号',
  `building_name` varchar(50) NOT NULL COMMENT '楼栋名称',
  `bu_unit` int(10) unsigned DEFAULT NULL COMMENT '单元数',
  `each_layer_household` int(10) unsigned DEFAULT NULL COMMENT '每层户数',
  `building_total_household` int(10) unsigned DEFAULT NULL COMMENT '楼栋总户数',
  `elevator_number` int(10) unsigned DEFAULT NULL COMMENT '电梯数量',
  `building_type_id` int(10) unsigned DEFAULT NULL COMMENT '楼栋类型',
  `use_paroperty_id` int(10) unsigned DEFAULT NULL COMMENT '使用性质',
  `group_id` int(10) unsigned DEFAULT NULL COMMENT '组团',
  `region_id` int(10) unsigned DEFAULT NULL COMMENT '区域',
  `period_id` int(10) unsigned DEFAULT NULL COMMENT '期数',
  `total_layer` int(10) unsigned DEFAULT NULL COMMENT '总层数',
  `underground_layer` int(10) unsigned DEFAULT NULL COMMENT '地下层数',
  `building_height` int(10) unsigned DEFAULT NULL COMMENT '楼栋高度',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `is_effective` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效\r\n0:无效\r\n1:有效',
  PRIMARY KEY (`build_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='楼栋表';

#
# Data for table "by_building"
#

INSERT INTO `by_building` VALUES (1,29,'20170309123456785522','A楼栋',5,10,180,5,9,11,12,14,15,30,2,90,'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',1),(2,30,'20170309201201036552','B楼栋',1,1,1,1,8,10,12,13,NULL,1,1,1,'',1),(3,31,'20170309854123652417','C楼栋',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(4,29,'20170310123456789999','Z',12,12,12,12,8,10,12,NULL,15,12,12,12,'',0),(5,31,'20170310231245142541','Q龙洞',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,0,0,'',0),(6,29,'20170310123452514452','SA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',0),(7,30,'20178888888888888888','D栋A',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);

#
# Structure for table "by_charge_standard"
#

DROP TABLE IF EXISTS `by_charge_standard`;
CREATE TABLE `by_charge_standard` (
  `cs_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `charging_item_id` int(10) unsigned NOT NULL COMMENT '收费项目',
  `charge_standard_name` varchar(50) NOT NULL COMMENT '标准名称',
  `billing_mode` tinyint(3) unsigned NOT NULL COMMENT '计费方式\r\n0:按建面积*单价\r\n1:按车面积*单价\r\n2:按表计用量*单价\r\n3:按数量*单价\r\n4:按实际发生额\r\n5:按比例\r\n6:按定额\r\n7:按阶梯计价\r\n8:按楼层计价',
  `billing_cycle` tinyint(3) unsigned NOT NULL COMMENT '计费周期\r\n0:1\r\n1:3\r\n2:6\r\n3:12\r\n4:无固定周期',
  `rounding_multiple` tinyint(3) unsigned NOT NULL COMMENT '四舍五入倍数\r\n0:元\r\n1:角\r\n2:分',
  `is_allow` tinyint(3) unsigned NOT NULL COMMENT '是否允许收费员输入金额\r\n0:否\r\n1:是',
  `standard_property` tinyint(3) unsigned NOT NULL COMMENT '标准性质\r\n0:单价\r\n1:总价',
  `currency_charge_standard` double(10,2) unsigned NOT NULL COMMENT '通用收费标准',
  `enable_date` int(10) unsigned NOT NULL COMMENT '启用日期',
  `disable_date` int(10) unsigned NOT NULL COMMENT '停用日期',
  PRIMARY KEY (`cs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收费标准表';

#
# Data for table "by_charge_standard"
#


#
# Structure for table "by_charging_item"
#

DROP TABLE IF EXISTS `by_charging_item`;
CREATE TABLE `by_charging_item` (
  `ci_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parent_id` int(10) unsigned NOT NULL COMMENT '上级收费项目',
  `charging_item_name` varchar(50) NOT NULL COMMENT '收费项目名称',
  `cost_nature` tinyint(3) unsigned NOT NULL COMMENT '费用性质\r\n0:收入\r\n1:代收\r\n2:暂收',
  `cost_type` int(10) unsigned NOT NULL COMMENT '费用类型',
  `cost_sort` int(10) unsigned NOT NULL COMMENT '费用排序',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `is_effective` tinyint(3) unsigned NOT NULL COMMENT '是否有效\r\n0:无效\r\n1:有效',
  PRIMARY KEY (`ci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收费项目表';

#
# Data for table "by_charging_item"
#


#
# Structure for table "by_common_parameter"
#

DROP TABLE IF EXISTS `by_common_parameter`;
CREATE TABLE `by_common_parameter` (
  `cp_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parameter_name` tinyint(3) unsigned NOT NULL COMMENT '参数名称\r\n1:楼栋类型\r\n2:使用性质\r\n3:组团\r\n4:区域\r\n5:期数\r\n6:房屋状态\r\n7:使用状态\r\n8:房屋户型\r\n9:使用性质\r\n10:费用类型\r\n11:车位分类\r\n',
  `parameter_val` varchar(32) NOT NULL COMMENT '参数值',
  `operate_id` int(10) unsigned NOT NULL COMMENT '添加人',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `is_effective` tinyint(3) unsigned NOT NULL COMMENT '是否有效\r\n0:无效\r\n1:有效\r\n',
  PRIMARY KEY (`cp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='公共参数表';

#
# Data for table "by_common_parameter"
#

INSERT INTO `by_common_parameter` VALUES (1,1,'类型11',1,1488334720,0),(2,2,'性质12',1,1488334729,0),(3,3,'团1',1,1488272920,0),(4,11,'类1',1,1488334749,0),(5,3,'asdfas',1,1488530366,0),(6,5,'fadfdsa',1,1488530387,0),(7,5,'         wrsfdfsd            ',1,1488530402,0),(8,1,'楼栋类型1',1,1489027430,1),(9,1,'楼栋类型2',1,1489027450,1),(10,2,'性质1',1,1489028914,1),(11,2,'性质2',1,1489028928,1),(12,3,'团one',1,1489028940,1),(13,4,'A',1,1489028951,1),(14,4,'B',1,1489028960,1),(15,5,'1期',1,1489028974,1);

#
# Structure for table "by_coupon"
#

DROP TABLE IF EXISTS `by_coupon`;
CREATE TABLE `by_coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` int(11) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(11) DEFAULT NULL COMMENT '结束时间',
  `reduce_price` float(12,0) DEFAULT NULL COMMENT '优惠额度',
  `coupon_name` varchar(60) DEFAULT NULL COMMENT '优惠卷名称',
  `img_src` varchar(60) DEFAULT NULL COMMENT '优惠券图片路径',
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠券';

#
# Data for table "by_coupon"
#


#
# Structure for table "by_course"
#

DROP TABLE IF EXISTS `by_course`;
CREATE TABLE `by_course` (
  `course_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `course_name` varchar(20) NOT NULL DEFAULT '' COMMENT '课程名称',
  `course_price` float unsigned NOT NULL COMMENT '价格',
  `teacher_id` varchar(16) DEFAULT NULL COMMENT '老师',
  `course_time` int(11) NOT NULL COMMENT '课时',
  `course_img` varchar(60) NOT NULL COMMENT '图片',
  `course_img_text` varchar(40) NOT NULL COMMENT '图片介绍',
  `course_shop_price` int(11) DEFAULT NULL COMMENT '门市价',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `remark` varchar(200) DEFAULT NULL COMMENT '介绍',
  `course_phone` varchar(60) DEFAULT NULL COMMENT '课程联系号码',
  `time_start` int(11) DEFAULT NULL COMMENT '开始时间',
  `time_end` int(11) DEFAULT NULL COMMENT '结束时间',
  `message` varchar(60) NOT NULL COMMENT '预约信息',
  `rule` varchar(60) NOT NULL COMMENT '规则',
  `person_range` int(5) NOT NULL COMMENT '适用人数',
  `person_report` int(5) NOT NULL COMMENT '已报数',
  `detail` text NOT NULL COMMENT '套餐包含服务',
  `order_person` int(11) DEFAULT NULL COMMENT '预约人数',
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='课程表';

#
# Data for table "by_course"
#

INSERT INTO `by_course` VALUES (1,'11',2343240,NULL,3,'11c975714cdeafcc0d6a938434866062.jpg','11c975714cdeafcc0d6a',43,'312321','23','2322',23232,3232,'','3',332,0,'2',NULL);

#
# Structure for table "by_course_type"
#

DROP TABLE IF EXISTS `by_course_type`;
CREATE TABLE `by_course_type` (
  `cate_Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类Id',
  `cate_Name` varchar(32) DEFAULT NULL COMMENT '类名',
  `cate_ParentId` int(11) DEFAULT '0' COMMENT '父类 0 顶级分类',
  `level` int(3) DEFAULT '0',
  `logo_src` varchar(60) DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`cate_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COMMENT='课程分类';

#
# Data for table "by_course_type"
#

INSERT INTO `by_course_type` VALUES (41,'英语',0,0,'71fdecb991202f7855bf387e6a71e4b7.jpg'),(42,'42',41,2,NULL),(43,'早教',0,0,NULL),(44,'fefe',41,2,NULL),(45,'fewf',43,2,NULL),(47,'课内辅导',0,0,NULL),(48,'小学',47,2,NULL),(49,'初中',47,2,NULL),(50,'一年级',48,4,NULL),(51,'二年级',48,4,NULL),(52,'化学',50,6,NULL),(53,'物理',50,6,NULL),(55,'fef',44,4,NULL),(58,'数学',47,2,NULL),(59,'艺术',0,0,'9b0d2783cc80bd8b284c18f94aa736c4.jpg');

#
# Structure for table "by_demand_order"
#

DROP TABLE IF EXISTS `by_demand_order`;
CREATE TABLE `by_demand_order` (
  `demand_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `student_id` int(10) unsigned NOT NULL COMMENT '学生id',
  `course_name` varchar(100) NOT NULL COMMENT '课程名',
  `teacher_id` int(11) DEFAULT NULL COMMENT '教师id',
  `date` int(11) DEFAULT NULL COMMENT '发布时间',
  `key` int(11) DEFAULT NULL COMMENT '关键词',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `status` tinyint(3) DEFAULT NULL COMMENT '1预约2现在',
  `address` varchar(20) DEFAULT NULL COMMENT '地址',
  PRIMARY KEY (`demand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='学生需求表';

#
# Data for table "by_demand_order"
#

INSERT INTO `by_demand_order` VALUES (6,2,'课内辅导&quot;,高中,高一,语文',NULL,32456464,1,'fewfew',2,'广东省汕头市'),(7,2,'47,小学,二年级,语文',NULL,1294944292,1,'5424\n534\n54',2,'广东省汕头市'),(8,2,'47,小学,二年级,语文',NULL,1294944294,1,'5424\n534\n54',2,'广东省汕头市'),(9,2,'47,高中,高二,物理',NULL,1294956675,1,'13131',1,'广东省汕头市'),(10,2,'47,初中,初一,语文',NULL,1294941620,1,'74545',1,'广东省汕头市'),(11,2,'47,初中,初一,语文',NULL,1294941621,1,'74545',1,'广东省汕头市'),(12,2,'47,高中,高三,数学',NULL,1294944752,1,'312132',2,'广东省汕头市'),(13,12,'47,高中,高三,数学',NULL,1294941123,3,'6132163',2,'广东省汕头市'),(14,12,'47,高中,高三,数学',NULL,1294941126,3,'6132163',2,'广东省汕头市'),(15,12,'47,初中,初三,物理',NULL,1294955667,1,'菲菲',2,'广东省汕头市'),(16,12,'47,小学,一年级,语文',NULL,1294941331,2,'1',2,'广东省汕头市');

#
# Structure for table "by_function_module"
#

DROP TABLE IF EXISTS `by_function_module`;
CREATE TABLE `by_function_module` (
  `fm_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fm_name` varchar(100) NOT NULL COMMENT '名称',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `fm_action` varchar(50) DEFAULT NULL COMMENT '控制器',
  `fm_method` varchar(50) DEFAULT NULL COMMENT '操作名',
  `is_show` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示\r\n1:是\r\n0:否',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`fm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COMMENT='功能模块表';

#
# Data for table "by_function_module"
#

INSERT INTO `by_function_module` VALUES (1,'管理员信息管理',0,NULL,NULL,1,0),(2,'查看',1,'Admin','index',1,0),(3,'添加',1,'Admin','addAdmin',1,0),(4,'修改',1,'Admin','editAdmin',1,0),(5,'删除',1,'Admin','delAdmin',1,0),(6,'角色信息管理',0,NULL,NULL,1,0),(7,'查看',6,'Role','index',1,0),(8,'添加',6,'Role','addRole',1,0),(9,'修改',6,'Role','editRole',1,0),(10,'删除',6,'Role','delRole',1,0),(11,'地址设置',0,NULL,NULL,1,0),(12,'查看',11,'Activity','index',1,0),(13,'添加',11,'Activity','addActivity',1,0),(14,'修改',11,'Activity','editActivity',1,0),(15,'删除',11,'Activity','ajaxDelActivity',1,0),(16,'服务中心',0,NULL,NULL,1,0),(17,'查看',16,'Service','index',1,0),(18,'添加',16,'Service','addService',1,0),(19,'修改',16,'Service','editService',1,0),(20,'删除',16,'Service','ajaxDelService',1,0),(21,'小区信息设置',0,NULL,NULL,1,0),(22,'查看',21,'News','index',1,0),(23,'添加',21,'News','addNews',1,0),(24,'修改',21,'News','editNews',1,0),(25,'删除',21,'News','ajaxNews',1,0),(26,'课程信息设置',0,NULL,NULL,1,0),(27,'查看',26,'Course','index',1,0),(28,'添加',26,'Course','addCourse',1,0),(29,'修改',26,'Course','editCourse',1,0),(30,'删除',26,'Course','ajaxDelCourse',1,0),(31,'学生信息设置',0,NULL,NULL,1,0),(32,'查看',31,'Student','index',1,0),(33,'添加',31,'Student','addStudent',1,0),(34,'修改',31,'Student','editStudent',1,0),(35,'删除',31,'Student','ajaxDelStudent',1,0),(36,'老师信息设置',0,NULL,NULL,1,0),(37,'查看',36,'Teacher','index',1,0),(38,'添加',36,'Teacher','addTeacher',1,0),(39,'修改',36,'Teacher','editTeacher',1,0),(40,'删除',36,'Teacher','ajaxDelTeacher',1,0),(41,'2',0,NULL,NULL,1,0),(42,'添加',41,'StudentDemand','addStudentDemand',1,0),(43,'查看',41,'StudentDemand','index',1,0),(44,'修改',41,'StudentDemand','editStudentDemand',1,0),(45,'删除',41,'StudentDemand','ajaxDelStudentDemand',1,0),(46,'1',0,NULL,NULL,1,0),(47,'查看',46,'ParkingLot','index',1,0),(48,'删除',46,'ParkingLot','ajaxDelParkingLot',1,0),(49,'修改',46,'ParkingLot','editParkingLot',1,0),(50,'添加',46,'ParkingLot','addParkingLot',1,0),(51,'3',0,NULL,NULL,1,0),(52,'查看',51,'ChargingItem ','index',1,0),(53,'添加',51,'ChargingItem ','addChargingItem ',1,0),(54,'修改',51,'ChargingItem ','editChargingItem ',1,0),(55,'删除',51,'ChargingItem ','ajaxDelChargingItem ',1,0),(56,'收费标准设置',0,NULL,NULL,1,0),(57,'查看',56,'ChargeStandard','index',1,0),(58,'添加',56,'ChargeStandard','addChargeStandard',1,0),(59,'修改',56,'ChargeStandard','editChargeStandard',1,0),(60,'删除',56,'ChargeStandard','ajaxDelChargeStandard',1,0),(61,'首页公告设置',0,NULL,NULL,1,0),(62,'查看',61,'News','index',1,0),(64,'修改',61,'News','editNews',1,0),(65,'首页轮播图设置',0,NULL,NULL,1,0),(66,'查看',65,'ImgShow','index',1,0),(67,'添加',65,'ImgShow','addimg',1,0),(68,'删除',65,'ImgShow','ajaxDelImg',1,0),(69,'首页栏目设置',0,NULL,NULL,1,0),(70,'查看',69,'IndexMenu','index',1,0),(71,'添加',69,'IndexMenu','addMenu',1,0),(72,'修改',69,'IndexMenu','editMenu',1,0),(73,'删除',69,'IndexMenu','ajaxDelMenu',1,0),(74,'课程分类',0,'','',1,0),(75,'查看',74,'CourseType','index',1,0),(76,'添加',74,'CourseType','addCourseType',1,0),(77,'修改',74,'CourseType','editCourseType',1,0),(78,'删除',74,'CourseType','ajaxDelCourseType',1,0);

#
# Structure for table "by_house"
#

DROP TABLE IF EXISTS `by_house`;
CREATE TABLE `by_house` (
  `house_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `residential_quarters_id` int(10) unsigned NOT NULL COMMENT '所属小区',
  `build_id` int(10) unsigned NOT NULL COMMENT '所属楼栋',
  `unit_number` varchar(10) NOT NULL COMMENT '单元号',
  `start_floor_number` varchar(20) NOT NULL COMMENT '开始楼层号',
  `end_floor_number` varchar(20) NOT NULL COMMENT '结束楼层号',
  `start_serial_number` varchar(20) NOT NULL COMMENT '开始流水号',
  `end_serial_number` varchar(20) NOT NULL COMMENT '结束流水号',
  `floor_area` double(10,2) unsigned NOT NULL COMMENT '建筑面积',
  `house_state_id` int(10) unsigned NOT NULL COMMENT '房屋状态',
  `using_state_id` int(10) unsigned NOT NULL COMMENT '使用状态',
  `house_type_id` int(10) unsigned DEFAULT NULL COMMENT '房屋户型',
  `use_paroperty_id` int(10) unsigned DEFAULT NULL COMMENT '使用性质',
  `owner_id` int(10) unsigned DEFAULT NULL COMMENT '业主',
  `drawee_id` int(10) unsigned DEFAULT NULL COMMENT '付款人',
  `tenant_id` int(10) unsigned DEFAULT NULL COMMENT '租客',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `is_effective` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效\r\n0:无效\r\n1:有效',
  PRIMARY KEY (`house_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='房屋表';

#
# Data for table "by_house"
#


#
# Structure for table "by_index_img"
#

DROP TABLE IF EXISTS `by_index_img`;
CREATE TABLE `by_index_img` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '图片id',
  `img_src` varchar(60) DEFAULT NULL COMMENT '图片路径',
  `img_sort` int(11) DEFAULT '0' COMMENT '排序',
  `img_url` text COMMENT '图片跳转路径',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='轮播图';

#
# Data for table "by_index_img"
#

INSERT INTO `by_index_img` VALUES (6,'5ad42635f39e9bdfe35688792afd2855.jpg',123,'kaola'),(7,'7a595b22893008b00f904465fb0df41f.jpg',2,'http://localhost/wuye/index.php?g=Admin&amp;m=IndexMenu&amp;a=checkDetailMenu&amp;name=2&amp;id=3');

#
# Structure for table "by_index_menu"
#

DROP TABLE IF EXISTS `by_index_menu`;
CREATE TABLE `by_index_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(60) DEFAULT NULL COMMENT '栏目名',
  `content` text COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='首页栏目';

#
# Data for table "by_index_menu"
#

INSERT INTO `by_index_menu` VALUES (1,'4','4'),(3,'2','2'),(4,'3','3'),(5,'5','5');

#
# Structure for table "by_instituition"
#

DROP TABLE IF EXISTS `by_instituition`;
CREATE TABLE `by_instituition` (
  `ins_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级机构',
  `instituition_name` varchar(50) NOT NULL COMMENT '机构名称',
  `shorter_form` varchar(5) NOT NULL COMMENT '机构简称',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `is_effective` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效\r\n0:无效\r\n1:有效',
  PRIMARY KEY (`ins_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='机构表';

#
# Data for table "by_instituition"
#

INSERT INTO `by_instituition` VALUES (1,3,'XXX机构','xxxxj','^^^^^^^^^^^^^^^^&amp;&amp;&amp;&amp;&amp;&amp;&amp;&amp;',0),(2,4,'XZ','SXSS','ADAFF',0),(3,0,'YIX机构1313','YIX','撒',0),(4,0,'YIX机构19','YIX','撒',0),(5,4,'YIX1','SZZ','',0),(6,3,'机构YIX','jgyix','',0),(7,0,'ajjdfaj','sdafd','',0),(8,0,'机构1','jg1','',1),(9,0,'机构2','jigou','',1),(10,8,'机构1-x','jgx1','',1),(11,9,'机构2-x','jgx2','',1),(12,9,'XZAd','ASZA','…………………………',1),(13,0,'机构3','asd','',1);

#
# Structure for table "by_key_word"
#

DROP TABLE IF EXISTS `by_key_word`;
CREATE TABLE `by_key_word` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `key_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='关键词';

#
# Data for table "by_key_word"
#

INSERT INTO `by_key_word` VALUES (1,'找附近'),(2,'环境好'),(3,'一对一');

#
# Structure for table "by_member_info"
#

DROP TABLE IF EXISTS `by_member_info`;
CREATE TABLE `by_member_info` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL COMMENT '成员名',
  `sex` tinyint(3) DEFAULT NULL COMMENT '性别1男2女',
  `img_head` varchar(60) DEFAULT NULL COMMENT '头像',
  `member_type` tinyint(3) unsigned DEFAULT '0' COMMENT '0学生 1老师 2机构',
  `certificates_number` varchar(32) DEFAULT NULL COMMENT '证件号码',
  `phone_number` varchar(20) DEFAULT NULL COMMENT '移动电话',
  `fixed_telephone` varchar(20) DEFAULT NULL COMMENT '固定电话',
  `email_box` varchar(30) DEFAULT NULL COMMENT '电子邮箱',
  `remark` text COMMENT '简介',
  `is_effective` tinyint(3) unsigned DEFAULT '1' COMMENT '0无效1有效',
  `certificates_phone1` varchar(60) DEFAULT NULL COMMENT '证件照证明',
  `certificates_phone2` varchar(60) DEFAULT NULL COMMENT '反面',
  `member_password` varchar(60) DEFAULT NULL COMMENT 'md5加密密码',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `score` int(11) DEFAULT '0' COMMENT '积分',
  `concern_type` varchar(255) DEFAULT NULL COMMENT '关注分类',
  `self_type` varchar(255) DEFAULT NULL COMMENT '自己分类',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "by_member_info"
#

INSERT INTO `by_member_info` VALUES (2,'123',1,NULL,0,'11111','13750528174','11','11','111',1,NULL,NULL,'d41d8cd98f00b204e9800998ecf8427e',1294954644,0,NULL,NULL),(12,'123',0,NULL,0,NULL,'13750528175',NULL,NULL,NULL,1,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e',1294958390,0,NULL,NULL),(16,'1111',1,NULL,0,'11','1','11','11','11',1,NULL,NULL,'6512bd43d9caa6e02c990b0a82652dca',NULL,0,NULL,NULL),(17,'111122222',1,NULL,0,'fe','e','ewf','ewfef','fewfewf',1,NULL,NULL,'88f122ca938fbd0b88fc75ef4eaab6c8',NULL,0,NULL,NULL);

#
# Structure for table "by_menu_detail"
#

DROP TABLE IF EXISTS `by_menu_detail`;
CREATE TABLE `by_menu_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL COMMENT '菜单名',
  `logo_src` varchar(66) DEFAULT NULL COMMENT '图片路径',
  `menu_id` int(11) DEFAULT NULL COMMENT '所属父类菜单id',
  `url_a` varchar(60) DEFAULT '#' COMMENT '跳转路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='首页子类菜单';

#
# Data for table "by_menu_detail"
#

INSERT INTO `by_menu_detail` VALUES (2,'47','01066791f46799956f2919589aca8900.jpg',1,NULL),(3,'1323223','630d5e520e0d7fba190dffefaa92f041.jpg',1,NULL),(4,'1313','366e198777b8a8c4d9c600b1ba478e27.jpg',1,NULL),(5,'11','cecfed48595f68bd051e3eacf988f43b.jpg',1,NULL),(6,'kaola','669de34ad696e65661534eecc8c89aab.jpg',0,NULL),(7,'1112','0b7fc5b93687fea1a491d45255ebc406.jpg',0,NULL),(8,'11','a94afaae3108fa1a551f91273973b266.jpg',5,NULL),(9,'1','bd5c1760e927116cccc574378f7e19a8.jpg',3,'11'),(10,'2','989cce7d2b1924efef0813df7ddf65a7.jpg',3,'11');

#
# Structure for table "by_menu_info"
#

DROP TABLE IF EXISTS `by_menu_info`;
CREATE TABLE `by_menu_info` (
  `mi_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `mi_menu_name` varchar(12) NOT NULL COMMENT '菜单名称',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `mi_action` varchar(50) DEFAULT NULL COMMENT '控制器',
  `mi_method` varchar(50) DEFAULT NULL COMMENT '操作名',
  `mi_icon` varchar(50) DEFAULT NULL COMMENT '图标',
  `is_show` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示\r\n1:是\r\n0:否',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`mi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='菜单信息表';

#
# Data for table "by_menu_info"
#

INSERT INTO `by_menu_info` VALUES (1,'权限设置',0,NULL,NULL,'ec-users',1,0),(2,'管理员信息',1,'Admin','index','ec-user',1,0),(3,'角色信息',1,'Role','index','br-eye',1,0),(4,'活动管理',0,'Activity','index','ec-cog',1,0),(5,'服务中心',0,'Service','index','im-home3',1,0),(6,'消息管理',0,'News','index','im-office',1,0),(7,'课程信息',20,'Course','index','im-home',1,0),(8,'学生信息',0,'Student','index','im-home2',1,0),(9,'会员列表',22,'Teacher','index','im-user4',1,0),(10,'订单中心',0,NULL,NULL,'im-paragraph-justify',1,0),(11,'需求信息',10,'StudentDemand','index','im-table',1,0),(12,'订单管理',10,'ParkingLot','index','im-table2',1,0),(13,'收费设置',0,NULL,NULL,'im-cogs',1,0),(14,'收费项目',13,'ChargingItem ','index','im-cog',1,0),(15,'收费标准',13,'ChargeStandard','index','im-cog2',1,0),(16,'首页设置',0,NULL,NULL,'im-paragraph-justify',1,0),(17,'公告设置',16,'News','index','im-table',1,0),(18,'轮播图设置',16,'ImgShow','index','im-cog',1,0),(19,'用户指南',16,'IndexMenu','index','im-table',1,0),(20,'课程管理',0,NULL,NULL,'ec-users',1,0),(21,'课程分类',20,'CourseType','index','im-home',1,0),(22,'会员管理',0,NULL,NULL,'ec-users',1,0);

#
# Structure for table "by_news_info"
#

DROP TABLE IF EXISTS `by_news_info`;
CREATE TABLE `by_news_info` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_date` int(11) DEFAULT NULL COMMENT '日期',
  `content` text COMMENT '内容',
  `title` varchar(60) DEFAULT NULL COMMENT '标题',
  `send_object` tinyint(3) DEFAULT '1' COMMENT '1所有2老师3学生',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='消息中心';

#
# Data for table "by_news_info"
#

/*!40000 ALTER TABLE `by_news_info` DISABLE KEYS */;
INSERT INTO `by_news_info` VALUES (4,1294952853,'333','33',1);
/*!40000 ALTER TABLE `by_news_info` ENABLE KEYS */;

#
# Structure for table "by_order_info"
#

DROP TABLE IF EXISTS `by_order_info`;
CREATE TABLE `by_order_info` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `demand_id` int(11) DEFAULT NULL COMMENT '需求id',
  `teacher_id` int(11) DEFAULT NULL COMMENT '教师id',
  `date` int(11) DEFAULT NULL COMMENT '接单时间',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `student_id` int(11) DEFAULT NULL COMMENT '学生id',
  `status` tinyint(3) DEFAULT '0' COMMENT '0接单 进行1完成',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='订单';

#
# Data for table "by_order_info"
#

INSERT INTO `by_order_info` VALUES (1,6,13,1294955682,NULL,12,0),(2,6,13,1294956009,NULL,12,0);

#
# Structure for table "by_parking"
#

DROP TABLE IF EXISTS `by_parking`;
CREATE TABLE `by_parking` (
  `park_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `residential_quarters_id` int(10) unsigned NOT NULL COMMENT '所属小区',
  `parking_name` varchar(100) NOT NULL COMMENT '停车场名称',
  `parking_type` tinyint(3) unsigned NOT NULL COMMENT '停车场类别\r\n0:室内\r\n1:室外\r\n2:搭式',
  `vehicle_type` tinyint(3) unsigned NOT NULL COMMENT '车辆类别\r\n0:汽车\r\n1:摩托\r\n2:非机动车',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `is_effective` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效\r\n0:无效\r\n1:有效',
  PRIMARY KEY (`park_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='停车场表';

#
# Data for table "by_parking"
#

INSERT INTO `by_parking` VALUES (1,29,'XX',1,2,'',1),(2,30,'XAZ',2,1,'',1);

#
# Structure for table "by_parking_lot"
#

DROP TABLE IF EXISTS `by_parking_lot`;
CREATE TABLE `by_parking_lot` (
  `park_lot_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `residential_quarters_id` int(10) unsigned NOT NULL COMMENT '所属小区',
  `parking_id` int(10) unsigned NOT NULL COMMENT '所属停车场',
  `parking_lot_number` varchar(30) NOT NULL COMMENT '车位编号',
  `parking_lot_state` tinyint(3) unsigned DEFAULT NULL COMMENT '车位状态\r\n0:未售\r\n1:已售',
  `parking_lot_area` double(10,2) unsigned DEFAULT NULL COMMENT '车位面积',
  `customer_id` int(10) unsigned DEFAULT NULL COMMENT '所属客户',
  `house_id` int(10) unsigned DEFAULT NULL COMMENT '关联房号',
  `parking_lot_type` int(10) unsigned DEFAULT NULL COMMENT '车位类别\r\n0:未设定\r\n1:固定\r\n2:非固定',
  `parking_lot_classify_id` int(10) unsigned DEFAULT NULL COMMENT '车位分类',
  `plate_number` varchar(20) DEFAULT NULL COMMENT '车牌号',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `is_effective` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效\r\n0:无效\r\n1:有效',
  PRIMARY KEY (`park_lot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='车位表';

#
# Data for table "by_parking_lot"
#


#
# Structure for table "by_residential_quarters"
#

DROP TABLE IF EXISTS `by_residential_quarters`;
CREATE TABLE `by_residential_quarters` (
  `rq_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `residential_quarters` varchar(32) NOT NULL COMMENT '小区名称',
  `instituition_id` int(10) unsigned NOT NULL COMMENT '所属机构',
  `rq_developers` varchar(50) DEFAULT NULL COMMENT '开发商',
  `floor_area` double(10,2) unsigned DEFAULT NULL COMMENT '建筑面积',
  `covers_area` double(10,2) unsigned DEFAULT NULL COMMENT '占地面积',
  `total_household` int(10) unsigned DEFAULT NULL COMMENT '小区总户数',
  `parking_lot_number` int(10) unsigned DEFAULT NULL COMMENT '车位数量',
  `greening_rate` double(5,2) unsigned DEFAULT NULL COMMENT '绿化率',
  `volume_rate` double(5,2) unsigned DEFAULT NULL COMMENT '容积率',
  `general_situation` varchar(500) DEFAULT NULL COMMENT '小区概况',
  `address` varchar(500) DEFAULT NULL COMMENT '小区地址',
  `building_number` int(10) unsigned DEFAULT NULL COMMENT '楼栋数量',
  `rq_picture` text COMMENT '小区图片',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `is_effective` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效\r\n0:无效\r\n1:有效',
  PRIMARY KEY (`rq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='小区表';

#
# Data for table "by_residential_quarters"
#

INSERT INTO `by_residential_quarters` VALUES (29,'1小区',10,'12',12.00,12.00,12,12,12.00,12.00,'12','12',12,'4033f0cde8075fe3692dcd9577867df8.jpg','12',1),(30,'2小区',11,'12',12.00,12.00,12,12,12.00,12.00,'12','12',12,'5311b2eb63ba726132f7ae2c80b4c173.jpg','12',1),(31,'3小区',10,'123',123.00,123.00,123,123,100.00,123.00,'123','1231',123,'8dab4044c20c83b94d828e7c110257e0.jpg','12313',1);

#
# Structure for table "by_role_info"
#

DROP TABLE IF EXISTS `by_role_info`;
CREATE TABLE `by_role_info` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_name` varchar(32) NOT NULL COMMENT '角色名',
  `jurisdiction` text NOT NULL COMMENT '权限',
  `explain` varchar(100) DEFAULT NULL COMMENT '说明',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='角色信息表';

#
# Data for table "by_role_info"
#

INSERT INTO `by_role_info` VALUES (1,'超级管理员','2,3,4,5,70,71,72,73,66,67,68,62,64,47,48,49,50,42,43,44,45,37,38,39,40,32,33,34,35,27,28,29,30,22,23,24,25,17,18,19,20,12,13,14,15,7,8,9,10,75,76,77,78','所有权限'),(2,'测试','2,3,4,5','……………………');

#
# Structure for table "by_service"
#

DROP TABLE IF EXISTS `by_service`;
CREATE TABLE `by_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服务id',
  `title` varchar(60) DEFAULT NULL COMMENT '服务标题',
  `content` text COMMENT '内容',
  `date` int(11) DEFAULT NULL COMMENT '日期',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='服务管理';

#
# Data for table "by_service"
#

INSERT INTO `by_service` VALUES (1,'131311','63654',1294958393);

#
# Structure for table "by_student"
#

DROP TABLE IF EXISTS `by_student`;
CREATE TABLE `by_student` (
  `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `student_name` varchar(20) NOT NULL DEFAULT '' COMMENT '学生姓名',
  `customer_type` tinyint(3) unsigned NOT NULL COMMENT '客户类型\r\n0:业主\r\n1:租户',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别 0:女 1:男 2:单位',
  `certificates_name` varchar(20) NOT NULL COMMENT '证件名称',
  `certificates_number` varchar(30) NOT NULL COMMENT '证件号码',
  `mobile_phone` varchar(20) NOT NULL COMMENT '移动电话',
  `fixed_telephone` varchar(50) DEFAULT NULL COMMENT '固定号码',
  `email_box` varchar(30) DEFAULT NULL COMMENT '电子邮箱',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `is_effective` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效\r\n0:无效\r\n1:有效',
  `certificates_phone1` varchar(60) DEFAULT NULL COMMENT '证件照正面',
  `certificates_phone2` varchar(60) DEFAULT NULL COMMENT '证件照背面',
  `password` varchar(60) DEFAULT NULL COMMENT '密码md5加密',
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='学生表';

#
# Data for table "by_student"
#

INSERT INTO `by_student` VALUES (11,'3',0,1,'1','','1','1','1','11',1,NULL,NULL,NULL);

#
# Structure for table "by_teacher"
#

DROP TABLE IF EXISTS `by_teacher`;
CREATE TABLE `by_teacher` (
  `teacher_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `teacher_name` varchar(20) NOT NULL DEFAULT '' COMMENT '教师姓名',
  `customer_type` tinyint(3) unsigned NOT NULL COMMENT '客户类型\r\n0:业主\r\n1:租户',
  `nationality` varchar(16) DEFAULT NULL COMMENT '国籍',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别 0:女 1:男 2:单位',
  `certificates_name` varchar(20) NOT NULL COMMENT '证件名称',
  `certificates_number` varchar(30) NOT NULL COMMENT '证件号码',
  `mobile_phone` varchar(20) NOT NULL COMMENT '移动电话',
  `fixed_telephone` varchar(50) DEFAULT NULL COMMENT '固定电话',
  `email_box` varchar(30) DEFAULT NULL COMMENT '电子邮箱',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  `is_effective` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效\r\n0:无效\r\n1:有效',
  `certificates_phone1` varchar(60) DEFAULT NULL COMMENT '证件照正面',
  `certificates_phone2` varchar(60) DEFAULT NULL COMMENT '证件照背面',
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='教师表';

#
# Data for table "by_teacher"
#

INSERT INTO `by_teacher` VALUES (2,'',0,NULL,0,'','','',NULL,NULL,NULL,1,NULL,NULL),(3,'1123112321321',1,'XX',0,'efewf','fewf','wfew','fewfe','fefef','ewfewfwefew',1,NULL,NULL),(4,'11',0,NULL,1,'11','','1','11','11','11',1,NULL,NULL),(5,'11',0,NULL,1,'11','','11','11','11','11',1,NULL,NULL),(6,'11',0,NULL,1,'1','','11','11','11','11',1,NULL,NULL),(7,'11',0,NULL,1,'1','','11','1','1','11',1,NULL,NULL),(9,'1',0,NULL,0,'','11','',NULL,NULL,NULL,1,'fd492229322b7c2d945fc694d2f04b35.jpg','745de973c05e81945ded2df1ac125236.jpg');

#
# Structure for table "by_teacher_level"
#

DROP TABLE IF EXISTS `by_teacher_level`;
CREATE TABLE `by_teacher_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL COMMENT '教师id',
  `star_level` tinyint(3) DEFAULT NULL COMMENT '评价星级',
  `success_data` varchar(11) DEFAULT NULL COMMENT '成交率',
  `service_score` int(11) DEFAULT NULL COMMENT '服务分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='教师评价 成交率';

#
# Data for table "by_teacher_level"
#

