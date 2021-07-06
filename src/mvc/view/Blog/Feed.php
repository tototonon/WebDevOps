<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;

class Feed extends AbstractShow
{

    protected function getTemplatePath(): string
    {
        return '\view\templates\home\feed.html';
    }
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['title'] = $data['entry'];
        $data['description'] = $data['entry'];
        $data['pubDate'] = $data['entry'];
        return parent::render($data);
    }
}
