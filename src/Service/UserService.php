<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 12.11.2018
 * Time: 15:07
 */

namespace App\Service;


use App\Model\User;

class UserService
{
    public function __construct()
    {
    }

    public function userExists(User $user): bool
    {
        return false;
    }
}