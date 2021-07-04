<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use TononT\Webentwicklung\mvc\model\BlogPosts;

class GetImage extends AbstractRepository
{


    function getImage(): void
    {

        if(isset($_POST['post'])) {
            $filename = $_FILES["file"]["name"];
            $tmpname = $_FILES["file"]["tmp_name"];
            $folder = "image/" . $filename;
            if(move_uploaded_file($tmpname, $folder)) {
                echo "Image uploaded successfully !";
            } else {
                echo "no file uploaded !";
            }
        }
        $query = $this->connection->prepare('select * from blog_posts ');
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $resultData = $query->fetchAll();

        foreach ($resultData as $results) {
            echo "<div id='img_div'>";
            echo "<img src='image/" . $results['file'] . "' >";
            echo "</div>";
        }
    }
}

