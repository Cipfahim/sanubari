<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updatePassword(Request $request, User $user): RedirectResponse
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($user->getAuthPassword() === Hash::make($request->current_passsword)) {
            $user->update([
                'password' => Hash::make($request->get('new_password'))
            ]);
        } else {
            return Redirect::back()->with('error', 'Current Password doesn\'t match');
        }
    }
}
