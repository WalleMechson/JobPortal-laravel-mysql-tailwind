<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'token' => 'required',
        ]);
        $email = DB::table('password_reset_tokens')->where('token', $request["token"])->value('email');

        $response = Password::reset([...$request->only('password', 'password_confirmation', 'token'), $email], function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $response == Password::PASSWORD_RESET
            ? redirect('/')->with('success', __('Your password has been reset!'))
            : back()->withErrors(['email' => __($response)]);
    }
}
