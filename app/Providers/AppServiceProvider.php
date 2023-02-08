<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Follow;

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
        //compose all the views....
        view()->composer('*', function ($view) {
            //...with this variable
            $view->with('followCount', Follow::where('follower', auth()->id())->count());
            $view->with('followerCount', Follow::where('follow', auth()->id())->count());
        });
    }
}
