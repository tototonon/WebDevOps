<?php


namespace TononT\Webentwicklung\Repository;


use TononT\Webentwicklung\mvc\model\User;

class UserRepository extends AbstractRepository
{
    /**
     * @param string $username
     * @return User|null
     */
    public function getByUsername(string $username)
    {
        $query = $this->connection->prepare("select * from users where username=:username");
        $query->bindParam(':username', $username);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $query->fetch();
    }

    /**
     * @param User $user
     * @return User|null
     */
    public function update(User $user)
    {
        $query = $this->connection->prepare(
            'update users set username =:username, password = :password where id=:id'
        );
        $query->bindParam(':id', $user->id);
        $query->bindParam(':username', $user->username);
        $query->bindParam(':password', $user->password);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $query->fetch();
    }


}