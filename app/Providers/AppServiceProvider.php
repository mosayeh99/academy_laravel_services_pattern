<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('permission', function (...$permission) {
            foreach(array_keys(config('auth.guards')) as $guard){
                if(auth()->guard($guard)->check()){
                    return auth($guard)->user()->canany($permission);
                }
            }
            return null;
        });
    }
}
