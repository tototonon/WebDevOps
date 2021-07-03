<?php

declare(strict_types=1);


namespace TononT\Webentwicklung\Http;


interface IResponse
{

    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @param string $body
     */
    public function setBody(string $body): void;

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void;

    /**
     * @param string $name
     * @return string
     */
    public function getHeader(string $name): string;

    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @param string $name
     * @param string $header
     */
    public function setHeader(string $name, string $header): void;

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void;

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader(string $name): bool;

    /**
     * @param string $url
     * @param int $statusCode
     * @return mixed
     */
    public function redirect(string $url, int $statusCode);
}
