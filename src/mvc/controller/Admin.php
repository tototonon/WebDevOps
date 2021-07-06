<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;

use TononT\Webentwicklung\mvc\model\User;
use TononT\Webentwicklung\Repository\UserRepository;

class Admin
{

    /**
     * @param $user
     */
    public function admin($user)
    {

        $userRepository = new UserRepository();
        $admin = $userRepository->isAdmin($user->getRole());
        if ($admin->role == "1") {
            echo "<h1>Hello Admin</h1>";
            $role = $user->role;
            return true;
            //redirect to Admin view
        } else {
            echo "<h1>Hello User</h1>";
            $role = $user->role;

            return false;

            //redirect to User view
        }
    }
}
