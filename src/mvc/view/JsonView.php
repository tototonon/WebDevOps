<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\view;


class JsonView
{
    /**
     * @param mixed $data
     * @return string
     */
    public function render($data): string
    {
        return json_encode($data);
    }


}