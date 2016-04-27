<?php

/**
 * Description of Capture
 *
 * @author joe
 */
class Capture extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('category_model', 'category');
        $this->load->model('capture_model', 'capture');
        $this->load->model('story_model', 'story');
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    function index() {
        $data['captures'] = $this->capture->get(null, 'id,site_title');
        $this->load->view('admin/capture', $data);
    }

    function get($story_id = null) {
        if ($story_id) {
            $data['capture_book'] = $this->db->get_where('capture_book', array('story_id'=>$story_id))->row_array();
        }
        $data['categories'] = $this->category->get();
        $data['captures']   = $this->capture->get(null, 'id,site_title,site_url');
        $this->load->view('admin/capture/get', $data);
    }

    function test($id = null) {
        $book_id = null;
        $ajax    = 0;
        if (!$id) {
            $id          = $this->input->post('capture_id');
            $book_id     = $this->input->post('book_id');
            $category_id = $this->input->post('category_id');
        } else {
            $ajax = 1;
        }

        $book         = $this->capture->getBookInfo($id, $book_id);
        $chapter_list = $this->capture->getChapterList();
        $chapter      = $this->capture->getChapter($book['chapter_list_url'] . $chapter_list[0]['url']);
        //写入缓存
        $cache = array(
            'capture_id'   => $id,
            'book_id'      => $book_id,
            'book'         => $book,
            'chapter_list' => $chapter_list,
            'category'     => $category_id
        );

        $this->cache->save($book['book_title'], $cache, 30000);

        $data['book']         = $book;
        $data['chapter_list'] = $chapter_list;
        $data['chapter']      = substr($chapter, 0, 250);
        $data['ajax']         = $ajax;

        if ($ajax == 0) {
            $this->load->view('admin/iframe_header');
        }
        $this->load->view('admin/capture/test', $data);
    }

    function get_book($book_title = null) {
        $book_title = $book_title ? $book_title : $this->input->get('title');
        //获取缓存
        $book = $this->cache->get($book_title);

        if (!$book) show_error('缓存已到期，请重新采集。');

        $book_image = grab_image($book['book']['book_img'], '', 'books/' . date('Y', time()) . '/');
        //检查小说是否存在
        $order = 0;

        $book_data = $this->story->get(null, 1, null, array('title' => $book_title));
        if ($book_data) {
            $book_data = $book_data[0];
            $this->load->model('chapter_model', 'chapter');
            $chapter_list = $this->chapter->get(null, $book_data['id']);
            $chapter_list = $this->capture->checkChapterList($chapter_list, $book['chapter_list']);
            $order        = $this->chapter->all($book_data['id']);
        } else {
            $book_data = array(
                'title'    => $book['book']['book_title'],
                'author'   => $book['book']['book_author'],
                'desc'     => $book['book']['book_desc'],
                'category' => $book['category'],
                'time'     => date('Y-m-d H:i', time()),
                'image'    => $book_image
            );
            //写入数据库
            $this->db->replace('story', $book_data);
            $book_data['id'] = $this->db->insert_id();
            $capture_book    = array(
                'story_id'   => $book_data['id'],
                'capture_id' => $book['capture_id'],
                'book_id'    => $book['book_id']
            );
            $this->db->replace('capture_book', $capture_book);
            $chapter_list = $book['chapter_list'];
        }
        $data['chapter_list'] = json_encode($chapter_list);
        $data['book']         = $book_data;
        $data['capture_url']  = $book['book']['chapter_list_url'];
        $data['order']        = $order;
        $this->load->view('admin/capture/book', $data);
    }

    function get_chapter() {
        $chapter_url = $this->input->post('url');
        $chapter     = array(
            'content'  => $this->capture->getChapter($chapter_url),
            'order'    => $this->input->post('order'),
            'story_id' => $this->input->post('story_id'),
            'title'    => $this->input->post('title')
        );
        if ($chapter['content']) {
            $this->db->replace('chapter', $chapter);
            echo '成功';
        } else {
            echo '失败';
        }
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
            'id'                => $this->input->post('id'),
            'site_title'        => $this->input->post('site_title'),
            'site_url'          => $this->input->post('site_url'),
            'book_url'          => $this->input->post('book_url'),
            'book_title'        => $this->input->post('book_title'),
            'book_author'       => $this->input->post('book_author'),
            'book_desc'         => $this->input->post('book_desc'),
            'book_img'          => $this->input->post('book_img'),
            'chapter_list_url'  => $this->input->post('chapter_list_url'),
            'chapter_url_title' => $this->input->post('chapter_url_title'),
            'chapter_url'       => $this->input->post('chapter_url'),
            'chapter_content'   => $this->input->post('chapter_content'),
            'test_id'           => $this->input->post('test_id')
        );

        $this->db->replace('capture', $capture);
        redirect('admin/capture');
    }

}
