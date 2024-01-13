<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CustomerStoreRequest;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerRegisterController extends Controller
{
    use HttpResponses;
    public function store(CustomerStoreRequest $request): JsonResponse
    {
        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => Role::where('name', 'customer')->first()->id,
                'status' => 1
            ]);

            Customer::create([
                'user_id' => $user->id
            ]);

            // $user->notify(new SendWelcomeNotification($user,$request->password));
        
            return $this->sendSuccess("register success", $user, 200);

        } catch (\Exception $e) {
            return $this->sendError(trans('api.500'),$e->getMessage(), 500);
        }

    }
}
