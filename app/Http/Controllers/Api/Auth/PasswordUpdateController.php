<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\PasswordUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateController extends Controller
{
    public function update(PasswordUpdateRequest $request): JsonResponse
    {
        try {
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);

            return $this->sendSuccess('Password updated successfully', [], 200);

        } catch (\Exception $e) {

            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);

        }

    }
}
