<?php


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
}