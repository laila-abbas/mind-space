<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LocaleController extends Controller
{
    public function set(Request $request)
    {
        $locale = $request->validate(['locale' => 'required|in:en,ar'])['locale'];

        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $user->update(['locale' => $locale]);
        }

        return response()
            ->json(['ok' => true])
            ->cookie('locale', $locale, 60*24*30); // 30 days, for users when log out;
    }
}
