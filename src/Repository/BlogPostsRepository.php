<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;
use PDO;
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



        $query = $this->connection->prepare('insert into blog_posts (title, url_key, author,text,file) values (:title, :urlKey, :author, :text, :file); ');
        $query->bindParam(':title', $title);
        $query->bindParam(':urlKey', $url);
        $query->bindParam(':author', $author);
        $query->bindParam(':text', $text);
        $query->bindParam(':file', $file);

        $query->execute();
    }

    /**
     * @param string $id
     * @return BlogPosts|null
     */
    public function getById(string $id)
    {

        $query = $this->connection->prepare("select * from blog_posts where id=:id");
        $query->bindParam(':id', $id);
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
    public function getAllFiles()
    {
        $query = $this->connection->prepare("select * from blog_posts ");
        $query->execute();
        $resultData = $query->fetchAll();

        echo "<h3>Newest Posts</h3><br>";
        foreach ($resultData as $results) {
            echo "<div class='file-box'>";
            echo "<tr>
    <h5>Author: {$results['author']}</h5>
    <p>{$results['title']}</p>
   </tr>";
            echo "</div>";
            $results[] = array(
                'title' => $results['title'],
                'author' => $results['author'],
            );

//TODO last title is set.Overwrite !
            $result = new BlogPosts();
            $result->setTitle($results['title']);
            $result->setUrlKey($results['url_key']);
            $result->setAuthor($results['author']);
            $result->setText($results['text']);
            $result->setFile($results['file']);

           // return $result;
        }


        return $result;

    }

    /**
     * @param BlogPosts $blogPosts
     * @return mixed
     */
    public function update(BlogPosts $blogPosts)
    {
        $query = $this->connection->prepare(
            "update blog_posts set text=:text, file=:file where id=:id"
        );
        $id = $blogPosts->getId();
        $file = $blogPosts->getFile();
        $query->bindParam(':id',$id );
        $query->bindParam(':username',$file ,PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, BlogPosts::class);
        return $query->fetch();

    }

    /**
     * @param string $urlKey
     * Delete BlogPost with urlKey
     */
    public function delete(string $urlKey)
    {

        $query = $this->connection->prepare("delete from blog_posts where url_key=:urlKey");
        $query->bindParam(':urlKey', $urlKey);
        $query->execute();
        if ($query == true) {
            echo "deleted";
        } else {
            echo "not deleted";
        }
    }
}
