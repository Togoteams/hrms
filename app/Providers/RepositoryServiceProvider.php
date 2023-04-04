<?php

namespace App\Providers;

use App\Contracts\User\UserContract;
use App\Contracts\Role\RoleContract;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories = [
        UserContract::class         => UserRepository::class,
        RoleContract::class         => RoleRepository::class,
      
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
