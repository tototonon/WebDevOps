<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;


use DOMDocument;
use TononT\Webentwicklung\mvc\view\Blog\Home;

class RssFeed
{

    /**
     * parse xml data into html
     * @return array
     */

    public function dom($file)
    {
        $domOBJ = new DOMDocument();
        $domOBJ->load($file);//XML page URL

        $content = $domOBJ->getElementsByTagName("item");
        $i = 10;

        $hasImg = $domOBJ->getElementById("img");

            foreach ($content as $data) {

                if($i-- == 0) {
                    break;
                }
                $title = $data->getElementsByTagName("title")->item(0)->nodeValue;
                $date = $data->getElementsByTagName("pubDate")->item(0)->nodeValue;
                $description = $data->getElementsByTagName("description")->item(0)->nodeValue;
                $link = $data->getElementsByTagName("link")->item(0)->nodeValue;





                echo "<div class='feed-box'>";
                echo "<h3>$title</h3>";
                echo "<i>$date</i>";
                echo "<br>";
                echo "<p>$description</p>";
                echo "<p>$link</p>";
                echo "<br>";
                echo "<br>";
                echo "</div>";


            }

            $out[] = array(
                'title' => $title,
                'description' => $description,
            );
            return $out;
        }


}