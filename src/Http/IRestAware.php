<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Http;

interface IRestAware
{
    /**
     * @return array
     */
    public function getIdentifiers(): array;

    /**
     * @param array $identifiers
     */
    public function setIdentifiers(array $identifiers): void;
}
