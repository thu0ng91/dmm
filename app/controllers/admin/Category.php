<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-6
 * Time: 下午4:46
 */
class Category extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('category_model', 'category');
    }

    function index() {
        $data['categorys'] = $this->category->get();
        $this->load->view('admin/category', $data);
    }

    function add() {
        $id    = $this->input->post('id');
        $title = $this->input->post('title');
        
        if (!$title) {
            show_error('分类标题不能为空，请返回重新填写！！！');
        }

        $category_data = array(
            'id'    => $id,
            'title' => $title
        );
        $this->category->add($category_data);
        redirect('admin/category');
    }

}