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
        $data['user']   = '';
        $data['title']  = $this->title['value'];
        $data['update'] = $this->update->get(10);

        $this->load->view('main', $data);
    }

    public function login() {

    }

    public function logout() {

    }

    public function register() {

    }
}
