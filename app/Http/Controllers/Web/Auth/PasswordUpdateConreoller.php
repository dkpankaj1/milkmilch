<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\PasswordUpdateRequest;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateConreoller extends Controller
{
    public function update(PasswordUpdateRequest $request)
    {

        try {
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);
            // Display success message and redirect back
            toastr()->success(trans('crud.update', ['model' => 'Password']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }

    }
}
