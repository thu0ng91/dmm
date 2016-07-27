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

    function index($page = 0) {
        $this->load->model('category_model', 'category');

        $data['categorys'] = $this->category->get();

        $this->load->view('admin/story', $data);
    }

    function datatable() {
        $search = $this->input->get_post('search');
        $this->load->library('Datatables');
        $this->datatables->select("story.id,category.title as category_title,story.title,author,time,last_update", false)
            ->from('story')
            ->join('category', 'story.category=category.id', 'left')
            ->like('story.title', $search['value'])
            ->or_like('story.author', $search['value'])
            ->add_column('DT_RowId', '$1', 'id')
            ->add_column('action', <<<ETO
<div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenu1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            操作
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <li class="listChapter">
                                <a href="#">
                                    <i class="icon-list-alt"></i>
                                    章节列表
                                </a>
                            </li>
                            <li class="addChapter">
                                <a href="#">
                                    <i class="icon-plus"></i>
                                    增加章节
                                </a>
                            </li>
                            <li class="editStory">
                                <a href="#">
                                    <i class="icon-edit"></i>
                                    编辑小说
                                </a>
                            </li>
                            <li class="deleteStory">
                                <a href="#">
                                    <i class="icon-trash"></i>
                                    删除小说
                                </a>
                            </li>
                            <li class="updateStory">
                                <a href="#">
                                    <i class="icon-cloud-download"></i>
                                    更新小说
                                </a>
                            </li>
                        </ul>
                    </div>
ETO
            );
        echo $this->datatables->generate();
    }

    function edit($id = null) {
        $this->load->model('category_model', 'category');
        $data['categorys'] = $this->category->get();
        if ($id) {
            $data['story'] = $this->story->get($id);
        }

        $this->load->view('admin/story_edit', $data);
    }

    function add() {
        $story = array(
            'id' => $this->input->post('id'), 'title' => $this->input->post('title'),
            'author' => $this->input->post('author'), 'category' => $this->input->post('category'),
            'image' => $this->input->post('image'), 'desc' => $this->input->post('desc')
        );

        if (!$story['title']) show_error('小说标题没有输入，请返回重新填写。');
        $this->db->replace('story', $story);
        redirect('/admin/story');
    }

    function delete($id) {
        if (!$id) show_error('没有选择书号.');

        $this->db->delete('story', array('id' => $id));
        $this->db->delete('chapter', array('story_id' => $id)); //删除章节
        $this->db->delete('update', array('story_id' => $id)); //删除更新
        //redirect('/admin/story');
    }

    function image() {
        $config['upload_path'] = 'books/' . date('Y', time());
        $config['allowed_types'] = 'jpg|png|bmp|gif|jpeg';
        $config['max_size'] = 500;
        $config['encrypt_name'] = true;
        //创建目录
        mkdirs($config['upload_path']);

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imageUpload')) {
            show_error($this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());

            $message = array(
                'path' => $config['upload_path'], 'profile' => $data['upload_data']
            );
            show_json($message);
        }
    }

    function upload() {
        $config['upload_path'] = './books/uploads/';
        $config['allowed_types'] = 'txt';
        $config['max_size'] = 10240;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('story')) {
            show_error($this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $story = $this->story->parse_file($data["upload_data"]);
            $story['category'] = $this->input->post('category') ? $this->input->post('category') : 1;

            if ($this->story->get(null, 1, null, array('title' => $story['title']))) {
                unlink($data["upload_data"]['full_path']);
                show_error('《' . $story['title'] . '》小说已经存在，请不要重复上传。<br />如果是同名小说，请改名后重新上传。');
            }

            $chapters = $this->story->parse_chapter($data["upload_data"]['full_path']);

            $story['desc'] = $chapters['desc'];

            $this->db->replace('story', $story);
            $story_id = $this->db->insert_id();

            unset($chapters['desc']);
            $i = 0;
            foreach ($chapters as $chapter) {
                $chapter['order'] = $i;
                $chapter['story_id'] = $story_id;
                $this->db->replace('chapter', $chapter);
                $i++;
            }

            $update = array(
                'story_id' => $story_id, 'story_title' => $story['title'], 'chapter_id' => $this->db->insert_id(),
                'chapter_title' => $chapters[count($chapters) - 1]['title'], 'time' => date('Y-m-d', time())
            );
            $this->db->replace('update', $update);
            unlink($data["upload_data"]['full_path']);
            redirect('/admin/story');
        }
    }

}
