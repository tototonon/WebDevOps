<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use TononT\Webentwicklung\mvc\model\BlogPosts;

class GetImage
{


    function getImage(): void
    {

        $filename = $_FILES["file"]["name"];
        $tmpname = $_FILES["file"]["tmp_name"];
        $folder = "image/" . $filename;
        if(move_uploaded_file($tmpname, $folder)) {
            echo "Image uploaded successfully !";
        } else {
            echo "no file uploaded !";
        }
    }
}

