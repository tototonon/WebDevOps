<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Http;


class Request implements IRequest
{
    /**
     * @var string
     */
    private string $url = '';

    /**
     * @var array
     */
    protected array $parameters;


    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {

        if(isset($url))
            $this->url = $url;
        }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getParameter(string $name): string
    {
        return $this->parameters[$name];
    }

    /**
     * @param string $name
     * @param string $parameter
     */
    public function setParameter(string $name, string $parameter): void
    {
        $this->parameters[$name] = $parameter;
    }

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasParameter(string $name): bool
    {
        return isset($this->parameters[$name]);
    }

}
