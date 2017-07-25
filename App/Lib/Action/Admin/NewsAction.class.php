<?php


class NewsAction extends BaseAction
{

    //模型
    private $News_model;
    //发送对象
    private $News_type_array = array(
        1 => '所有',
        2 => '老师',
        3 => '学生',
    );

    //方法关联
    protected $method_relation = array(
        'index' => array('detailInfo'),
        'addNews' => array('ajaxAddNews'),
        'editNews' => array('ajaxEditNews'),
    );

    public function __construct()
    {
        parent::__construct();
        $this->News_model = D('NewsInfo'); //实例化模型
    }

    /**
     * 列表
     */
    public function index()
    {

        $where = array(); //SQL查询条件
        $url_where = array(); //url参数


        //消息
        $News_name = trim(I('get.p_News_name'));

        if (strlen($News_name) != 0) {

            $where['title'] = array('like', '%' . $News_name . '%');
            $url_where['title'] = $News_name;
        }

        $p = trim(I('get.page')); //当前页

        if (!is_numeric($p) || $p <= 0) {
            $p = 1;
        }

        $count = $this->News_model->where($where)->count(); //总条数

        $row = 20; //显示的行数

        $pages = intval($count / $row); //总页数
        if ($count % $row != 0) {
            $pages++;
        }

        if ($p > $pages || $pages <= 0) {
            $p = $pages;
        }

        $url = U('Admin/News/index', $url_where); //跳转URL

        if (is_null($count)) {
            $count = 0;
        }

        //page: 当前页 pages: 总页数 count: 总行数 url: 链接
        $page_arr = array('page' => $p, 'pages' => $pages, 'count' => $count, 'url' => $url);

        $r = ($p - 1) <= 0 ? 0 : ($p - 1);
        $first = $r * $row;

        $News = $this->News_model
            ->where($where)->order('news_date desc')->limit($first, $row)->select();


        $this->page_arr = $page_arr;

        foreach ($News as $key => $value) {

            $News[$key]['send_object'] = $this->News_type_array[$value['send_object']];
        }
        $this->News_list = $News;
        //var_dump($this->News_list);exit();
        $this->by_p_title = '消息信息设置';
        $this->display();
    }

    public function detailInfo()
    {

        $refererurl = I('server.HTTP_REFERER');

        $News_id = trim(I('get.news_id'));
        if (!is_numeric($News_id) || $News_id <= 0) {
            $this->redirect($refererurl);
            exit();
        }

        $News = $this->News_model->where(array('news_id' => $News_id))->find();

        if (empty($News)) {
            $this->redirect($refererurl);
            exit();
        }


        $News['send_object'] = $this->News_type_array[$News['send_object']];
        $this->customer = $News;
        $this->by_p_title = '消息信息';
        // echo "<pre>";
        // echo "<meta charset='utf-8'>";
        // var_dump($News);
        //exit();

        $this->display();
    }

    /**
     * 添加
     */
    public function addNews()
    {


        $this->news_type = $this->News_type_array;
        $this->by_p_title = '发送消息信息';

        $this->display('addEditNews');
    }

    public function ajaxAddNews()
    {
        if ($this->isPost()) {

            $data = array();

            //标题
            $title = trim(I('post.title'));

            if (empty($title)) {
                echo json_encode(array('status' => 0, 'info' => '请输入标题'));
                exit();
            }


            $data['title'] = $title;
            //内容
            $content = trim(I('post.content'));

            if (empty($content)) {
                echo json_encode(array('status' => 0, 'info' => '请输入内容'));
                exit();
            }

            $data['news_date'] = time();
            $data['content'] = $content;
            //发送对象 1所有 2 老师 3 学生
            $send_object = trim(I('post.send_object'));

            if ($send_object == 0) {
                echo json_encode(array('status' => 0, 'info' => '请选择发送对象'));
                exit();
            }


            $data['send_object'] = $send_object;

            $re = $this->News_model->add($data);
            if ($re) {
                echo json_encode(array('status' => 1, 'info' => '添加成功', 'url' => U('Admin/News/index')));
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
    public function editNews()
    {


        $News_id = trim(I('get.News_id'));

        $News = $this->News_model->where(array('News_id' => $News_id))->find();

        if (!empty($News)) {
            $this->default_value = $News['send_object'];
        }
        $this->customer = $News;
        $this->news_type = $this->News_type_array;
        $this->by_p_title = '编辑消息信息';
        $this->display('addEditNews');
    }

    public function ajaxEditNews()
    {
        if ($this->isPost()) {

            $News_id = trim(I('post.news_id'));

            if (!is_numeric($News_id) || $News_id <= 0) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }

            $News = $this->News_model->where(array('news_id' => $News_id))->find();

            if (empty($News)) {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
                exit();
            }
            $data = array();


            //标题
            $title = trim(I('post.title'));

            if (empty($title)) {
                echo json_encode(array('status' => 0, 'info' => '请输入标题'));
                exit();
            }


            $data['title'] = $title;
            //内容
            $content = trim(I('post.content'));

            if (empty($content)) {
                echo json_encode(array('status' => 0, 'info' => '请输入内容'));
                exit();
            }

            $data['news_date'] = time();
            $data['content'] = $content;
            //发送对象 1所有 2 老师 3 学生
            $send_object = trim(I('post.send_object'));

            if ($send_object == 0) {
                echo json_encode(array('status' => 0, 'info' => '请选择发送对象'));
                exit();
            }
            $data['send_object'] = $send_object;
            $re = $this->News_model->where(array('news_id' => $News_id))->save($data);
            if ($re !== false) {
                echo json_encode(array('status' => 1, 'info' => '编辑成功', 'url' => U('Admin/News/index')));
            } else {
                echo json_encode(array('status' => 0, 'info' => '编辑失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => '非法访问'));
        }
    }

    /**
     * 删除
     */
    public function ajaxDelNews()
    {

        $rq_id = trim(I('get.id'));

        $rq_id_array = explode(',', $rq_id);

        if (count($rq_id_array) == 0) {
            echo json_encode(array('status' => 0, 'info' => '删除失败1'));
            exit();
        }

        $count = $this->News_model->where(array('news_id' => array('in', $rq_id_array)))->count();

        if (count($rq_id_array) != $count) {
            echo json_encode(array('status' => 0, 'info' => '删除失败2'));
            exit();
        }

        //开启事务
        $this->News_model->startTrans();
        foreach ($rq_id_array as $id) {
            $rq = $this->News_model->where(array('news_id' => $id))->delete();

            if (empty($rq)) {
                $this->News_model->rollback();
                echo json_encode(array('status' => 0, 'info' => '删除失败3'));
                exit();
            }


        }

        $this->News_model->commit(); //提交事务
        echo json_encode(array('status' => 1, 'info' => '删除成功'));
    }


}
