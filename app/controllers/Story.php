<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-6
 * Time: 上午9:24
 */
class Story extends CI_Controller {

    public $title = '';

    function __construct() {
        parent::__construct();
        $this->load->model('story_model', 'story');
        $this->load->model('chapter_model', 'chapter');
    }

    public function index($id) {
        if (!$id) {
            show_error('请输入书号');
        }

        $data['user']     = '';
        $data['story']    = $this->story->get($id);
        $data['title']    = $data['story']['title'];
        $data['chapters'] = $this->chapter->get(null, $id);

        $this->load->view('story', $data);
    }

    public function view($id) {
        if (!$id) {
            show_error('请输入章节号');
            return;
        }

        $data['chapter']   = $this->chapter->get($id);
        $data['title']     = $data['chapter']['title'];
        $data['prev_next'] = $this->chapter->get_pn($id);
        $data['story']     = $this->story->get($data['chapter']['story_id']);
        $data['chapters']  = $this->chapter->get(null,$data['chapter']['story_id']);
        $this->load->model('category_model','category');
        $data['category']=$this->category->get($data['story']['category']);

        $this->load->view('chapter', $data);
    }

}