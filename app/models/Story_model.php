<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-7
 * Time: 下午4:17
 */
class Story_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get($id = null, $num = null, $offset = null, $where = null) {
        if ($where != null) {
            $this->db->where($where);
        }

        if ($id) {
            return $this->db->get_where('story', array('id' => $id))->row_array();
        }

        if ($num || $offset) {
            $this->db->limit($num, $offset);
        }

        $this->db->order_by('id', 'DESC');
        return $this->db->get('story')->result_array();
    }

    //解析TXT文本文件名，获取小说名、作者
    public function parse_file($data) {
        if (!$data) return;

        preg_match('/(?:<|《)(.*)(?:>|》)(?:作者:|：){0,}([A-Za-z0-9_\x80-\xff\s]{0,})\.txt/', get_encoding($data['orig_name']), $match);

        if (!$match || !isset($match[1])) {
            unlink($data['full_path']);
            show_error('文件名无法解析，请按照示范更改文件名！');
        }

        $story['title']  = $match[1];
        $story['author'] = $match[2];

        return $story;
    }

    //解析TXT文本中的章节
    public function parse_chapter($path) {
        if (!file_exists($path)) {
            show_error('文件不存在，请检查后重新读取');
        }

        $content = get_encoding(file_get_contents($path));

        preg_match_all('/(第[0-9零一二三四五六七八九十百千万]+章\s+?.*\s+)/', $content, $match);

        if ($match[0]) {
            $c               = preg_split('/(第[0-9零一二三四五六七八九十百千万]+章\s+?.*\s+)/', $content);
            $chapter['desc'] = $c[0]; //第一章前内容为简介
            for ($i = 0; $i < count($match[0]); $i++) {
                $chapter[] = array(
                    'title'   => $match[0][$i],
                    'content' => preg_replace('/(\r\n)/', '<br/>', $c[$i + 1])
                );
            }
        } else {//如果没有分章，全部放到正文内
            $chapter['desc'] = substr($content, 0, 500);
            $chapter[]       = array(
                'title' => '正文',
                'content' => preg_replace('/(\r\n)/', '<br/>', $content)
            );
        }

        return $chapter;
    }
}