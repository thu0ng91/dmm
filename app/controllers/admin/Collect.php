<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-8-24
 * Time: 上午10:58
 */
class Collect extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('category_model', 'category');
        $this->load->model('collect_model', 'collect');
        $this->load->model('story_model', 'story');
        $this->load->model('chapter_model', 'chapter');
        $this->load->model('ccache_model', 'ccache');
        //$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    public function index() {
        $data['categories'] = $this->category->get();
        $data['collects']   = $this->collect->get(null, 'id,site_title,site_url');
        $this->load->view('admin/collect/get', $data);
    }

    function get($story_id = null) {
        $title = $this->input->post_get('title');
        if ($story_id) {
            $where = ['story_id' => $story_id];
        } else if ($title) {
            $where = ['title' => $title];
        } else {
            $collect_id  = $this->input->post_get('collect_id');
            $book_id     = $this->input->post_get('book_id');
            $category_id = $this->input->post_get('category_id');
            $where       = [
                'collect_id' => $collect_id,
                'book_id'    => $book_id,
                'category'   => $category_id
            ];
        }

        $cache = $this->ccache->check($where);

        $cache['chapter_list'] = $this->db->select('title,order')->where('story_id', $cache['story_id'])->get('chapter')->result_array();

        $chapter_list = $this->collect->getChapterList($cache['list_url'], $cache['collect_id']);

        $arr   = $this->unique($cache['chapter_list'], $chapter_list);
        $order = $this->chapter->all($cache['story_id']);

        $data = [
            'book'         => $cache,
            'chapter_list' => json_encode($arr),
            'order'        => $order
        ];
        $this->load->view('admin/collect/book', $data);
    }

    function get_chapter() {
        $chapter_url = $this->input->post('url');
        $chapter     = [
            'content'  => $this->collect->getChapter($chapter_url, $this->input->post('collect_id')),
            'order'    => $this->input->post('order'),
            'story_id' => $this->input->post('story_id'),
            'title'    => $this->input->post('title')
        ];
        if ($chapter['content']) {
            //$this->db->replace('chapter', $chapter);
            $this->chapter->insert($chapter);
            $this->db->set('last_update', date('Y-m-d H:i:s'))->where('id', $chapter['story_id'])->update('story');
            echo '成功';
        } else {
            echo '失败';
        }
    }


    /**
     * 比较数据库已存章节和采集到的章节，得出差集
     *
     * @param $arr1
     * @param $arr2
     *
     * @return array
     * @internal param array $sql
     * @internal param array $capture
     *
     */
    function unique($arr1, $arr2) {
        var_dump($arr1);
        foreach ($arr2 as $key => $c) {
            $arr2[$key]['order'] = $key;

            $j = 0;
            foreach ($arr1 as $s) {
                if ($c['title'] == $s['title']) {
                    unset($arr2[$key]);
                    unset($arr1[$j]);
                    break;
                }
                $j++;
            }
        }
        var_dump($arr2);
        return $arr2;
    }

}