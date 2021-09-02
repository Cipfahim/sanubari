<?php

namespace App\Http\Controllers;

use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class OtpLoginController extends Controller
{
    /**
     * @return Response
     */
    public function show(): Response
    {
        return Inertia::render('Auth/OtpLogin');
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $user = User::exceptEmployee()
            ->where('phone', $request->get('phone'))
            ->first();

        if (!isset($user)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        } else {
            $loginAttempt = LoginAttempt::create([
                'phone' => $request->get('phone'),
                'otp_code' => Str::substr(now()->timestamp, 4, 8)
            ]);

            // Send otp code
            sendOtp($loginAttempt->phone, $loginAttempt->otp_code);

            return Inertia::render('Auth/OtpCheck');
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function check(Request $request)
    {
        $loginAttempt = LoginAttempt::where('otp_code', $request->get('otp'))->first();

        if (!isset($loginAttempt)) {
            return Redirect::back()->with('error', 'Invalid Otp');
        } else {
            Auth::login(User::where('phone', $loginAttempt->phone)->first());
            $loginAttempt->delete();
            return Redirect::to(RouteServiceProvider::HOME);
        }
    }
}
