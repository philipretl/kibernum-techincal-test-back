<?php

namespace App\Providers;

use App\Contracts\ExternalServices\UsersServiceHandler;
use App\Services\ExternalServices\UsersServiceHandlerImpl;
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
    }
}
