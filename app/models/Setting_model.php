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

    public function get($title = null, $id = null) {
        if ($title) {
            $query = $this->db->get_where('setting', array('title' => $title))->row_array();
            return $query['value'];
        }

        if ($id) {
            $query = $this->db->get_where('setting', array('title' => $title));
            return $query->row_array();
        }

        return $this->db->get('setting')->result_array();
    }

}