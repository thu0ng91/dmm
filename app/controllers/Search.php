<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-20
 * Time: 下午3:44
 */
class Search extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('story_model', 'story');
        $this->load->model('chapter_model', 'chapter');
        $this->load->model('Category_model', 'category');
    }

    public function index($page = 0) {

        $search = $this->input->get('search');
        if (!$search) show_error('请输入搜索内容');
        $where = "`author` like '%{$search}%' or `title` like '%{$search}%'";

        $this->load->library('pagination');

        //每页分几项
        $per_page = 20;
        //分页配置
        $this->config->load('pagination');
        $config['base_url']           = site_url('search');
        $config['total_rows']         = $this->story->all($where);
        $config['reuse_query_string'] = true;
        $config['per_page']           = $per_page;
        //调用分页
        $this->pagination->initialize($config);

        $data['title']      = '搜索：' . $search;
        $data['categories'] = $this->category->get();
        $data['stories']    = $this->story->get(null, $per_page, $page, $where);
        $data['search']     = $search;
        $data['pages']      = $this->pagination->create_links(); //创建分页

        $this->load->view('header', $data);
        $this->load->view('category');
        $this->load->view('footer');
    }

}