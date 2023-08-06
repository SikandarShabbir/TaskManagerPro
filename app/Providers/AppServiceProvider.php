<?php

namespace App\Providers;

use App\Http\Controllers\ControllerRepositories\CourseRepository;
use App\Http\Controllers\ControllerRepositories\Interfaces\CourseInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        CourseInterface::class => CourseRepository::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Paginator::useBootstrap();
    }
}
