<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;

class UserReponsitory extends BaseRepository implements UserRepositoryInterFace
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUser()
    {
        return $this->model->select('name')->take(5)->get();
    }
}
