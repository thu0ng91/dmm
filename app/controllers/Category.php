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
        $this->load->model('setting_model', 'setting');
        $this->title = $this->setting->get('title');
    }

    function index($id) {
        if (!$id) {
            show_error('请输入分类号！！！');
            return;
        }
    }

}