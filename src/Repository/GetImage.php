<?php
/**
declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use TononT\Webentwicklung\mvc\model\BlogPosts;

class GetImage extends AbstractRepository
{

    public function __construct()
    {
        $this->connectToDb();
    }
    function getImage(BlogPosts $blogPosts): void
    {
        header('Content-type: image/jpeg');
        $id = $_GET['id'];
        $query = $this->connection->prepare("select * from blog_posts where id =:id");
        $query->bindParam(':id', $id);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $resultData = $query->fetch();
        echo $resultData;
        echo "yesss";
    }
}

*/