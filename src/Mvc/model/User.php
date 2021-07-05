<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\model;


class User
{
    public string $id;
    public string $username;
    public string $password;
    public string $role;

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }





}