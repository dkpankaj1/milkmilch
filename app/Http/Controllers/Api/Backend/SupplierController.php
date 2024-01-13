<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Backend\SupplierStoreRequest;
use App\Http\Requests\Api\Backend\SupplierUpdateRequest;
use App\Http\Resources\SupplierCollection;
use App\Http\Resources\SupplierResource;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

/**
 * Class SupplierController
 * @package App\Http\Controllers\Api\Backend
 */
class SupplierController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        // Retrieve suppliers with associated user information
        $supplier = Supplier::query();
        $supplier = $supplier->with('user');
        
        // Return a success response with the supplier collection
        return $this->sendSuccess('Supplier collection', new SupplierCollection($supplier->paginate()->appends($request->query())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SupplierStoreRequest  $request
     * @return JsonResponse
     */
    public function store(SupplierStoreRequest $request): JsonResponse
    {
        try {
            // Generate a random password for the new user
            $password = $request->generatePassword();

            // Create a new user with staff role
            $user = User::create([
                // Assign user attributes from the request
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'password' => bcrypt($password),
                'role_id' => Role::where('name', 'supplier')->first()->id,
                'status' => $request->status
            ]);

            // Create a corresponding supplier record
            $supplier = Supplier::create([
                'user_id' => $user->id
            ]);

            // Notify the new user with a welcome notification
            // $user->notify(new SendWelcomeNotification($user, $password));

            // Return a success response with the newly created supplier resource
            return $this->sendSuccess(trans('crud.create', ['model' => 'supplier']), new SupplierResource($supplier), 200);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Supplier  $supplier
     * @return JsonResponse
     */
    public function show(Supplier $supplier): JsonResponse
    {
        // Return a success response with the specified supplier resource
        return $this->sendSuccess('supplier resource', new SupplierResource($supplier));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SupplierUpdateRequest  $request
     * @param  Supplier  $supplier
     * @return JsonResponse
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier): JsonResponse
    {
        try {
            // Update the user information associated with the supplier
            $supplier->user->update([
                'name' => $request->name ?: $supplier->user->name,
                'email' => $request->email ?: $supplier->user->email,
                'phone' => $request->phone ?: $supplier->user->phone,
                'address' => $request->address ?: $supplier->user->address,
                'city' => $request->city ?: $supplier->user->city,
                'state' => $request->state ?: $supplier->user->state,
                'postal_code' => $request->postal_code ?: $supplier->user->postal_code,
                'status' => $request->status
            ]);

            // Return a success response with the updated supplier resource
            return $this->sendSuccess(trans('crud.update', ['model' => 'supplier']), new SupplierResource($supplier), 200);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Supplier  $supplier
     * @return JsonResponse
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        try {
            // Delete the user associated with the supplier
            User::destroy($supplier->user_id);

            // Return a success response after deleting the supplier
            return $this->sendSuccess(trans('crud.delete', ['model' => 'supplier']), []);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return $this->sendError(trans('crud.422'), ["error" => $e->getMessage()],422);
        }
    }
}
