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
        $this->load->model('setting_model', 'setting');
    }

    function index($id) {
        if (!$id) {
            show_error('请输入分类号！！！');
            return;
        }

        $per_page = $this->setting->get('per_page');
        $category = $this->category->get($id);

        $data['stories']     = $this->story->get(null, $per_page, 0, array('category' => $id));
        $data['title']       = $category['title'];
        $data['categories']  = $this->category->get();
        $data['category_id'] = $id;
        $data['all']         = $this->story->all(array('category' => $id));
        $data['per_page']    = $per_page;

        $this->load->view('header', $data);
        $this->load->view('category');
        $this->load->view('footer');

    }

    function page($id, $page = 0) {
        if (!$id) {
            show_error('请输入分类号！！！');
            return;
        }

        $per_page = 20;

        $data['stories'] = $this->story->get(null, $per_page, $page, array('category' => $id));
        $this->load->view('list', $data);
    }

}