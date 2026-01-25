<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class PasswordResetLinkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts('password-reset|' . $throttleKey, 5)) {
            throw ValidationException::withMessages([
                'email' => __('Too many attempts. Please try again in a minute.'),
            ]);
        }

        RateLimiter::hit('password-reset|' . $throttleKey, 60);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->with('status', __('We have emailed your password reset link.'));
    }
}
