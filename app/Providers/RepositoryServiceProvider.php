<?php

namespace App\Providers;

use App\Contracts\BlogContract;
use App\Contracts\OfficeContract;
use App\Contracts\LocationContract;
use App\Contracts\TeamContract;
use App\Contracts\UserContract;
use App\Repositories\BlogRepository;
use App\Repositories\OfficeRepository;
use App\Repositories\LocationRepository;
use App\Repositories\TeamRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->singleton(
            UserContract::class,
            UserRepository::class
        );
        $this->app->singleton(
            BlogContract::class,
            BlogRepository::class,
        );

    }
}
