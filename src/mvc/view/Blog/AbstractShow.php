<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;

abstract class AbstractShow
{

    /**
     * @return string
     */
    abstract protected function getTemplatePath(): string;

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        extract($data);
        ob_start();
        require dirname(dirname(dirname(dirname(__DIR__)))) . $this->getTemplatePath();
        return ob_get_clean();
    }

}
