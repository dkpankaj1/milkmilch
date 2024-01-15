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
use Spatie\Image\Image;

class ProfileController extends Controller
{
    protected $imageManager;

    function __construct()
    {
        $this->imageManager = Image::useImageDriver('gd');
    }

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

        
        if($request->hasFile('avatar')){
            $barcode = $request->file('avatar');
            $profileData["avatar"] = $this->imageManager->loadFile($barcode->getRealPath())->width(160)->height(160)->base64();
        }
        
        $user->fill($profileData);
        
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        toastr()->success('Profile updated successfully!');
        return Redirect::route('admin.profile');
    }

}
