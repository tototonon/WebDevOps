<?php


namespace TononT\Webentwicklung\mvc\view\Blog;


class PopularPost extends AbstractShow
{
    protected function getTemplatePath(): string
    {
        return '\view\templates\home\popular.html';
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['file'] = $data['entry']->file;
        return parent::render($data);
    }
}