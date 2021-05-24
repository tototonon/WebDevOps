<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;


class Add extends AbstractShow
{
    /**
     * @return string
     */
    protected function getTemplatePath(): string
    {
        return '\view\templates\blog\add.html';
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['title'] = 'Blogbeitrag erstellen';
        return parent::render($data);
    }
}