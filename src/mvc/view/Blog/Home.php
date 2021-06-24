<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;


class Home extends AbstractShow
{

    protected function getTemplatePath(): string
    {
        return '\view\templates\home\home.html';
    }
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['title'] = $data['entry'];
        $data['description'] = $data['entry'];
        $data['link'] = $data['entry'];
        return parent::render($data);
    }
    public function show($data): string
    {
        return json_encode($data);
    }
}