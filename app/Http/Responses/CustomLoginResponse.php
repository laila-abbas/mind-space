<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse;

class CustomLoginResponse implements LoginResponse
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
