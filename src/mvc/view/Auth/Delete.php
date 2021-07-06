<?php

namespace TononT\Webentwicklung\mvc\view\Auth;

use TononT\Webentwicklung\mvc\view\Blog\AbstractShow;

class Delete extends AbstractShow
{

    /**
     * @return string
     */
    protected function getTemplatePath(): string
    {
        return '/view/templates/auth/delete.html';
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['title'] = 'Delete';
        return parent::render($data);
    }
}
