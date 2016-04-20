<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-8
 * Time: 下午4:12
 */
class Category extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Category_model', 'category');
        $this->load->model('story_model', 'story');
    }

    function index($id, $page = 0) {
        if (!$id) {
            show_error('请输入分类号！！！');
            return;
        }

        $this->load->library('pagination');

        //每页分几项
        $per_page = 20;
        //分页配置
        $this->config->load('pagination');
        $config['base_url']   = site_url('category/'.$id);
        $config['total_rows'] = $this->story->all(array('category' => $id));
        $config['per_page']   = $per_page;
        $config['cur_page']   = $page;
        //调用分页
        $this->pagination->initialize($config);

        $category = $this->category->get($id);

        $data['title']       = $category['title'];
        $data['categories']  = $this->category->get();
        $data['stories']     = $this->story->get(null, $per_page, $page, array('category' => $id));
        $data['category_id'] = $id;
        $data['pages']       = $this->pagination->create_links(); //创建分页

        $this->load->view('header', $data);
        $this->load->view('category');
        $this->load->view('footer');
    }

}