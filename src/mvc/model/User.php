<?php
declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\model;


class User
{
    public string $id;
    public string $username;
    public string $password;
    public int $role;

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }




}