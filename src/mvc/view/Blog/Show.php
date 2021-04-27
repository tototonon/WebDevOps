<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;

class Show
{

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        extract($data);
        ob_start();
        require dirname(dirname(dirname(dirname(__DIR__)))) . '/View/templates/blog/show.html';
        return ob_get_clean();
    }
}
