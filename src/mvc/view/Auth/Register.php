<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Auth;


use TononT\Webentwicklung\mvc\view\Blog\AbstractShow;

class Register extends AbstractShow
{
    /**
     * @return string
     */
    protected function getTemplatePath(): string
    {
        return '/view/templates/auth/register.html';
    }

}