<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Http;

use Exception;

class Request implements IRequest
{
    /**
     * @var string
     */
    protected string $url = '';

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
    public function setUrl(mixed $url): void
    {
        if (!empty($url)) {
            $this->url = $url;
        }
        else {
            new Exception("url not found");
        }
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

    protected function validateHttpRequestMethod($input)
    {
        if (empty($input)) {
            throw new Exception('I need valid value');
        }

        switch ($input) {
            case 'GET':
            case 'POST':
            case 'PUT':
            case 'DELETE':
            case 'HEAD':
                return $input;

            default:
                throw new Exception('Unexpected value.');
        }

    }//end validateHttpRequestMethod()
}