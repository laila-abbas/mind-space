<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'cropped_avatar' => ['nullable', 'string'],
            'pen_name' => ['nullable', 'string', 'max:255'],
            'biography' => ['nullable', 'string'],
            'website_url' => ['nullable', 'url'],
        ], [
            'email.unique' => __('settings.update_email_failed'),
        ])->validateWithBag('updateProfileInformation');


        if (!empty($input['remove_avatar'])) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = null;
        }

        if (!empty($input['cropped_avatar'])) {
            $image = $input['cropped_avatar'];

            if (!preg_match('/^data:image\/(jpg|jpeg);base64,/', $image)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'cropped_avatar' => __('settings.avatar_invalid_type'),
                ])->errorBag('updateProfileInformation');
            }

            // remove base64 header
            $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $image = str_replace(' ', '+', $image);

            $decoded = base64_decode($image);
            $sizeInMB = strlen($decoded) / 1024 / 1024;
            if ($sizeInMB > 2) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'cropped_avatar' => __('settings.avatar_max_size'),
                ])->errorBag('updateProfileInformation');
            }

            $imageName = 'avatars/' . uniqid() . '.jpg';

            Storage::disk('public')->put($imageName, base64_decode($image));

            // delete old avatar
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $imageName;
        }

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
            ])->save();
        }

        if (isset($input['pen_name']) || isset($input['biography']) || isset($input['website_url'])) {
            $user->author()->update([
                'pen_name' => $input['pen_name'],
                'biography' => $input['biography'],
                'website_url' => $input['website_url'],
            ]);
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
