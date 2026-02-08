<?php

namespace App\Http\Controllers\Auth;

use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Http\Controllers\RegisteredUserController as FortifyRegisteredUserController;


class RegisteredUserController extends FortifyRegisteredUserController
{
    public function store(Request $request, CreatesNewUsers $creator): RegisterResponse
    {
        $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts('register|' . $throttleKey, 5)) {
            throw ValidationException::withMessages([
                'email' => __('auth.too_many_attempts'),
            ]);
        }

        RateLimiter::hit('register|' . $throttleKey, 60);

        $user = $creator->create($request->all());
        if ($user) {
            Auth::login($user);
        }
        return app(RegisterResponse::class);
    }
}
