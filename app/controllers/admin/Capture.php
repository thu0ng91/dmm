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
        $this->load->model('category_model', 'category');
        $data['categorys'] = $this->category->get();
        $this->load->view('admin/capture', $data);
    }

    function add() {
        $book_id     = $this->input->post('book_id');
        $category_id = $this->input->post('category_id');

        if ($book = $this->capture->check_book($book_id)) {

        } else {
            $this->get_book($book_id, $category_id);
        }

    }

    function get_book($book_id, $category_id) {
        $item = $this->capture->getBook($book_id);

        $book = array(
            'book_id'     => $book_id,
            'category_id' => $category_id,
            'item'        => $item
        );

        $this->cache->save($book_id, $book, 3000);

        $data['item'] = $item;
        $data['id']   = $book_id;

        $this->load->view('admin/capture_book', $data);
    }

    function get_chapter($id) {
        $book = $this->cache->get($id);

        if (!$book) {
            show_error('缓存中不存在书号，请重新抓取');
            return;
        }

        if ($book['itemt']['img']) $img = grab_image($book['item']['img'], null, 'books/' . $book['category_id'] . '/');

        $story = array(
            'title'    => $book['item']['title'],
            'author'   => $book['item']['author'],
            'desc'     => $book['item']['desc'],
            'category' => $book['category_id'],
            'image'    => $img
        );

        $this->db->replace('story', $story);

        $story_id = $this->db->insert_id();

        $chapter_list = $this->capture->getChapterList($book['item']['chapter_list_url']);

        foreach ($chapter_list as $chapter) {
            $ch             = $this->capture->getChapter($book['item']['chapter_list_url'] . $chapter['url']);
            $ch['story_id'] = $story_id;
            unset($ch['next']);
            $this->db->replace('chapter', $ch);
            echo $ch['title'] . '=====> OK <br />';
            ob_flush();
            flush();
        }

        $story_update = array(
            'story_id'      => $story_id,
            'story_title'   => $book['item']['title'],
            'book_id'       => $id,
            'chapter_url'   => $book['item']['chapter_list_url'],
            'last_chapter'  => $chapter_list[count($chapter_list) - 1]['url'],
            'chapter_id'    => $this->db->insert_id(),
            'chapter_title' => $chapter_list[count($chapter_list) - 1]['title'],
            'time'          => date('Y-m-d H:i', time())
        );

        $this->db->replace('update', $story_update);
    }


}
