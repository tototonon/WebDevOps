<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\model\Comments;
use TononT\Webentwicklung\NotFoundException;

/**
 * Class CommentsRepository
 * @package TononT\Webentwicklung\Repository
 */
class CommentsRepository extends AbstractRepository
{
    /**
     * @param string $id
     */
    public function deleteComment(string $id): void
    {

        $query = $this->connection->prepare("delete from  comments where id=:id");
        $query->bindParam(':id', $id);
        $query->execute();
    }

    /**
     * @param Comments $comments
     */
    public function addComment(Comments $comments): void
    {

        $text = $comments->getText();
        $name = $comments->getName();

        $query = $this->connection->prepare('insert into comments (text, name) values (:text, :name); ');
        $query->bindParam(':text', $text);
        $query->bindParam(':name', $name);
        $query->execute();
    }

    /**
     * @return Comments
     */
    public function getAllComments()
    {
            $query = $this->connection->prepare('select * from comments ');
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_ASSOC);
            $resultData = $query->fetchAll();


            //use div id to style div
        echo "<div class='comment-box'>";
        foreach ($resultData as $results) {
            echo "<div class='card'>";
            echo "<tr> 
    <h4>by: {$results['name']}</h4>
    <i><h8>published: {$results['date']}</h8></i><br>
    <p><bold>{$results['text']}</bold></p>
   </tr>";
            echo "</div>";


            $results[] = array(
                'name' => $results['name'],
                'text' => $results['text'],
            );

            $result = new Comments();
            $result->setName($results['name']);
            $result->setText($results['text']);
        }
        echo "</div>";
        return $result;
    }
}
