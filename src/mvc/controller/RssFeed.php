<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;


use DOMDocument;
use TononT\Webentwicklung\mvc\view\Blog\Home;

class RssFeed
{


    public function dom() {
        $domOBJ = new DOMDocument();
        $domOBJ->load("http://www.outdoorphotographer.com/blog/feed/");//XML page URL

        $content = $domOBJ->getElementsByTagName("item");
        $i = 2;
        foreach( $content as $data ) {
            if($i-- == 0) {
                break;
            }
     $title = $data->getElementsByTagName("title")->item(0)->nodeValue;
     $description = $data->getElementsByTagName("description")->item(0)->nodeValue;
     echo "$title";
     echo "$description";
        }
    }

    /**
     * @return array $out

    function parse() : array
    {

        if(!$xml = simplexml_load_file($this->feed)) {
            die("Error reading xml file");
        }

        $out = array();

        // auszulesende Datensaetze
        $i = 1;

        if(!isset($xml->channel[0]->item)) {
            die('Keine Items vorhanden!');
        }

        // Items holen
        foreach ($xml->channel[0]->item as $item) {
            if($i-- == 0) {
                break;
            }

            $out[] = array(
                'title' => (string)$item->title,
                'description' => (string)$item->description,
                'link' => (string)$item->link,
            );
            $this->out($out);
        }
        return $out;
    }




     * @param array $out

        public function out(array $out) {

            foreach ($out as $value) {
            echo $value['title'];
            echo $value['description'];
            echo $value['link'];


        }
        }
*/
}