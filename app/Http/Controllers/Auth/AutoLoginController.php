<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AutoLoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        // Only available in local environment
//        abort_unless(app()->environment('local'), 404);

        //Login with first user from database seed
        auth()->login(User::first());

        // Redirect to homepage//
        return Redirect::to(RouteServiceProvider::HOME);
    }
}
