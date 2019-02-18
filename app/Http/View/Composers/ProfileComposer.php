<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\User;
use Auth;

class ProfileComposer
{
    public function compose(View $view)
    {
        if (Auth::user()) {
            $auth = Auth::user();
            $jefedirecto = ($auth->employee->position->depend->employee->user) ?? '' ;
        } else {
            $jefedirecto = null;
        }
        $talentoHumano = (User::whereLevel(374)->first()) ?? '';
        $IT = (User::whereLevel(500)->first()) ?? '';
        $view->with(['IT' => $IT, 'talentoHumano' => $talentoHumano, 'jefedirecto' => $jefedirecto]);
    }
}