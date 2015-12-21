<?php

namespace App\Laravel\Providers;

use App\Bridge\Eloquent\Model\User;
use App\Bridge\Eloquent\AuthenticatableRepository;
use App\Domain\AuthenticatableRepository as AuthenticatableRepositoryInterface;
use Hexavel\Support\Providers\RepositoryProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * @return string[]
     */
    protected function getModelRepositories()
    {
        return [
            AuthenticatableRepository::class => User::class
        ];
    }

    /**
     * @return string[]
     */
    protected function getRepositories()
    {
        return [
            AuthenticatableRepositoryInterface::class => AuthenticatableRepository::class
        ];
    }
}