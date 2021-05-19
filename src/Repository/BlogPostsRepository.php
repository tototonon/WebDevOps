<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\model\FilePost;
use TononT\Webentwicklung\mvc\view\Blog\Show;

class BlogPostsRepository extends AbstractRepository
{

    /**
     * @param BlogPosts $blogPosts
     */
    public function add(BlogPosts $blogPosts): void
    {

        $query = $this->connection->prepare
        ('insert into blog_posts (title, url_key, author,text,file) values (:title, :urlKey, :author, :text, :file); ');
        $query->bindParam(':title', $blogPosts->title);
        $query->bindParam(':urlKey', $blogPosts->urlKey);
        $query->bindParam(':author', $blogPosts->author);
        $query->bindParam(':file', $blogPosts->file);
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
        $result->file = $resultData['file'];
        return $result;
    }
}
