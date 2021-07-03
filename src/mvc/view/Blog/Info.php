<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;


class Info extends AbstractShow
{

    protected function getTemplatePath(): string
    {
        return '\view\templates\home\info.html';
    }
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['title'] = "info";
        return parent::render($data);
    }
}