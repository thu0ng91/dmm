<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-11
 * Time: 上午8:58
 */
class Story extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->model('story_model', 'story');
    }

    function index() {
        $this->load->model('category_model', 'category');

        $data['categorys'] = $this->category->get();
        $data['storys']    = $this->story->get(null, 20);

        $this->load->view('admin/story', $data);
    }

    function upload() {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'txt';
        $config['max_size']      = 10240;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('story')) {
            show_error($this->upload->display_errors());
        } else {
            $data              = array('upload_data' => $this->upload->data());
            $story             = $this->story->parse_file($data["upload_data"]);
            $story['category'] = $this->input->post('category')?$this->input->post('category'):1;

            if ($this->story->get(null,1,null,array('title'=>$story['title']))) {
                unlink($data["upload_data"]['full_path']);
                show_error('小说已经存在《'.$story['title'].'》，请不要重复上传。<br />如果是同名小说，请改名后重新上传。');
            }

            $this->db->replace('story',$story);
            $story_id = $this->db->insert_id();
            $chapters  = $this->story->parse_chapter($data["upload_data"]['full_path']);


            foreach ($chapters as $chapter) {
                $chapter['story_id'] = $story_id;
                $this->db->replace('chapter',$chapter);
            }

        }
    }

}