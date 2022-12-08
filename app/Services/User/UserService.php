<?php

namespace App\Services\User;

use App\Repositories\User\UserReponsitory;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\RenderPagination;

class UserService implements UserServiceInterface
{
    use RenderPagination;
   /**
     * @var $userRepository
     * @var $sendMailService
     */
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function getListAdminUser($perPage, $page)
    {
        $results = $this->userRepository->getPaginateSortId($perPage, $page, ["*"]);

        return $this->renderPagination($results, function ($value) {
            return $this->renderAdminUser($value);
        });
    }

    /**
     * @param $adminUser
     *
     * @return array
     */
    public function renderAdminUser($adminUser)
    {
        return [
            'id' => $adminUser->id,
            'name' => $adminUser->name,
            'hospital_name' => $adminUser->hospital_name,
            'is_admin' => $adminUser->is_admin
        ];
    }
}
