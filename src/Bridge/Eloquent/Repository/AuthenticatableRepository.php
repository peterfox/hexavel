<?php

namespace App\Bridge\Eloquent;

use App\Bridge\Eloquent\Model\User;
use App\Domain\AuthenticatableRepository as AuthenticatableRepositoryInterface;
use Hexavel\Repository\EloquentRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthenticatableRepository extends EloquentRepository implements AuthenticatableRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    /**
     * @param string $email
     * @return Authenticatable
     */
    public function findByAuthIdentifier($email)
    {
        return $this->model->where('email', $email)->first();
    }
}