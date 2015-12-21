<?php

namespace App\Domain;

use Illuminate\Contracts\Auth\Authenticatable;

interface AuthenticatableRepository
{
    /**
     * @param string $email
     * @return Authenticatable
     */
    public function findByAuthIdentifier($email);

    /**
     * @param Authenticatable $model
     */
    public function save($model);

    /**
     * @param Authenticatable $model
     */
    public function remove($model);
}