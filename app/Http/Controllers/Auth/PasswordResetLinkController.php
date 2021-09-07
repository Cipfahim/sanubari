<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param Request $request
     * @return Response
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $user = User::where('phone', $request->get('phone'))->first();

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
//            sendOtp($loginAttempt->phone, $loginAttempt->otp_code);

            return Inertia::render('Auth/OtpCheck', [
                'forgot_password' => true
            ]);
        }
    }
}
