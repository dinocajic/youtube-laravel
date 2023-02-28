<?php

namespace App\Providers;

use App\Models\Car;
use App\View\Composers\CarComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('title', 'Laravel Tutorials');

        View::composer(['fastcars.index', 'fastcars.show'], CarComposer::class);
    }
}
