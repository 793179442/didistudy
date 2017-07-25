# Host: localhost  (Version: 5.5.40)
# Date: 2011-01-14 06:22:41
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
  `date` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='课程表';

#
# Data for table "by_course"
#

INSERT INTO `by_course` VALUES (1,'11',2343240,'1',3,'11c975714cdeafcc0d6a938434866062.jpg','11c975714cdeafcc0d6a',43,'312321','23','2322',23232,3232,'','3',332,0,'2',NULL,NULL),(2,'11',1,'1',0,'f97096a1f8526980e9ec86afc5479f33.jpg','',NULL,NULL,'11',NULL,NULL,NULL,'','',0,0,'',NULL,NULL),(3,'11',11,'1',0,'aba6944263ae1ff179423a1240bc35ee.jpg','',NULL,NULL,'11',NULL,NULL,NULL,'','',0,0,'',NULL,NULL),(4,'11',1,'1',0,'cccef8ee6d40fea5b782b6d0e9b53005.jpg','',NULL,NULL,'11',NULL,NULL,NULL,'','',0,0,'',NULL,1294944612);

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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='课程分类';

#
# Data for table "by_course_type"
#

INSERT INTO `by_course_type` VALUES (41,'英语',0,0,'71fdecb991202f7855bf387e6a71e4b7.jpg'),(42,'历史',41,2,NULL),(43,'早教',0,0,NULL),(44,'地理',41,2,NULL),(45,'化学',43,2,NULL),(47,'课内辅导',0,0,NULL),(48,'小学',47,2,NULL),(49,'初中',47,2,NULL),(50,'一年级',48,4,NULL),(51,'二年级',48,4,NULL),(52,'化学',50,6,NULL),(53,'物理',50,6,NULL),(55,'政治',44,4,NULL),(58,'数学',47,2,NULL),(59,'艺术',0,0,'9b0d2783cc80bd8b284c18f94aa736c4.jpg'),(60,'找附近1',0,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='学生需求表';

#
# Data for table "by_demand_order"
#

INSERT INTO `by_demand_order` VALUES (18,1,'47,初中,初二,物理',NULL,1294948525,2,'fe',2,NULL),(19,1,'47,初中,初二,物理',NULL,1294935679,0,'一对一',2,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COMMENT='功能模块表';

#
# Data for table "by_function_module"
#

INSERT INTO `by_function_module` VALUES (1,'管理员信息管理',0,NULL,NULL,1,0),(2,'查看',1,'Admin','index',1,0),(3,'添加',1,'Admin','addAdmin',1,0),(4,'修改',1,'Admin','editAdmin',1,0),(5,'删除',1,'Admin','delAdmin',1,0),(6,'角色信息管理',0,NULL,NULL,1,0),(7,'查看',6,'Role','index',1,0),(8,'添加',6,'Role','addRole',1,0),(9,'修改',6,'Role','editRole',1,0),(10,'删除',6,'Role','delRole',1,0),(11,'地址设置',0,NULL,NULL,1,0),(12,'查看',11,'Activity','index',1,0),(13,'添加',11,'Activity','addActivity',1,0),(14,'修改',11,'Activity','editActivity',1,0),(15,'删除',11,'Activity','ajaxDelActivity',1,0),(16,'服务中心',0,NULL,NULL,1,0),(17,'查看',16,'Service','index',1,0),(18,'添加',16,'Service','addService',1,0),(19,'修改',16,'Service','editService',1,0),(20,'删除',16,'Service','ajaxDelService',1,0),(21,'小区信息设置',0,NULL,NULL,1,0),(22,'查看',21,'News','index',1,0),(23,'添加',21,'News','addNews',1,0),(24,'修改',21,'News','editNews',1,0),(25,'删除',21,'News','ajaxNews',1,0),(26,'课程信息设置',0,NULL,NULL,1,0),(27,'查看',26,'Course','index',1,0),(28,'添加',26,'Course','addCourse',1,0),(29,'修改',26,'Course','editCourse',1,0),(30,'删除',26,'Course','ajaxDelCourse',1,0),(31,'学生信息设置',0,NULL,NULL,0,0),(32,'查看',31,'Student','index',1,0),(33,'添加',31,'Student','addStudent',1,0),(34,'修改',31,'Student','editStudent',1,0),(35,'删除',31,'Student','ajaxDelStudent',1,0),(36,'老师信息设置',0,NULL,NULL,1,0),(37,'查看',36,'Teacher','index',1,0),(38,'添加',36,'Teacher','addTeacher',1,0),(39,'修改',36,'Teacher','editTeacher',1,0),(40,'删除',36,'Teacher','ajaxDelTeacher',1,0),(41,'2',0,NULL,NULL,1,0),(42,'添加',41,'StudentDemand','addStudentDemand',1,0),(43,'查看',41,'StudentDemand','index',1,0),(44,'修改',41,'StudentDemand','editStudentDemand',1,0),(45,'删除',41,'StudentDemand','ajaxDelStudentDemand',1,0),(46,'1',0,NULL,NULL,1,0),(47,'查看',46,'ParkingLot','index',1,0),(48,'删除',46,'ParkingLot','ajaxDelParkingLot',1,0),(49,'修改',46,'ParkingLot','editParkingLot',1,0),(50,'添加',46,'ParkingLot','addParkingLot',1,0),(51,'3',0,NULL,NULL,1,0),(52,'查看',51,'ChargingItem ','index',1,0),(53,'添加',51,'ChargingItem ','addChargingItem ',1,0),(54,'修改',51,'ChargingItem ','editChargingItem ',1,0),(55,'删除',51,'ChargingItem ','ajaxDelChargingItem ',1,0),(56,'收费标准设置',0,NULL,NULL,1,0),(57,'查看',56,'ChargeStandard','index',1,0),(58,'添加',56,'ChargeStandard','addChargeStandard',1,0),(59,'修改',56,'ChargeStandard','editChargeStandard',1,0),(60,'删除',56,'ChargeStandard','ajaxDelChargeStandard',1,0),(61,'首页公告设置',0,NULL,NULL,1,0),(62,'查看',61,'News','index',1,0),(64,'修改',61,'News','editNews',1,0),(65,'首页轮播图设置',0,NULL,NULL,1,0),(66,'查看',65,'ImgShow','index',1,0),(67,'添加',65,'ImgShow','addimg',1,0),(68,'删除',65,'ImgShow','ajaxDelImg',1,0),(69,'首页栏目设置',0,NULL,NULL,1,0),(70,'查看',69,'IndexMenu','index',1,0),(71,'添加',69,'IndexMenu','addMenu',1,0),(72,'修改',69,'IndexMenu','editMenu',1,0),(73,'删除',69,'IndexMenu','ajaxDelMenu',1,0),(74,'课程分类',0,'','',1,0),(75,'查看',74,'CourseType','index',1,0),(76,'添加',74,'CourseType','addCourseType',1,0),(77,'修改',74,'CourseType','editCourseType',1,0),(78,'删除',74,'CourseType','ajaxDelCourseType',1,0),(79,'订阅词',0,NULL,NULL,1,0),(80,'查看',79,'Keyword','index',1,0),(81,'添加',79,'KeyWord','addKeyWord',1,0),(82,'修改',79,'Keyword','editKeyWord',1,0),(83,'删除',79,'KeyWord','ajaxDelKeyWord',1,0);

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
# Structure for table "by_key_word"
#

DROP TABLE IF EXISTS `by_key_word`;
CREATE TABLE `by_key_word` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `key_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='关键词';

#
# Data for table "by_key_word"
#

INSERT INTO `by_key_word` VALUES (2,'环境好'),(3,'一对一'),(4,'找教师');

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
  `concern_type` varchar(20) DEFAULT NULL COMMENT '关注分类',
  `self_type` varchar(20) DEFAULT NULL COMMENT '自己分类',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "by_member_info"
#

INSERT INTO `by_member_info` VALUES (1,'13123',1,NULL,1,'11111','13750528174','11','11','1213213',1,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e',1294954644,0,'41,42','48,45,48,48,42'),(13,'123',0,NULL,0,NULL,'13750528175',NULL,NULL,NULL,1,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e',1294958390,0,NULL,NULL),(16,'1111',1,NULL,0,'11','1','11','11','11',1,NULL,NULL,'6512bd43d9caa6e02c990b0a82652dca',NULL,0,NULL,NULL),(17,'111122222',1,NULL,0,'fe','e','ewf','ewfef','fewfewf',1,NULL,NULL,'88f122ca938fbd0b88fc75ef4eaab6c8',NULL,0,NULL,NULL),(18,'123456',0,NULL,0,NULL,'13750528176',NULL,NULL,NULL,1,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e',1294957622,0,NULL,NULL),(19,'123456',0,NULL,0,NULL,'13750528177',NULL,NULL,NULL,1,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e',1294958009,0,NULL,NULL),(20,'1123',0,NULL,0,NULL,'13750528178',NULL,NULL,NULL,1,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e',1294960240,0,NULL,NULL),(21,'131',0,NULL,0,NULL,'13750528154',NULL,NULL,NULL,1,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e',1294960974,0,NULL,NULL),(22,'13132',0,NULL,1,NULL,'13750528179',NULL,NULL,'132131',1,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e',1294935852,0,NULL,'45'),(23,'13750528174',1,NULL,0,'13750528174','13750528174','13750528174','13750528174','13750528174',1,NULL,NULL,'fd77a16c59b0bea466c78bc062ec9e31',NULL,0,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='菜单信息表';

#
# Data for table "by_menu_info"
#

INSERT INTO `by_menu_info` VALUES (1,'权限设置',0,NULL,NULL,'ec-users',1,0),(2,'管理员信息',1,'Admin','index','ec-user',1,0),(3,'角色信息',1,'Role','index','br-eye',1,0),(4,'活动管理',0,'Activity','index','ec-cog',1,0),(5,'服务中心',0,'Service','index','im-home3',1,0),(6,'消息管理',0,'News','index','im-office',1,0),(7,'课程信息',20,'Course','index','im-home',1,0),(8,'学生信息',0,'Student','index','im-home2',0,0),(9,'会员列表',22,'Teacher','index','im-user4',1,0),(10,'订单中心',0,NULL,NULL,'im-paragraph-justify',1,0),(11,'需求信息',10,'StudentDemand','index','im-table',1,0),(12,'订单管理',10,'ParkingLot','index','im-table2',1,0),(13,'收费设置',0,NULL,NULL,'im-cogs',1,0),(14,'收费项目',13,'ChargingItem ','index','im-cog',1,0),(15,'收费标准',13,'ChargeStandard','index','im-cog2',1,0),(16,'首页设置',0,NULL,NULL,'im-paragraph-justify',1,0),(17,'公告设置',16,'News','index','im-table',1,0),(18,'轮播图设置',16,'ImgShow','index','im-cog',1,0),(19,'用户指南',16,'IndexMenu','index','im-table',1,0),(20,'课程管理',0,NULL,NULL,'ec-users',1,0),(21,'课程分类',20,'CourseType','index','im-home',1,0),(22,'会员管理',0,NULL,NULL,'ec-users',1,0),(23,'订阅词',20,'KeyWord','index','im-home',1,0);

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
  `course_id` int(11) unsigned DEFAULT NULL COMMENT '课程id',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='订单';

#
# Data for table "by_order_info"
#

INSERT INTO `by_order_info` VALUES (16,18,1,1294953263,NULL,1,0,NULL),(17,18,1,1294953263,NULL,1,0,NULL),(18,18,1,1294953263,NULL,1,0,NULL),(19,18,1,1294953457,NULL,1,0,4),(20,18,1,1294953457,NULL,1,0,1),(21,18,1,1294953457,NULL,1,0,2);

#
# Structure for table "by_organization_info"
#

DROP TABLE IF EXISTS `by_organization_info`;
CREATE TABLE `by_organization_info` (
  `organizition_id` int(11) NOT NULL AUTO_INCREMENT,
  `organizition_name` varchar(22) DEFAULT NULL COMMENT '机构名称',
  `organizition_number` varchar(23) DEFAULT NULL COMMENT '营业证号',
  `organizition_address` varchar(30) DEFAULT NULL COMMENT '地址',
  `organizition_person` varchar(20) DEFAULT NULL COMMENT '联系人',
  `organizition_range` varchar(20) DEFAULT NULL COMMENT '经营范围',
  `organizition_img` varchar(40) DEFAULT NULL COMMENT '机构图片',
  `member_id` int(11) DEFAULT NULL COMMENT '关联会员id',
  PRIMARY KEY (`organizition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='机构表';

#
# Data for table "by_organization_info"
#

INSERT INTO `by_organization_info` VALUES (6,'233','23121','1313','1313','12323','d817eac4d390558613770b7936ac8cf9.jpg',1),(7,'R','ER','ER','RERE','RER','ce2c9f66e0691bbd4659ca3cf7e4383b.jpg',1);

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

INSERT INTO `by_role_info` VALUES (1,'超级管理员','2,3,4,5,75,76,77,78,70,71,72,73,66,67,68,62,64,47,48,49,50,42,43,44,45,37,38,39,40,27,28,29,30,22,23,24,25,17,18,19,20,12,13,14,15,7,8,9,10,80,81,82,83','所有权限'),(2,'测试','2,3,4,5','……………………');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='教师表';

#
# Data for table "by_teacher"
#

INSERT INTO `by_teacher` VALUES (2,'',0,NULL,0,'','','',NULL,NULL,NULL,1,NULL,NULL),(3,'1123112321321',1,'XX',0,'efewf','fewf','wfew','fewfe','fefef','ewfewfwefew',1,NULL,NULL),(4,'11',0,NULL,1,'11','','1','11','11','11',1,NULL,NULL),(5,'11',0,NULL,1,'11','','11','11','11','11',1,NULL,NULL),(6,'11',0,NULL,1,'1','','11','11','11','11',1,NULL,NULL),(7,'11',0,NULL,1,'1','','11','1','1','11',1,NULL,NULL),(9,'1',0,NULL,0,'','11','',NULL,NULL,NULL,1,'fd492229322b7c2d945fc694d2f04b35.jpg','745de973c05e81945ded2df1ac125236.jpg'),(10,'789898',0,NULL,0,'','98999','',NULL,NULL,NULL,1,'bcf7aba29747108ad815795c8619e2a7.jpg',NULL),(11,'we',0,NULL,0,'','ere','',NULL,NULL,NULL,1,'ea578ede5908fa9b33896e80cd75f80c.jpg','9451a022be64cf20d7c632ff1c0978a5.jpg'),(12,'FE',0,NULL,0,'','FEFEF','',NULL,NULL,NULL,1,'76eac97f94e48fe51403f290836abc19.jpg','53eced624f4e2e49cfce38e0c6f0d9c8.jpg');

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

