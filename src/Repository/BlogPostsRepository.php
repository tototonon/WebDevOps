<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;

use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\model\FilePost;
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
     * @param FilePost $filePost
     */
    public function addFile(FilePost $filePost): void
    {

            $file = $_FILES["file"]["name"];
            $filetype = $_FILES["file"]["type"];
            $filesize = $_FILES["file"]["size"];
            $tempfile = $_FILES["file"]["tmp_name"];
            $filenameWithDirectory = basename("uploads/" . $file);
// Check extension
            if (move_uploaded_file($tempfile, $filenameWithDirectory)) {
                echo "<h2>File Uploaded</h2>";
                echo "<p>You file is uploaded successfully.</p>";
                echo "<p>File name = <b>$file</b></p>";
                echo "<p>File type = <b>$filetype</b></p>";
                echo "<p>File size = <b>$filesize</b></p>";
                $query = $this->connection->prepare("insert into media(file) value ('.$file'); ");
                $query->bindParam(':file', $filePost->file);
                $query->execute();
            }

        }

    /**
     * @param BlogPosts $blogPosts
     */
    public function add(BlogPosts $blogPosts): void
    {

        $query = $this->connection->prepare('insert into blog_posts (title, url_key, author, text) values (:title, :urlKey, :author, :text); ');
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
