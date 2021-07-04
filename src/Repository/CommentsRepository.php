<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;


use TononT\Webentwicklung\mvc\model\Comments;

class CommentsRepository extends AbstractRepository
{

    /**
     * @param Comments $comments
     */
    public function addComment(Comments $comments): void
    {

        $text = $comments->getText();

        $query = $this->connection->prepare('insert into comments (text) values (:text); ');
        $query->bindParam(':text', $text);
        $query->execute();
    }
}
