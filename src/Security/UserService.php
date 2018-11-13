<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 13.11.2018
 * Time: 23:17
 */

namespace App\Security;


use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($email): ?User
    {
        //TODO: Refactoring collectUserProviderByTagsInCompilerPass and then pass it here
        $userEntity = $this->userRepository->findOneBy(['email' => $email]);
        //TODO: add get User From LDAP by UserProvider (wait for LDAP Server finish)

        return $userEntity;
    }
}