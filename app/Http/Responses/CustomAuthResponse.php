<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;

class CustomAuthResponse implements LoginResponse, RegisterResponse
{
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('Publisher')) {
            return redirect()->route('publisher.dashboard');
        }

        return redirect()->route('home');
    }
}
