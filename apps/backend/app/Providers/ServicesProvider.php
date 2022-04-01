<?php

namespace App\Providers;

use App\Contracts\ExternalServices\UsersServiceHandler;
use App\Contracts\UsersService;
use App\Services\ExternalServices\UsersServiceHandlerImpl;
use App\Services\UsersServiceImpl;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UsersServiceHandler::class, UsersServiceHandlerImpl::class);
        $this->app->bind(UsersService::class, UsersServiceImpl::class);
    }
}
