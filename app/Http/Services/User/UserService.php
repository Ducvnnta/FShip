<?php

namespace App\Services\User;

use App\Repositories\User\UserReponsitory;

class UserService implements UserServiceInterface
{
   /**
     * @var $userRepository
     * @var $sendMailService
     */
    protected $userRepository;

    public function __construct(
        UserReponsitory $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function getListAdminUser()
    {
        
    }
}
