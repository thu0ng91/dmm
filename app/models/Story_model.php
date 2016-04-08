<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-7
 * Time: 下午4:17
 */
class Story_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get($id=null,$num=null,$offset=null) {
        if ($id) {
            return $this->db->get_where('story',array('id'=>$id))->row_array();
        }

        if ($num || $offset) {
            $this->db->limit($num,$offset);
        }

        return $this->db->get('story')->result_array();
    }
}