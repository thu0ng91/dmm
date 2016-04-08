<?php

/**
 * Description of pquery
 *
 * @author joe
 */
include_once 'phpQuery.php';

class Pquery {

    private $html;
    private $book;

    public function __construct($url = null) {
        if ($url) {
            $this->html = phpQuery::newDocumentFile($url['url']);
        }
    }

    function get_book() {
        $this->html = pq($this->html)->find('#content');

        $this->book['title']            = str_replace(' 全文阅读', '', pq($this->html)->find('dd h1')->text());
        $this->book['img']              = pq($this->html)->find('.hst img')->attr('src');
        $this->book['author']           = pq($this->html)->find('#at tr:eq(0) td:eq(1)')->text();
        $this->book['desc']             = pq($this->html)->find('dd:eq(3) p:eq(1)')->text();
        $this->book['chapter_list_url'] = pq($this->html)->find('.btnlinks a:eq(0)')->attr('href');
        return $this->book;
    }

    function get_chapter_list() {
        $list = array();

        foreach (pq($this->html)->find('.L a') as $lists) {
            if (pq($lists)->attr('href') != '42506963.html') $list[] = array(
                'url'   => pq($lists)->attr('href'),
                'title' => pq($lists)->text()
            );
        }
        return $list;
    }

    function get_chapter($url) {
        $chapter_html = phpQuery::newDocumentFile($url);

        $chapter['title']   = pq($chapter_html)->find('#amain dd:eq(0)')->text();
        $chapter['content'] = iconv('GBK','UTF-8',pq($chapter_html)->find('#contents')->html());
        $chapter['next']    = pq($chapter_html)->find('#amain dd:eq(1) a:eq(2)')->attr('href');

        return $chapter;
    }

}
