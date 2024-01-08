<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Profile\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use DB;

class ProfileController extends Controller
{

    public function show(Request $request): View
    {
        return view('backend.profile.index', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('backend.profile.edit', [
            'user' => new UserResource($request->user()),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $profileData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ];

        $user = $request->user();

        $user->fill($profileData);

        if ($request->hasFile('avatar')) {
            $userModel = User::find($request->user()->id);
            // Delete the existing media
            $existingMedia = $userModel->getFirstMedia('avatar');
            if ($existingMedia)
                $existingMedia->delete();

            $userModel->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        toastr()->success('Profile updated successfully!');
        return Redirect::route('admin.profile');
    }

}
