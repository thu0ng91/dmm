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

    function index($story_id = null, $chapter_id = null) {
        $data['order']=0;
        if ($story_id) {
            $data['story'] = $this->story->get($story_id);
            if ($chapter_id) {
                $data['chapter'] = $this->chapter->get($chapter_id);
                $this->load->view('admin/chapter', $data);
                return;
            }
            $data['order']=$this->chapter->all($story_id);
        } else {
            $data['storys'] = $this->story->get();
        }

        $this->load->view('admin/iframe_header');
        $this->load->view('admin/chapter', $data);
        $this->load->view('admin/iframe_footer');
    }

    function add() {
        $type    = $this->input->post('type');
        $chapter = array(
            'id'       => $this->input->post('id'),
            'title'    => $this->input->post('title'),
            'content'  => $this->chapter->filter($this->input->post('content')),
            'story_id' => $this->input->post('story_id'),
            'order'    => $this->input->post('order')
        );

        if (!$chapter['title']) show_error('章节标题未填写，请检查后重新提交。');

        $story = $this->story->get($chapter['story_id']);

        if (!$story) show_error('您所提交的小说不存在，请检查后重新提交。');

        $this->db->replace('chapter', $chapter);

        $this->db->cache_delete('admin', 'chapter');
        $this->db->cache_delete('chapter', $chapter['id']);

        $chapter_id = $chapter['id']?$chapter['id']:$this->db->insert_id();
        $update     = array(
            'story_id'      => $chapter['story_id'],
            'story_title'   => $story['title'],
            'chapter_id'    => $chapter_id,
            'chapter_title' => $chapter['title'],
            'time'          => date('Y-m-d H:i:s')
        );
        $this->db->replace('update', $update);
        $this->db->set('last_update',date('Y-m-d H:i:s'))->where('id',$chapter['story_id'])->update('story');
        redirect('/admin/chapter/' . $type . '/' . $story['id']);
    }

    function delete($id=null) {
        if (!$id) show_error('没有选择要删除的章节');

        $this->db->delete('chapter',array('id'=>$id));
    }

    function list_chapter($story_id=null) {
        if (!$story_id) show_error('没有选择小说，请从发布小说中查看章节列表');


        $data['story']    = $this->story->get($story_id);

        $this->load->view('admin/chapter_list', $data);
    }

    function datatable($story_id) {
        $search = $this->input->get_post('search');

        $where='story_id='.$story_id;

        if ($search['value']) {
            $where.=' AND (id='.$search['value'].' OR title like "%'.$search['value'].'%")';
        }

        $this->load->library('Datatables');
        $this->datatables->select("id,`title`,`order`", false)
            ->from('chapter')
            ->where($where)
            ->add_column('DT_RowId', '$1', 'id')
            ->add_column('action', <<<ETO
<div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenu1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            操作
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <li class="editChapter">
                                <a href="#">
                                    <i class="icon-edit"></i>
                                    编辑章节
                                </a>
                            </li>
                            <li class="deleteChapter">
                                <a href="#">
                                    <i class="icon-trash"></i>
                                    删除章节
                                </a>
                            </li>
                        </ul>
                    </div>
ETO
            );

        echo $this->datatables->generate();
    }

}