<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view\Blog;

abstract class AbstractShow
{

    /**
     *
     */
    protected const TEMPLATE_PLACEHOLDER_CONTENT = '{{content}}';

    /**
     * @return string
     */
    abstract protected function getTemplatePath(): string;

    /**
     * @return string
     */
    protected function getBaseTemplatePath(): string
    {
        return '/view/templates/stylesheet.html';
    }

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data): string
    {
        extract($data);
        ob_start();
        require dirname(dirname(dirname(dirname(__DIR__)))) . $this->getBaseTemplatePath();
        $baseTemplate = ob_get_clean();
        ob_start();
        require dirname(dirname(dirname(dirname(__DIR__)))) . $this->getTemplatePath();
        $contentTemplate = ob_get_clean();

        return str_replace(static::TEMPLATE_PLACEHOLDER_CONTENT, $contentTemplate, $baseTemplate);
    }
}
