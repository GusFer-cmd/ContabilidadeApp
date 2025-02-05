<?php

namespace App\Providers;

use App\Repositories\Eloquent\CardRepository;
use App\Repositories\Eloquent\InfoRepository;
use App\Repositories\Eloquent\RenterRepository;
use App\Repositories\Interfaces\ICardRepository;
use App\Repositories\Interfaces\IInfoRepository;
use App\Repositories\Interfaces\IRenterRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerFactories();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public function registerRepositories()
    {
        $this->app->bind(
            ICardRepository::class,
            CardRepository::class 
        );

        $this->app->bind(
            IInfoRepository::class,
            InfoRepository::class 
        );

        $this->app->bind(
            IRenterRepository::class,
            RenterRepository::class 
        );
    }

    public function registerFactories()
    {
    
    }
}
