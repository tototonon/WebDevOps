<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;


use DOMDocument;
use TononT\Webentwicklung\mvc\view\Blog\Home;

class RssFeed
{
    private string $data;

    /**
     * RssFeed constructor.
     * @param string $data
     */
    public function __construct(string $data)
    {
        $this->data = $data;
        $this->parse($data);
    }


    /**
     * parse xml data into html
     * @return array
     */

    public function dom()
    {
        $domOBJ = new DOMDocument();
        $domOBJ->load("http://www.outdoorphotographer.com/blog/feed/");//XML page URL

        $content = $domOBJ->getElementsByTagName("item");
        $i = 3;
        foreach ($content as $data) {
            if($i-- == 0) {
                break;
            }
            $title = $data->getElementsByTagName("title")->item(0)->nodeValue;
            $text = $data->getElementsByTagName("text");
            $description = $data->getElementsByTagName("description")->item(0)->nodeValue;

            echo "$title";
            echo "$description";
        }
            $out[] = array(
                'title' => $title,
                'description' => $description,
                'text' => $text,
            );
            return $out;
        }

    /**
     * @return array $out
     */

    function parse($data) : array
    {

        if(!$xml = simplexml_load_file($data)) {
            die("Error reading xml file");
        }

        $out = array();

        // auszulesende Datensaetze
        $i = 4;

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


        public function out(array $out)
        {

            foreach ($out as $value) {
                echo $value['title'];
                echo $value['description'];
                echo $value['link'];


            }
        }
}