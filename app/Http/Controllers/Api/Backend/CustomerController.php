<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Backend\StoreCustomerRequest;
use App\Http\Requests\Api\Backend\UpdateCustomerRequest;
use App\Http\Resources\Api\CustomerResource;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    use HttpResponses;
    public function index(Request $request)
    {

        try {
            $customers = Customer::where('assign_to', $request->user()->id)->latest()->get();

            return $this->sendSuccess('customer collection', CustomerResource::collection($customers), 200);

        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }

    }

    public function store(StoreCustomerRequest $request)
    {
        try {

            $password = "password";

            // Create a new user with the provided attributes
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email ?? fake()->safeEmail(),
                'phone' => $request->phone,
                'address' => $request->address ?? "no address",
                'city' => $request->city ?? "no city",
                'state' => $request->state ?? " no state",
                'postal_code' => $request->postal_code ?? "no postal code",
                'password' => bcrypt($password),
                'role_id' => Role::where('name', 'customer')->first()->id,
                'status' => 1
            ]);

            $customer = Customer::create([
                'assign_to' => $request->user()->id,
                'user_id' => $user->id
            ]);


            return $this->sendSuccess('customer', [
                'id' => $customer->id,
                "name" => $customer->user->name,
                'phone' => $customer->user->phone,
                'address' => $customer->user->address,
                'city' => $customer->user->city,
                'state' => $customer->user->state,
                'postalCode' => $customer->user->postal_code,
                'country' => $customer->user->country,
            ], 200);

        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }


    }

    public function show(Customer $customer)
    {
        try {
            return $this->sendSuccess('customer', new CustomerResource($customer), 200);
        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        try {

            $customer->user()->update([
                'name' => $request->name ?? $customer->user->name,
                'phone' => $request->phone ?? $customer->user->phone,
                'address' => $request->address ?? $customer->user->address,
                'city' => $request->city ?? $customer->user->city,
                'state' => $request->state ?? $customer->user->state,
                'postal_code' => $request->postal_code ?? $customer->user->postal_code,
            ]);

            return $this->sendSuccess('customer', [
                'id' => $customer->id,
                "name" => $customer->user->name,
                'phone' => $customer->user->phone,
                'address' => $customer->user->address,
                'city' => $customer->user->city,
                'state' => $customer->user->state,
                'postalCode' => $customer->user->postal_code,
                'country' => $customer->user->country,
            ], 200);

        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            DB::transaction(function () use ($customer) {
                $user = $customer->user;
                $customer->delete();
                if ($user) {
                    $user->delete();
                }
            });
            // Return success response
            return $this->sendSuccess(trans('crud.delete', ['model' => 'customer']), new CustomerResource($customer));

        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('crud.401'), ["error" => $e->getMessage()], 422);
        }
    }
}
