<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public $title = '';

    function __construct() {
        parent::__construct();
        $this->load->model('setting_model');
        $this->title = $this->setting_model->get('title');
    }

    public function index() {
        $data['dirSize'] = $this->dir_size();
        $data['sqlSize'] = $this->mysql_size();
        $data['title']   = $this->title;
        $this->load->view('admin/main', $data);
    }

    private function dir_size() {
        $dir       = new RecursiveDirectoryIterator(str_replace('system/', '', BASEPATH));
        $totalSize = 0;
        foreach (new RecursiveIteratorIterator($dir) as $file) {
            $totalSize += $file->getSize();
        }
        $t = round(@disk_total_space(".") / (1024 * 1024 * 1024), 3);
        $f = round(@disk_free_space(".") / (1024 * 1024 * 1024), 3);

        $d['total'] = $t;

        $d['data'] = array(
            array(
                'text' => '空闲',
                'data' => $f
            ),
            array(
                'text' => '已用',
                'data' => $t - $f
            ),
            array(
                'text' => 'DMNovel占用',
                'data' => round($totalSize / (1024 * 1024 * 1024), 3)
            )
        );

        $d['PCT'] = (floatval($t) != 0) ? round(($t - $f) / $t * 100, 2) : 0;

        return $d;
    }

    private function mysql_size() {
        include('app/config/database.php');
        if (isset($db)) {
            $sql = 'use information_schema;';
            $this->db->query($sql);
            $database = $db['default']['database'];
            $sql      = "select concat(round(sum(data_length/1024/1024),2),'MB') as data from tables where table_schema='{$database}';";
            $query    = $this->db->query($sql);
            $sqlSize  = $query->row_array();
            $sql      = 'use ' . $database;
            $this->db->query($sql);
            return $sqlSize['data'];
        }
    }


}
