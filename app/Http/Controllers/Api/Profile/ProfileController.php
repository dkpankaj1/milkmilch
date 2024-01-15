<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Image\Image;

class ProfileController extends Controller
{
    use HttpResponses;

    protected $imageManager;

    function __construct()
    {
        $this->imageManager = Image::useImageDriver('gd');
    }

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

        if($request->hasFile('avatar')){
            $barcode = $request->file('avatar');
            $profileData["avatar"] = $this->imageManager->loadFile($barcode->getRealPath())->width(160)->height(160)->base64();
        }

        $user->fill($profileData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }


        $user->save();

        return $this->sendSuccess('Profile updated successfully.', new UserResource($user));
    }
}
