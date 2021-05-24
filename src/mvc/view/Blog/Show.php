<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;


class Show extends AbstractShow
{

    /**
     * @return string
     */
    protected function getTemplatePath(): string
    {
        return '\view\templates\blog\show.html';
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