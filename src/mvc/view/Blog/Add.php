<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;


class Add extends AbstractShow
{
    /**
     * @return string
     */
    protected function getTemplatePath(): string
    {
        return '\view\templates\blog\add.html';
    }


}