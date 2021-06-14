<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use TononT\Webentwicklung\mvc\model\BlogPosts;


class BlogPostsRepository extends AbstractRepository
{
    

    /**
     * @param BlogPosts $blogPosts
     */
    public function add(BlogPosts $blogPosts): void
    {

        $title = $blogPosts->getTitle();
        $url = $blogPosts->getUrlKey();
        $author = $blogPosts->getAuthor();
        $text = $blogPosts->getText();
        $file = $blogPosts->getFile();



        $query = $this->connection->prepare
        ('insert into blog_posts (title, url_key, author,text,file) values (:title, :urlKey, :author, :text, :file); ');
        $query->bindParam(':title', $title);
        $query->bindParam(':urlKey', $url);
        $query->bindParam(':author', $author);
        $query->bindParam(':text', $text);
        $query->bindParam(':file', $file);

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
        $result->setId($resultData['id']);
        $result->setTitle($resultData['title']);
        $result->setUrlKey($resultData['url_key']);
        $result->setAuthor($resultData['author']);
        $result->setText($resultData['text']);
        $result->setFile($resultData['file']);
        return $result;
    }

    /**
     * @return BlogPosts|null
     */
    public function getAllFiles() {
        $query = $this->connection->prepare("select * from blog_posts ");
        $count = $query->rowCount();
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $resultData = $query->fetch();

        echo "<table>";
        for ($i=0; $i<$count; $i++)
        {
            echo "<table><tr><td>".($resultData['id'])."</td></tr>";
        }
        echo "</table>";

        if (!$resultData) {
            return null;
        }

        $result = new BlogPosts();
            $result->setId($resultData['id']);
            $result->setTitle($resultData['title']);
            $result->setUrlKey($resultData['url_key']);
            $result->setAuthor($resultData['author']);
            $result->setText($resultData['text']);
            $result->setFile($resultData['file']);

        return $result;
    }

    /**
     * @param string $urlKey
     * Delete BlogPost with urlKey
     */
    public function delete(string $urlKey) {

        $query = $this->connection->prepare("delete from blog_posts where url_key=:urlKey");
        $query->bindParam(':urlKey', $urlKey);
        $query->execute();
        if($query == true) {
            echo "deleted";
        } else {
            echo "not deleted";
        }


    }
}
