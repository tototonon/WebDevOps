<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\Repository;


use TononT\Webentwicklung\mvc\model\User;

class UserRepository extends AbstractRepository
{
    /**
     * @param int $role
     * @return User|null
     */
    public function getAdminRole()
    {
        $query = $this->connection->prepare('select * from users where role=1');
        $query->bindParam(':role', $role);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $query->fetch();
    }
    /**
     * @param string $username
     * @return User|null
     */
    public function getByUsername(string $username)
    {
        $query = $this->connection->prepare('select * from users where username=:username');
        $query->bindParam(':username', $username);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $query->fetch();
    }
    /**
     * @param User $user
     * @return User|null
     */
    public function addUser(User $user)
    {
        $query = $this->connection->prepare(
            'insert into users(username,password) values (:username,:password)');
            $query->bindParam(':username', $user->username);
            $password = password_hash($user->password,PASSWORD_DEFAULT);
            $query->bindParam(':password', $password);
            $query->execute();


    }
    /**
     * @param User $user
     * @return User|null
     */
    public function update(User $user)
    {
        $query = $this->connection->prepare(
            "update users set username=:username, password=:password where id=:id"
        );
        $query->bindParam(':id', $user->id);
        $query->bindParam(':username', $user->username,PDO::PARAM_STR);
        $query->bindParam(':password', $user->password,PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $query->fetch();
    }


}