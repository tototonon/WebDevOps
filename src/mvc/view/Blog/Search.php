<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;


class Search extends AbstractShow
{
    protected function getTemplatePath(): string
    {
        return '\view\templates\home\search.html';
    }
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['title'] = $data['entry']->title;
        return parent::render($data);
    }
}
