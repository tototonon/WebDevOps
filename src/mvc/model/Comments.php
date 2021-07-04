<?php
 declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\model;


class Comments

{
    protected int $id;
    public string $text;
    public string $date;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }


    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }
}