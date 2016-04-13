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
    }

    function index($id) {
        if (!$id) {
            show_error('请输入分类号！！！');
            return;
        }

        $this->load->model('update_model', 'update');
        $this->load->model('Category_model', 'category');
        $this->load->model('story_model', 'story');

        $category = $this->category->get($id);

        $data['user']      = '';
        $data['title']     = $category['title'];
        $data['update']    = $this->update->get(10);
        $data['categorys'] = $this->category->get();
        $data['story']     = $this->story->get(null, 20,0,array('category'=>$id));
        $data['id']        = $id;

        $this->load->view('main', $data);
    }

}