<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AccountDeleted;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit(Request $request) {
        return view('settings.edit', [
            'user' => $request->user(),
        ]);
    }

    public function updateInfo(Request $request,  UpdatesUserProfileInformation $updater) {
        $updater->update($request->user(), $request->all());

        return back()->with('status', __('settings.account_updated'));
    }

    public function updatePassword(Request $request, UpdatesUserPasswords $updater) {
        $updater->update($request->user(), $request->all());

        return back()->with('status', __('passwords.password_changed'));
    }

    public function destroy()
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }
        // send deletion email before logout
        $user->notify(new AccountDeleted());

        Auth::logout();

        $user->delete(); // soft delete

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login')->with('status', __('auth.account_deleted_notice'));
    }

    public function restore($id)
    {
        // automatically checks the signature (signed middleware)
        $user = User::withTrashed()->findOrFail($id);

        if ($user->deleted_at->diffInDays(now()) > 14) {
            abort(403, 'This restore link has expired.');
        }

        $user->restore(); // undo soft delete

        return redirect('/login')->with('status', __('auth.account_restored_success'));
    }
}
