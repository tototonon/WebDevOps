<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;


ini_set('log_errors', 'On');
ini_set('display_errors', 'Off');


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


                echo "<div class='card w-75' id='feed-box'>";
                echo "<h3>$title</h3>";
                echo "<i>$date</i>";
                echo "<br>";
                echo "<p>$description</p>";
                echo "<a href='.$link'</a>";
                echo "<br>";
                echo "<br>";
                echo "</div>";


            }

            $out[] = array(
                'title' => $title,
                'date' => $date,
                'description' => $description,
                'link' => $link,
            );
            return $out;
        }


}