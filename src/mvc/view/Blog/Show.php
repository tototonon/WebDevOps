<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\View\Blog;


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
        require dirname(dirname(dirname(__DIR__))) . '/view/templates/blog/show.html';
        return ob_get_clean();
    }
}
