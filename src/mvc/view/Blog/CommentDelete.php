<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;

class CommentDelete extends AbstractShow
{

    protected function getTemplatePath(): string
    {
        return '\view\templates\blog\delete.html';
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['title'] = 'Comments';
        return parent::render($data);
    }
}
