<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;

class CustomAuthResponse implements LoginResponse, RegisterResponse
{
    public function toResponse($request)
    {
        $user = $request->user();
        
        if (!$user) { // if the email already taken the user would be null
            return redirect()->route('register')->with('status', __('auth.registration_error'));
        }
        
        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('Publisher')) {
            return redirect()->route('publisher.dashboard');
        }

        return redirect()->route('home');
    }
}
