<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Capture_model
 *
 * @author joe
 */
class Capture_model extends CI_Model {

    private $capture_url = 'http://www.23wx.com/';

    public function __construct() {
        $this->load->database();
    }

    public function getBook($book_id) {
        $book_url = $this->capture_url . 'book/' . $book_id;
        $this->load->library('pquery', array('url' => $book_url));

        $item = $this->pquery->get_book();
        return $item;
    }

    public function getChapterList($url) {
        $this->load->library('pquery', array('url' => $url));
        return $this->pquery->get_chapter_list();
    }

    public function getChapter($url) {
        $this->load->library('pquery');
        return $this->pquery->get_chapter($url);

    }

    public function check_book($id) {
        $this->db->select('story_id');
        $this->db->where('book_id',$id);
        $query=$this->db->get('update');
        return $query->row_array();
    }
}
