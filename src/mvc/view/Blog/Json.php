<?php


namespace TononT\Webentwicklung\mvc\view\Blog;


class Json extends AbstractShow
{
public function render($data): string
{
    return json_encode($data);
}

    protected function getTemplatePath(): string
    {

    }
}