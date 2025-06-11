<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;

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
    public function boot()
    {
         View::composer('*', function ($view) {
        $user = Auth::user();
        $modules = [];

        if ($user && $user->role) {
            $modules = $user->role->modules()->orderBy('label')->get();
        }

        $view->with('modules', $modules);
    });
    }
}
