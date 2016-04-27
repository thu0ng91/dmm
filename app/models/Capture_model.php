<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Capture_model
 *
 * @author joe
 */
class Capture_model extends CI_Model {

    private $capture_url = 'http://www.23wx.com/';
    public $capture_id = 0;
    public $capture;
    public $book_info;
    public $chapter_list;

    public function __construct() {
        $this->load->database();
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
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
            return $this->db->get_where('capture', array('id' => $id))->row_array();
        }
        return $this->db->get('capture')->result_array();
    }

    /**
     * 获取书籍信息
     *
     * @param type $id
     * @param type $book_id
     *
     * @return type
     */

    function getBookInfo($id, $book_id = null) {
        $this->capture_id = $id;
        $capture          = $this->get($id);

        $book_id = $book_id ? $book_id : $capture['test_id'];

        $book_home_url     = preg_replace('/(\(:book_id\))/', $book_id, $capture['book_url']);
        $book_home_content = get_encoding($this->_getPage($book_home_url));

        foreach ($capture as $key => $c) {
            $capture[$key] = $this->_changerRule($c);
            $capture[$key] = preg_replace('/(\(:book_id\))/', $book_id, $capture[$key]);
            if (in_array($key, array('book_title', 'book_author', 'book_desc', 'book_img', 'chapter_list_url'))) {
                preg_match('/' . $this->_changerRule($c) . '/is', $book_home_content, $match);
                $m = '';
                if (!$match) {
                    echo $key;
                } else {
                    $m = $match[1];
                }
                $this->book_info[$key] = $m;
            }
        }

        $this->capture = $capture;
        $this->cache->save('capture',$capture,3000);

        return $this->book_info;
    }

    /**
     * 抓取章节列表
     * @return bool
     */
    function getChapterList() {
        $chapter_list_url = $this->book_info['chapter_list_url'];

        $chapter_list_content = $this->_getPage($chapter_list_url);

        preg_match_all('/' . $this->capture['chapter_url_title'] . '/', $chapter_list_content, $match);

        if (!$match) return FALSE;

        for ($i = 0; $i < count($match[1]); $i++) {
            if (!in_array($match[2], array('&nbsp;', ' ', ''))) {
                $this->chapter_list[] = array(
                    'url'   => $match[1][$i],
                    'title' => get_encoding($match[2][$i])
                );
            }
        }
        return $this->chapter_list;
    }

    /**
     * 抓取章节
     *
     * @param $url
     *
     * @return bool|string
     */
    function getChapter($url) {
        $this->capture=$this->capture?$this->capture:$this->cache->get('capture');
        $chapter_content = $this->_getPage($url);
        preg_match('/' . $this->capture['chapter_content'] . '/is', $chapter_content, $match);
        if (!$match) return FALSE;
        return get_encoding($match[1]);
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
        echo count($sql).'----'.count($capture);
        foreach ($capture as $key=>$c) {
            $capture[$key]['order']=$key;
            $j=0;
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

    private function _getPage($url) {
        if (function_exists('file_get_contents')) {
            $file_contents = file_get_contents($url);
        } else {
            $ch      = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }

    private function _changerRule($str) {
        $patterns = array('/(:num)/', '/(:en)/', '/(:cn)/', '/(:char)/', '/(:s)/', '/(:cr)/', '/(:page)/');
        $replaces = array('[0-9]+', '\w+', '[0-9a-zA-Z_\x80-\xff\s]+', '.*', '\s', '[\r\n]', '[\/\w]+\.html|php|htm');
        $str      = str_replace('/', '\/', $str);
        $str      = str_replace('\r\n', ':s', $str);
        $str      = str_replace('.', '\.', $str);
        return preg_replace($patterns, $replaces, $str);
    }

}
