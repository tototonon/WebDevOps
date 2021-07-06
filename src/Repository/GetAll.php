<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\model\Comments;

/**
 * @author Timon Tonon
 * Class GetAll
 * @package TononT\Webentwicklung\Repository
 */
class GetAll extends AbstractRepository
{


    /**
     *
     * Put image in folder.
     */
    function getImage() :void
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
    }

    /**
     * Get all BlogPosts and print out in html.
     * (I assume there is no security disadvantage when print out Html in echo function.)
     * @return BlogPosts
     */
        public function getAll() {
        $query = $this->connection->prepare('select * from blog_posts ');
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $resultData = $query->fetchAll();
        echo "<h3>ALL BLOGPOSTS</h3>";
        foreach ($resultData as $results) {
            echo "<div class='card'>";
            echo "<div id='img_box'>";
            if ($results['file'] == null) {
                echo "<h4>" . $results['title'] . "</h4>";
                echo "<i>" . $results['date'] . "</i>";
                echo "<br>";
                echo "<p>" . $results['author'] . "</p>";
                echo "<br>";
                echo "<a href='https://tonon.test/blog/show/" . $results['url_key'] . "'>open</a>";
            } else {
                echo "<h4>" . $results['title'] . "</h4>";
                echo "<i>" . $results['date'] . "</i>";
                echo "<br>";
                echo "<p>" . $results['author'] . "</p>";
                echo "<br>";
                echo "<p><img src='/image/" . $results['file'] . "' alt='..'></p>";
                echo "<a href='https://tonon.test/blog/show/" . $results['url_key'] . "'>open</a>";
            }
            echo "</div>";
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
