<?php


class ResidentialQuartersAction extends BaseAction
{

    private $residential_quarters_model; //模型
    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo', 'ajaxGetInstituition'),
        'addResidentialQuarters' => array('ajaxAddResidentialQuarters', 'ajaxGetInstituition', 'ajaxUploadImg'),
        'editResidentialQuarters' => array('ajaxEditResidentialQuarters', 'ajaxGetInstituition', 'ajaxUploadImg'),
    );

    public function __construct()
    {
        parent::__construct();

        $this->residential_quarters_model = D('ResidentialQuarters'); //实例化
    }

    /**
     * 列表
     */
    public function index()
    {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数

        $where['is_effective'] = 1;

        //小区名称
        $residential_quarters_name = trim(I('get.p_residential_quarters'));

        if (strlen($residential_quarters_name) != 0) {
            $residential_quarters_name_str = str_replace('_', '\_', $residential_quarters_name);
            $where['residential_quarters'] = array('like', '%' . $residential_quarters_name_str . '%');
            $url_where['p_residential_quarters'] = $residential_quarters_name;
        }

        //所属机构
        $par_ins = trim(I('get.p_par_ins'));
        $instituition_id = trim(I('get.p_instituition_id'));

        //一级机构
        $ins_list = D('Instituition')->field('ins_id, instituition_name')->where(array('parent_id' => 0, 'is_effective' => 1))->select();
        $this->ins_list = $ins_list;

        $ins = D('Instituition')->where(array('ins_id' => $par_ins, 'is_effective' => 1))->find();

        if (!empty($ins)) {
            //二级机构
            $ins_sub_list = D('Instituition')->field('ins_id, instituition_name')->where(array('parent_id' => $par_ins, 'is_effective' => 1))->select();
            $this->ins_sub_list = $ins_sub_list;

            $sub_ins = D('Instituition')->where(array('ins_id' => $instituition_id, 'is_effective' => 1))->find();

            if (empty($sub_ins)) {
                $sub_ins = D('Instituition')->field('ins_id')->where(array('parent_id' => $par_ins, 'is_effective' => 1))->select();
                foreach ($sub_ins as $val) {
                    $sub_ins_id[] = $val['ins_id'];
                }
                $where['instituition_id'] = array('in', $sub_ins_id);
            } else {
                $where['instituition_id'] = $instituition_id;
            }
        }

        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->residential_quarters_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/ResidentialQuarters/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $residential_quarters = $this->residential_quarters_model
            ->field('rq_id, residential_quarters, instituition_id, rq_developers, floor_area, covers_area, total_household')
            ->where($where)->limit($first, $row)->select();

        foreach ($residential_quarters as $key => $val) {
            $instituition_name = D('Instituition')->where(array('ins_id' => $val['instituition_id'], 'is_effective' => 1))->getField('instituition_name');
            $residential_quarters[$key]['instituition_name'] = $instituition_name;
        }

        $this->page_arr = $page_arr;
        $this->residential_quarters = $residential_quarters;
        $this->by_p_title = '消息中心';
        $this->display();
    }

    /**
     * 查看
     */
    public function detailInfo()
    {
        $refererurl = I('server.HTTP_REFERER');

        $rq_id = trim(I('get.rq_id'));

        if (!is_numeric($rq_id) || $rq_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $residential_quarters = $this->residential_quarters_model->where(array('rq_id' => $rq_id, 'is_effective' => 1))->find();

        if (empty($residential_quarters)) {
            $this->redirect($refererurl);
            exit();
        }

        $instituition = D('Instituition')->field('parent_id, instituition_name')->where(array('ins_id' => $residential_quarters['instituition_id'], 'is_effective' => 1))->find();
        $residential_quarters['instituition_name'] = $instituition['instituition_name'];
        $par_instituition_name = D('Instituition')->where(array('ins_id' => $instituition['parent_id'], 'is_effective' => 1))->getField('instituition_name');
        $residential_quarters['par_instituition_name'] = $par_instituition_name;

        $residential_quarters['rq_picture'] = C('UPLOAD_RESIDENTIAL_QUARERS_IMG_DIR') . '/' . $residential_quarters['rq_picture'];

        $this->residential_quarters = $residential_quarters;
        $this->by_p_title = '小区信息';
        $this->display();
    }

    /**
     * 添加
     */
    public function addResidentialQuarters()
    {

        $ins_list = D('Instituition')->field('ins_id, instituition_name')->where(array('parent_id' => 0, 'is_effective' => 1))->select();

        $this->ins_list = $ins_list;
        $this->by_p_title = '添加小区信息';
        $this->display('addEditResidentialQuarters');
    }

    public function ajaxAddResidentialQuarters()
    {

        if ($this->isPost()) {

            $data = array();

            //小区名称
            $residential_quarters = trim(I('post.p_residential_quarters'));

            if (strlen($residential_quarters) <= 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入小区名称'));
                exit();
            }
            $data['residential_quarters'] = $residential_quarters;

            //所属机构
            $instituition_id = trim(I('post.p_instituition_id'));

            if ($instituition_id == 0) {
                echo json_encode(array('status' => 0, 'info' => '请选择所属机构'));
                exit();
            }

            $re = D('Instituition')->where(array('ins_id' => $instituition_id, 'parent_id' => array('neq', 0), 'is_effective' => 1))->find();

            if (empty($re)) {
                echo json_encode(array('status' => 0, 'info' => '请选择所属机构'));
                exit();
            }
            $data['instituition_id'] = $instituition_id;

            //开发商
            $rq_developers = trim(I('post.p_rq_developers'));

            if (strlen($rq_developers) > 0) {
                $data['rq_developers'] = $rq_developers;
            }

            //建筑面积
            $floor_area = trim(I('post.p_floor_area'));

            if (is_numeric($floor_area) && $floor_area > 0) {
                $data['floor_area'] = $floor_area;
            }

            //占地面积
            $covers_area = trim(I('post.p_covers_area'));

            if (is_numeric($covers_area) && $covers_area > 0) {
                $data['covers_area'] = $covers_area;
            }

            //小区总户数
            $total_household = trim(I('post.p_total_household'));

            if (is_numeric($total_household) && $total_household > 0) {
                $data['total_household'] = $total_household;
            }

            //车位数量
            $parking_lot_number = trim(I('post.p_parking_lot_number'));

            if (is_numeric($parking_lot_number) && $parking_lot_number > 0) {
                $data['parking_lot_number'] = $parking_lot_number;
            }

            //绿化率
            $greening_rate = trim(I('post.p_greening_rate'));

            if (is_numeric($greening_rate) && $greening_rate > 0) {
                $data['greening_rate'] = $greening_rate;
            }

            //容积率
            $volume_rate = trim(I('post.p_volume_rate'));

            if (is_numeric($volume_rate) && $volume_rate > 0) {
                $data['volume_rate'] = $volume_rate;
            }

            //小区概况
            $general_situation = trim(I('post.p_general_situation'));

            if (strlen($general_situation) > 0) {
                $data['general_situation'] = $general_situation;
            }

            //小区地址
            $address = trim(I('post.p_address'));

            if (strlen($address) > 0) {
                $data['address'] = $address;
            }

            //楼栋数量
            $building_number = trim(I('post.p_building_number'));

            if (is_numeric($building_number) && $building_number > 0) {
                $data['building_number'] = $building_number;
            }

            //小区图片
            $rq_picture = trim(I('post.p_rq_picture'));

            if (strlen($rq_picture) > 0) {
                $tmp_dir = C('UPLOAD_RESIDENTIAL_QUARERS_IMG_TMP_DIR');
                $admin_id = session('by_p_admin_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $rq_picture;
                if (is_file($tmp_src)) {
                    $data['rq_picture'] = $rq_picture;
                }
            }

            //备注
            $remark = trim(I('post.p_remark'));

            if (strlen($remark) > 0) {
                $data['remark'] = $remark;
            }

            $data['is_effective'] = 1;

            $re = $this->residential_quarters_model->add($data);

            if ($re) {
                if (strlen($data['rq_picture'])) {
                    $dir = C('UPLOAD_RESIDENTIAL_QUARERS_IMG_DIR') . '/' . $rq_picture;
                    rename($tmp_src, $dir);
                }
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/ResidentialQuarters/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '添加失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 编辑
     */
    public function editResidentialQuarters()
    {

        $refererurl = I('server.HTTP_REFERER');

        $rq_id = trim(I('get.rq_id'));

        if (!is_numeric($rq_id) || $rq_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $residential_quarters = $this->residential_quarters_model->where(array('rq_id' => $rq_id, 'is_effective' => 1))->find();

        if (empty($residential_quarters)) {
            $this->redirect($refererurl);
            exit();
        }

        //一级机构
        $ins_list = D('Instituition')->field('ins_id, instituition_name')->where(array('parent_id' => 0, 'is_effective' => 1))->select();
        $this->ins_list = $ins_list;

        //二级机构
        $rq_parent_id = D('Instituition')->where(array('ins_id' => $residential_quarters['instituition_id'], 'is_effective' => 1))->getField('parent_id');
        $residential_quarters['rq_parent_id'] = $rq_parent_id;
        $ins_sub_list = D('Instituition')->field('ins_id, instituition_name')->where(array('parent_id' => $rq_parent_id, 'is_effective' => 1))->select();
        $this->ins_sub_list = $ins_sub_list;

        $this->residential_quarters = $residential_quarters;
        $this->by_p_title = '编辑小区信息';
        $this->display('addEditResidentialQuarters');
    }

    public function ajaxEditResidentialQuarters()
    {
        if ($this->isPost()) {

            $rq_id = trim(I('post.rq_id'));

            if (!is_numeric($rq_id) || $rq_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            $residential_quarters = $this->residential_quarters_model->where(array('rq_id' => $rq_id, 'is_effective' => 1))->find();

            if (empty($residential_quarters)) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            $data = array();

            //小区名称
            $residential_quarters = trim(I('post.p_residential_quarters'));

            if (strlen($residential_quarters) <= 0) {
                echo json_encode(array('status' => 0, 'info' => '请输入小区名称'));
                exit();
            }
            $data['residential_quarters'] = $residential_quarters;

            //所属机构
            $instituition_id = trim(I('post.p_instituition_id'));

            if ($instituition_id == 0) {
                echo json_encode(array('status' => 0, 'info' => '请选择所属机构'));
                exit();
            }

            $re = D('Instituition')->where(array('ins_id' => $instituition_id, 'parent_id' => array('neq', 0), 'is_effective' => 1))->find();

            if (empty($re)) {
                echo json_encode(array('status' => 0, 'info' => '请选择所属机构'));
                exit();
            }
            $data['instituition_id'] = $instituition_id;

            //开发商
            $rq_developers = trim(I('post.p_rq_developers'));
            $data['rq_developers'] = $rq_developers;

            //建筑面积
            $floor_area = trim(I('post.p_floor_area'));

            if (!is_numeric($floor_area) || $floor_area <= 0) {
                $floor_area = 0;
            }
            $data['floor_area'] = $floor_area;

            //占地面积
            $covers_area = trim(I('post.p_covers_area'));

            if (!is_numeric($covers_area) || $covers_area <= 0) {
                $covers_area = 0;
            }
            $data['covers_area'] = $covers_area;

            //小区总户数
            $total_household = trim(I('post.p_total_household'));

            if (!is_numeric($total_household) || $total_household <= 0) {
                $total_household = 0;
            }
            $data['total_household'] = $total_household;

            //车位数量
            $parking_lot_number = trim(I('post.p_parking_lot_number'));

            if (!is_numeric($parking_lot_number) || $parking_lot_number <= 0) {
                $parking_lot_number = 0;
            }
            $data['parking_lot_number'] = $parking_lot_number;

            //绿化率
            $greening_rate = trim(I('post.p_greening_rate'));

            if (!is_numeric($greening_rate) || $greening_rate <= 0) {
                $greening_rate = 0;
            }
            $data['greening_rate'] = $greening_rate;

            //容积率
            $volume_rate = trim(I('post.p_volume_rate'));

            if (!is_numeric($volume_rate) || $volume_rate <= 0) {
                $volume_rate = 0;
            }
            $data['volume_rate'] = $volume_rate;

            //小区概况
            $general_situation = trim(I('post.p_general_situation'));
            $data['general_situation'] = $general_situation;

            //小区地址
            $address = trim(I('post.p_address'));
            $data['address'] = $address;

            //楼栋数量
            $building_number = trim(I('post.p_building_number'));
            $data['building_number'] = $building_number;

            //小区图片
            $rq_picture = trim(I('post.p_rq_picture'));

            if (strlen($rq_picture) > 0 && $rq_picture != $residential_quarters['rq_picture']) {
                $tmp_dir = C('UPLOAD_RESIDENTIAL_QUARERS_IMG_TMP_DIR');
                $admin_id = session('by_p_admin_id');
                $tmp_dir = str_replace('$admin_id', $admin_id, $tmp_dir);

                $tmp_src = $tmp_dir . '/' . $rq_picture;
                if (is_file($tmp_src)) {
                    $data['rq_picture'] = $rq_picture;
                }
            }

            //备注
            $remark = trim(I('post.p_remark'));
            $data['remark'] = $remark;

            $re = $this->residential_quarters_model->where(array('rq_id' => $rq_id, 'is_effective' => 1))->save($data);

            if ($re !== false) {
                if (strlen($rq_picture) > 0 && $rq_picture != $residential_quarters['rq_picture']) {
                    $old_dir = C('UPLOAD_RESIDENTIAL_QUARERS_IMG_DIR') . '/' . $residential_quarters['rq_picture'];
                    unlink($old_dir);
                    $dir = C('UPLOAD_RESIDENTIAL_QUARERS_IMG_DIR') . '/' . $rq_picture;
                    rename($tmp_src, $dir);
                }
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/ResidentialQuarters/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
            }
        } else {

        }
    }

    /**
     * 获取下级机构
     */
    public function ajaxGetInstituition()
    {

        if ($this->isAjax()) {

            $ins_id = trim(I('get.ins_id'));

            if (!is_numeric($ins_id) || $ins_id <= 0) {
                echo json_encode(array('status' => 0));
                exit();
            }

            $re = D('Instituition')->where(array('ins_id' => $ins_id, 'is_effective' => 1))->find();

            if (empty($re)) {
                echo json_encode(array('status' => 0));
                exit();
            }

            $ins_list = D('Instituition')->field('ins_id, instituition_name')->where(array('parent_id' => $ins_id, 'is_effective' => 1))->select();

            if (empty($ins_list)) {
                echo json_encode(array('status' => 0));
                exit();
            }

            echo json_encode(array('status' => 1, 'data' => $ins_list));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    /**
     * 上传图片
     */
    public function ajaxUploadImg()
    {
        if (array_key_exists("rq_img", $_FILES) && $_FILES["rq_img"]["error"] == UPLOAD_ERR_OK) {

            $sc_dir = C('UPLOAD_RESIDENTIAL_QUARERS_IMG_TMP_DIR');
            if (strlen($sc_dir) == 0) {
                echo json_encode(array('status' => 0, 'info' => '上传失败'));
                exit();
            }

            $admin_id = session('by_p_admin_id');
            $sc_dir = str_replace('$admin_id', $admin_id, $sc_dir);
            $dir_array = explode('/', $sc_dir);

            $dir_str = $dir_array[0];
            for ($i = 0; $i < count($dir_array); $i++) {
                if (!is_dir($dir_str)) {
                    mkdir($dir_str);
                }
                $dir = $dir_array[$i + 1];
                $dir_str = $dir_str . "/" . $dir;
            }
            $type = $_FILES["rq_img"]["type"];

            if ($type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif') {
                echo json_encode(array('status' => 0, 'info' => '图片必须为（jpg,jpeg,png,gif）的类型'));
                exit();
            }

            $size = $_FILES["rq_img"]["size"];

            if ($size > 2 * 1024 * 1024) {
                echo json_encode(array('status' => 0, 'info' => '图片大小不能大于2M'));
                exit();
            }


            $org = $_FILES["rq_img"]["name"];
            $ext_array = explode('.', $org);
            $ext = strtolower($ext_array[count($ext_array) - 1]);

            $name = "";
            $i = 0;
            while ($i <= 10) {
                $name = $name . rand(0, 9);
                $i++;
            }
            $name = date("YmdHis", time()) . $name;

            $filename = $dir_str . md5($name) . '.' . $ext;

            $re = move_uploaded_file($_FILES["rq_img"]["tmp_name"], $filename);

            if ($re) {
                echo json_encode(array('status' => 1, 'img_src' => md5($name) . '.' . $ext));
            } else {
                echo json_encode(array('status' => 0, 'info' => '上传失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '上传失败'));
        }
    }

    /**
     * 删除
     */
    public function ajaxDelResidentialQuarters()
    {

        $rq_id = trim(I('get.id'));

        $rq_id_array = explode(',', $rq_id);

        if (count($rq_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        $count = $this->residential_quarters_model->where(array('rq_id' => array('in', $rq_id_array), 'is_effective' => 1))->count();

        if (count($rq_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit();
        }

        //开启事务
        $this->residential_quarters_model->startTrans();
        foreach ($rq_id_array as $id) {
            $rq = $this->residential_quarters_model->field('rq_id, rq_picture')->where(array('rq_id' => $id, 'is_effective' => 1))->find();

            if (empty($rq)) {
                $this->residential_quarters_model->rollback();
                echo json_encode(array('status' => 0, 'info' => '删除失败'));
                exit();
            }

            $re = $this->residential_quarters_model->where(array('rq_id' => $id, 'is_effective' => 1))->save(array('is_effective' => 0));
            if ($re === false) {
                $this->residential_quarters_model->rollback();
                echo json_encode(array('status' => 0, 'info' => '删除失败'));
                exit();
            } else {
                if (strlen($rq['rq_picture']) > 0) {
                    $dir = C('UPLOAD_RESIDENTIAL_QUARERS_IMG_DIR') . '/' . $rq['rq_picture'];
                    unlink($dir);
                }
            }
        }

        $this->residential_quarters_model->commit(); //提交事务
        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }

}
