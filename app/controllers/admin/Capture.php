<?php

/**
 * Description of Capture
 *
 * @author joe
 */
class Capture extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('capture_model', 'capture');
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    function index() {
        $data['captures'] = $this->capture->get(null, 'id,site_title');
        $this->load->view('admin/capture', $data);
    }

    function get() {
        
    }

    function test($id) {
        $book = $this->capture->getBookInfo($id);
        $chapter_list = $this->capture->getChapterList();
        $chapter = substr($this->capture->getChapter($book['chapter_list_url'] . $chapter_list[0]['url']), 0, 250);

        $data['book'] = $book;
        $data['chapter_list'] = $chapter_list;
        $data['chapter'] = $chapter;

        $this->load->view('admin/capture/test', $data);
    }

    function edit($id = null) {
        $data = array();
        if ($id) {
            $data['capture'] = $this->capture->get($id);
        }
        $this->load->view('admin/capture/add', $data);
    }

    function add() {
        $capture = array(
            'id' => $this->input->post('id'),
            'site_title' => $this->input->post('site_title'),
            'site_url' => $this->input->post('site_url'),
            'book_url' => $this->input->post('book_url'),
            'book_title' => $this->input->post('book_title'),
            'book_author' => $this->input->post('book_author'),
            'book_desc' => $this->input->post('book_desc'),
            'book_img' => $this->input->post('book_img'),
            'chapter_list_url' => $this->input->post('chapter_list_url'),
            'chapter_url_title' => $this->input->post('chapter_url_title'),
            'chapter_url' => $this->input->post('chapter_url'),
            'chapter_content' => $this->input->post('chapter_content'),
            'test_id' => $this->input->post('test_id')
        );
        
        $this->db->replace('capture',$capture);
        redirect('admin/capture');
    }

}
