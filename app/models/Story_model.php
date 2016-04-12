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

    public function parse_file($data) {
        if (!$data) return;

        preg_match('/(?:<|《)(.*)(?:>|》)(?:作者:|：){0,}([A-Za-z0-9_\x80-\xff\s]{0,})\.txt/', get_encoding($data['orig_name']), $match);
        dump_data($match);
        if (!$match || !isset($match[1])) {
            unlink($data['full_path']);
            show_error('文件名无法解析，请按照示范更改文件名！');
        }

        $story['title']  = $match[1];
        $story['author'] = $match[2];

        return $story;
    }

    public function parse_chapter($path) {
        if (!file_exists($path)) {
            show_error('文件不存在，请检查后重新读取');
        }
        $content = get_encoding(file_get_contents($path));

        preg_match_all('/(第.*?[章节]\s*?.*\r\n)/iu', $content, $match);

        if ($match[0]) {
            $c = preg_split('/(第.*?[章节]\s*?.*\r\n)/iu', $content);

            for ($i = 0; $i < count($match[0]); $i++) {
                $chapter[] = array(
                    'title'   => $match[0][$i],
                    'content' => preg_replace('/(\r\n\r\n)/u', '<br/><br/>', $c[$i + 1])
                );
            }
        } else {
            $chapter[] = array(
                'title'   => '正文',
                'content' => $content
            );
        }

        return $chapter;
    }
}