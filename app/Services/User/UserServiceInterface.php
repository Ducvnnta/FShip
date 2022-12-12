<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function getListAdminUser($perPage, $page);

    public function registerUser($request);
    
    public function checkTokenDeviceExists($deviceToken);
}
