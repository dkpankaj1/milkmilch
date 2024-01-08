<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use HttpResponses;

    public function show(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        $profileData = [
            'name' => $request->name ?: $request->user()->name,
            'email' => $request->email ?: $request->user()->email,
            'phone' => $request->phone ?: $request->user()->phone,
            'address' => $request->address ?: $request->user()->address,
            'city' => $request->city ?: $request->user()->city,
            'state' => $request->state ?: $request->user()->state,
            'postal_code' => $request->postal_code ?: $request->user()->postal_code,
            'country' => $request->country ?: $request->user()->country,
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

        return $this->sendSuccess('Profile updated successfully.', new UserResource($user));
    }
}
