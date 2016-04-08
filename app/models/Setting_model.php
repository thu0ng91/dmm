<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-6
 * Time: 下午2:33
 */
class Setting_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get($title = null) {
        if ($title == false) {
            $query = $this->db->get('setting');
            return $query->result_array();
        }
        //否则获取id的用户
        $query = $this->db->get_where('setting', array('title' => $title));
        return $query->row_array();
    }

}