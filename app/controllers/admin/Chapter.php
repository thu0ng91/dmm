<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-14
 * Time: 上午11:01
 */
class Chapter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('story_model', 'story');
        $this->load->model('chapter_model', 'chapter');
    }

    function index($story_id = null) {
        if ($story_id) {
            $data['story'] = $this->story->get($story_id);
        } else {
            $data['storys'] = $this->story->get();
        }
        $this->load->view('admin/chapter', $data);
    }

    function add() {
        $chapter = array(
            'id'       => $this->input->post('id'),
            'title'    => $this->input->post('title'),
            'content'  => $this->input->post('content'),
            'story_id' => $this->input->post('story_id')
        );

        if (!$chapter['title']) show_error('章节标题未填写，请检查后重新提交。');

        $story = $this->story->get($chapter['story_id']);

        if (!$story) show_error('您所提交的小说不存在，请检查后重新提交。');

        $this->db->replace('chapter', $chapter);
        $chapter_id = $this->db->insert_id();
        $update     = array(
            'story_id'      => $chapter['story_id'],
            'story_title'   => $story['title'],
            'chapter_id'    => $chapter_id,
            'chapter_title' => $chapter['title'],
            'time'          => time()
        );
        $this->db->replace('update', $update);
        redirect('/admin/chapter/' . $story['id']);
    }

    function list_chapter($story_id=null) {

    }
}