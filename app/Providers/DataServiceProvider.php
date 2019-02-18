<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\User;
use Auth;

class DataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services
          *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if(!$view->offsetExists('auth')) {
                if (Auth::user()) {
                    $auth = Auth::user();
                    $user = User::with('employee')->find($auth->id);
                    $view->with(['auth' => $auth, 'user' => $user]);
                }
            }
        });

        View::composer(['pys.table', 'pys.level.talento'], 'App\Http\View\Composers\ProfileComposer');


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

