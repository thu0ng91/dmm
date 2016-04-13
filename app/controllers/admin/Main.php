<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public $title='';

    function __construct() {
        parent::__construct();
        $this->load->model('setting_model');
        $this->title=$this->setting_model->get('title');
    }

    public function index() {
        $data['user']='';
        $data['title']=$this->title;
        $this->load->view('admin/main',$data);
    }
}
