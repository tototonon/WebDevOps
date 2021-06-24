<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Http;

interface IRequest
{
    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @param string $method
     */
    public function setMethod(string $method): void;


    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param string $url
     */
    public function setUrl(string $url): void;

    /**
     * @return array
     */
    public function getParameters(): array;

    /**
     * @param string $name
     * @return string
     */
    public function getParameter(string $name): string;

    /**
     * @param string $name
     * @param string $parameter
     */
    public function setParameter(string $name, string $parameter): void;

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters): void;

    /**
     * @param string $name
     * @return bool
     */
    public function hasParameter(string $name): bool;
}
