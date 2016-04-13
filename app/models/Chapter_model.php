<?php

/**
 * Created by PhpStorm.
 * User: joe
 * Date: 16-4-7
 * Time: 下午4:34
 */
class Chapter_model extends CI_Model {

    private $chapter_cache_time=30000;

    public function __construct() {
        $this->load->database();
        $this->load->model('setting_model', 'setting');
        //读取设置中的缓存时间
        $this->chapter_cache_time=$this->setting->get('chapter_cache_time');
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    /**
     * @param null /string $id
     * @param null /string $story_id
     * @param null /string $num
     * @param null /string $offset
     *
     * @return array
     */
    public function get($id = null, $story_id = null) {
        if ($id) {
            if (!$chapter = $this->cache->get('chapter_' . $id)) {//检查缓存
                $chapter = $this->db->get_where('chapter', array('id' => $id))->row_array();
                $this->cache->save('chapter_' . $id, $chapter, $this->chapter_cache_time);//存入缓存
            }
            return $chapter;
        }

        if ($story_id) {
            $this->db->select('id,title');
            $this->db->where('story_id', $story_id);
        }

        return $this->db->get('chapter')->result_array();
    }

    /**
     * 查询文章的上一条及下一条记录ID
     *
     * @param $id
     *
     * @return array
     */
    public function get_pn($id) {
        if (!$prev_next = $this->cache->get('chapter_prev_next_' . $id)) {//检查缓存
            $this->db->select('id,story_id');
            $c = $this->db->get_where('chapter', array('id' => $id))->row_array();

            $this->db->select('id');
            $this->db->where(array('id >' => $id, 'story_id' => $c['story_id']));
            $this->db->limit(1);
            $next = $this->db->get('chapter')->row_array();

            $this->db->select('id');
            $this->db->where(array('id <' => $id, 'story_id' => $c['story_id']));
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $prev = $this->db->get('chapter')->row_array();

            $prev_next = array('next' => $next['id'], 'prev' => $prev['id'], 'story_id' => $c['story_id']);

            $this->cache->save('chapter_prev_next_' . $id, $prev_next, $this->chapter_cache_time);//存入缓存
        }

        return $prev_next;
    }
}