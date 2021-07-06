<?php

namespace TononT\Webentwicklung\mvc\model;

use stdClass;

class BlogPosts implements \JsonSerializable
{
    // object properties

    protected string $id;
    public string $title;
    public string $urlKey;
    public string $text;
    public string $author;
    public string $file;
    public string $date;



    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrlKey(): string
    {
        return $this->urlKey;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }


    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }


    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $urlKey
     */
    public function setUrlKey(string $urlKey): void
    {
        $this->urlKey = $urlKey;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
    }


    /**
     * @return object
     */
    public function jsonSerialize()
    {
        $result = new stdClass();
        $result->author = $this->author;
        $result->title = $this->title;
        $result->text = $this->text;
        $result->file = $this->file;
        return $result;
    }
}
