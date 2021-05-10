<?php


namespace TononT\Webentwicklung\mvc\view\Blog;


class ShowBlog extends AbstractShow
{



    public function render(array $data): string
    {
        extract($data);
        ob_start();
        require dirname(dirname(dirname(dirname(__DIR__)))) . '/View/templates/blog/add.html';
        return ob_get_clean();
    }
}