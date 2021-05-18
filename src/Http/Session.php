<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\Http;


class Session
{

    /**
     *
     */
    protected const LOGIN_INDICATOR_KEY = 'isLoggedIn';

    /**
     * @var array
     */
    protected array $defaultOptions = [
        'cookie_httponly' => true
    ];

    /**
     * @return bool
     */
    public function destroy(): bool
    {
        return session_destroy();
    }

    /**
     * @param array $options
     * @return bool
     */
    public function start(array $options = []): bool
    {
        return session_start($options + $this->defaultOptions);
    }

    /**
     *
     */
    public function login(): void
    {
        $this->setEntry(static::LOGIN_INDICATOR_KEY, true);
    }

    /**
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return $this->hasEntry(static::LOGIN_INDICATOR_KEY);
    }

    /**
     * @return array
     */
    public function getEntries(): array
    {
        return $_SESSION;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getEntry(string $name): string
    {
        return $_SESSION[$name];
    }

    /**
     * @param string $name
     * @param mixed $entry
     */
    public function setEntry(string $name, $entry): void
    {
        $_SESSION[$name] = $entry;
    }

    /**
     * @param array $entries
     */
    public function setEntries(array $entries): void
    {
        $_SESSION = $entries;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasEntry(string $name): bool
    {
        return isset($_SESSION[$name]);
    }


}