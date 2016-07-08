<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-7-7
 * Time: 下午5:19
 */
class Collect_model extends CI_Model {

    public $id = 0;
    private $site;
    private $book_list;

    public function __construct() {
        $this->load->database();
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('query');
    }

    /**
     * @param null /num $id
     * @param null /string $select
     *
     * @return array
     */
    public function get($id = null, $select = null) {
        if ($select) {
            $this->db->select($select);
        }
        if ($id) {
            return $this->db->get_where('collect', array('id' => $id))->row_array();
        }
        return $this->db->get('collect')->result_array();
    }

    public function getBookInfo($id, $book_id = null) {
        $this->id   = $id;
        $this->site = $this->get($id);

        $book_id = $book_id ? $book_id : $this->site['test_id'];

        $this->site['book_url'] = preg_replace('/(\(:book_id\))/', $book_id, $this->site['book_url']);

        $this->query->site($this->site);
        $book_info = $this->query->bookInfo();

        if (preg_match('/^((http|ftp|https):\/\/)?[\w-_.]+(\/[\w-_\(\):]+)*\/?$/', $this->site['book_list'])) {
            $this->book_list = preg_replace('/(\(:book_id\))/', $book_id, $this->site['book_list']);
            $book_info['book_list']=$this->book_list;
        } else {
            $this->book_list = $book_info['book_list'];
        }

        return $book_info;
    }

    public function getChapterList() {
        return $this->query->chapterList($this->book_list);
    }

    public function getChapter($url) {
        return $this->query->chapter($url);
    }

    /**
     * 比较数据库已存章节和采集到的章节，得出差集
     *
     * @param array $sql
     * @param array $capture
     *
     * @return array
     */
    function checkChapterList($sql, $capture) {
        foreach ($capture as $key => $c) {
            $capture[$key]['order'] = $key;
            $j                      = 0;
            foreach ($sql as $s) {
                if ($c['title'] == $s['title']) {
                    unset($capture[$key]);
                    unset($sql[$j]);
                    break;
                }
                $j++;
            }
        }
        return $capture;
    }

}