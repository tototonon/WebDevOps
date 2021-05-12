<?php


namespace TononT\Webentwicklung\Repository;


class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->connectToDb();
    }


}