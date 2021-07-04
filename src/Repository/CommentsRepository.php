<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;


use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\model\Comments;

class CommentsRepository extends AbstractRepository
{

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

        $query = $this->connection->prepare('select * from comments; ');
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $resultData = $query->fetchAll();

        foreach ($resultData as $results) {
            echo "<div class='comment-box'>";
            echo "<tr>
    <h4>by: {$results['name']}</h4>
    <p>{$results['text']}</p>
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
        return $result;

    }
}
