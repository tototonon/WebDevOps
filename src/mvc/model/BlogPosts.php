<?php


namespace TononT\Webentwicklung\mvc\model;



class BlogPosts
{
    // object properties

    public string $id;
    public string $title;
    public string $urlKey;
    public string $text;
    public string $author;
    public string $file;

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
    }




}