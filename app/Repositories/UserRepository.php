<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @param array $data
     * @return User
     */
    public function storeUser(array $data): User
    {
        return User::create($data);
    }
}
