<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 15-11-4
 * Time: 上午8:33
 */
class Setting extends CI_Controller {

    private $user;

    function __construct() {
        parent::__construct();
        $this->load->model('setting_model');
    }

    function index() {
        $this->page(0);
    }

    function page($page = 0) {
        $this->load->library('pagination');

        $config['base_url'] = SITEPATH . '/admin/setting/page/';
        $config['total_rows'] = $this->setting_model->get_setting_num();

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['settings'] = $this->setting_model->get_page($page);

        $this->load->view('admin/setting', $data);
    }

    function create($id=null) {
        $data=array();
        if ($id) {
            $setting=$this->setting_model->get_setting($id);

            $data['setting']=$setting;
        }

        $this->load->view('admin/setting_add',$data);
    }

    function edit() {
        $id=$this->input->post('id')?$this->input->post('id'):0;

        $sql_data=array(
            'title' => $this->input->post('name'),
            'desc' => $this->input->post('desc'),
            'value' => $this->input->post('value')
        );

        if ($id==0) {
            $sql_data['id']=$id;
            $this->db->insert('setting',$sql_data);
        }else {
            $field = $this->input->post('field');
            if ($field) {
                $value = $this->input->post('value');
                $this->db->set($field, $value);
            } else {
                $this->db->set($sql_data);
            }
            $this->db->where('id', $id);
            $this->db->update('setting');
        }
        redirect('admin/setting');
    }
}