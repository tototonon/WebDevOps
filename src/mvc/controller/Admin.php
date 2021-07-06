<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;

use TononT\Webentwicklung\Repository\UserRepository;

class Admin
{

    /**
     * @param $user
     * @return bool
     */
    public function admin($user): bool
    {
        $userRepository = new UserRepository();
        $admin = $userRepository->isAdmin($user->getRole());
        if ($admin->role == "1") {
            //echo "<h1>Hello Admin</h1>";
            return true;
            //redirect
        } else {
            //echo "<h1>Hello User</h1>";
            return false;
        }
    }
}
