<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
    }

    /**
     *getUser
     *
     * @param
     * */
    public function getListAdminUser()
    {
        return $this->model->select('name')->take(5)->get();
    }
}
