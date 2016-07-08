<?php

/**
 * Description of collect
 *
 * @author joe
 */
include_once 'phpQuery.php';

class Query {

    private $html;
    private $book;
    private $site;

    public function __construct($site = null) {
        if ($site) {
            $this->site($site);
        }
    }

    function site($site) {
        $this->site = $site;
        $this->html = phpQuery::newDocumentFile($site['book_url']);
    }

    function bookInfo() {
        $this->book['book_title']  = pq($this->html)->find($this->site['book_title'])->text();
        $this->book['book_img']    = pq($this->html)->find($this->site['book_img'])->attr('src');
        $this->book['book_author'] = pq($this->html)->find($this->site['book_author'])->text();
        $this->book['book_desc']   = pq($this->html)->find($this->site['book_desc'])->text();
        $this->book['book_list']   = pq($this->html)->find($this->site['book_list'])->attr('href');
        phpQuery::$documents = array();
        return $this->book;
    }

    function chapterList($url) {
        $html = phpQuery::newDocumentFile($url);
        $list = array();

        foreach (pq($html)->find($this->site['chapter_list']) as $lists) {
            if (pq($lists)->attr('href') != '42506963.html') {
                $list[] = array(
                    'url'   => pq($lists)->attr('href'),
                    'title' => pq($lists)->text()
                );
            }
        }
        phpQuery::$documents = array();
        return $list;
    }

    function chapter($url) {
        $chapter_html = phpQuery::newDocumentFile($url);

        $chapter = iconv('GBK', 'UTF-8', pq($chapter_html)->find($this->site['chapter_content'])->html());
        phpQuery::$documents = array();
        return $chapter;
    }

}
