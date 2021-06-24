<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Auth;


use TononT\Webentwicklung\mvc\view\Blog\AbstractShow;

class Login extends AbstractShow
{
    /**
     * @return string
     */
    protected function getTemplatePath(): string
    {
        return '/view/templates/auth/login.html';
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        $data['title'] = 'Login';
        return parent::render($data);
    }
}
