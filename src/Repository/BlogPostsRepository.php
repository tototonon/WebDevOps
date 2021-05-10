<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;


use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\view\Blog\Show;

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
     * @param BlogPosts $blogPosts
     */
    public function add(BlogPosts $blogPosts): void
    {
        $query = $this->connection->prepare(
            'insert into blog_posts (title, url_key, author, text) values (:title, :urlKey, :author, :text); '
        );
        $query->bindParam(':title', $blogPosts->title);
        $query->bindParam(':urlKey', $blogPosts->urlKey);
        $query->bindParam(':author', $blogPosts->author);
        $query->bindParam(':text', $blogPosts->text);
        $query->execute();
    }

    /**
     * @param string $urlKey
     * @return BlogPosts|null
     */
    public function getByUrlKey(string $urlKey)
    {
        $query = $this->connection->prepare("select * from blog_posts where url_key=:urlKey");
        $query->bindParam(':urlKey', $urlKey);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $resultData = $query->fetch();

        if (!$resultData) {
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
