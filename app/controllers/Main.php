<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('setting_model', 'setting');
        $this->title = $this->setting->get('title');
    }

    public function index() {
        $this->load->model('update_model', 'update');
        $this->load->model('Category_model', 'category');
        $this->load->model('story_model', 'story');

        $data['title']     = $this->title;
        $data['update']    = $this->story->get(null,5,0,null,'last_update','DESC');
        $data['categories'] = $this->category->get();
        $data['stories']    = $this->story->get(null,20);

        $this->load->view('main', $data);
    }

    public function login() {

    }

    public function logout() {

    }

    public function register() {

    }
}
