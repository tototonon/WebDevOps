<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;


use TononT\Webentwicklung\mvc\model\BlogPosts;

class BlogPostsRepository extends AbstractRepository
{
    /**
     * BlogPostsRepository constructor.
     */
    public function __construct()
    {
        $this->connectToDb();
    }

    /**
     * @param string $urlKey
     * @return BlogPosts|null
     */
    public function getByUrlKey(string $urlKey)
    {
        if (isset($this->connection)) {
            $query = $this->connection->prepare('select * from blog_posts where url_key = :urlKey');
        }
        $query->bindParam(':urlKey', $urlKey);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $resultData = $query->fetch();

        if (!$resultData) {
            echo  $resultData;
            return null;
        }

        // INFO This clearly shows how bad this solution scales. But it is very
        $result = new BlogPosts();
        $result->id = $resultData['id'];
        $result->title = $resultData['title'];
        $result->urlKey = $resultData['url_key'];
        $result->author = $resultData['author'];
        $result->text = $resultData['text'];
        return $result;
    }

}