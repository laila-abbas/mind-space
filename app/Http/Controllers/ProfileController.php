<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class ProfileController extends Controller
{
    public function edit(Request $request) {
        return view('settings.edit', [
            'user' => $request->user(),
        ]);
    }

    public function updateInfo(Request $request,  UpdatesUserProfileInformation $updater) {
        $updater->update($request->user(), $request->all());

        return back()->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request, UpdatesUserPasswords $updater) {
        $updater->update($request->user(), $request->all());

        return redirect()->to(route('profile.edit') . '#security')
                 ->with('status', 'password-updated');
    }
}
