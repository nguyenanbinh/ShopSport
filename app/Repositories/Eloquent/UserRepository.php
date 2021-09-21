<?php
namespace App\Repositories\Eloquent;

use App\User;
use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    public function getModel()
    {
        return  User::class;
    }

    

}