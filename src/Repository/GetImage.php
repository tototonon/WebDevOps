<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\model\Comments;

class GetImage extends AbstractRepository
{


    /**
     * @return BlogPosts
     */

    function getImage(): BlogPosts
    {

        if(isset($_POST['post'])) {
            $filename = $_FILES["file"]["name"];
            $tmpname = $_FILES["file"]["tmp_name"];
            $folder = "image/" . $filename;
            if(move_uploaded_file($tmpname, $folder)) {
                echo "Image uploaded !";
            } else {
                echo "no file uploaded !";
            }
        }
        $query = $this->connection->prepare('select * from blog_posts ');
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $resultData = $query->fetchAll();


        echo "<h3>Newest Images</h3>";
        foreach ($resultData as $results) {
            echo "<div id='img_div'>";
            echo "<img src='/image/". $results['file'] ."' alt='..'>";
            echo "</div>";

            $results[] = array(
                'file' => $results['file'],

            );

            $result = new BlogPosts();
            $result->setFile($results['file']);

        }
        return $result;
        }

}

