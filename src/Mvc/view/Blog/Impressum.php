<?php


namespace TononT\Webentwicklung\mvc\view\Blog;


class Impressum extends AbstractShow
{

    protected function getTemplatePath(): string
    {
        return '\view\templates\home\impressum.html';
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['title'] = "impressum";
        return parent::render($data);
    }
}