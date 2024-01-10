<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Backend\RiderStoreRequest;
use App\Http\Requests\Web\Backend\RiderUpdateRequest;
use App\Http\Resources\RiderCollection;
use App\Http\Resources\RiderResource;
use App\Models\Rider;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    use HttpResponses;

    /**
     * Retrieve and paginate a collection of riders with associated user information.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        // Retrieve riders with associated user information, sorted by the latest
        $rider = Rider::query();
        $rider = $rider->with('user')->latest();

        // Return a success response with the rider collection, including pagination
        return $this->sendSuccess('Rider collection', new RiderCollection($rider->paginate()->appends($request->query())));
    }

    /**
     * Store a newly created rider and user in the storage.
     *
     * @param  RiderStoreRequest  $request
     * @return JsonResponse
     */
    public function store(RiderStoreRequest $request): JsonResponse
    {
        try {
            // Generate a random password for the new user
            $password = $request->generatePassword();

            // Create a new user with the rider role
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
                'role_id' => Role::where('name', 'rider')->first()->id,
                'status' => $request->status
            ]);

            // Create a corresponding rider record
            $rider = Rider::create([
                'user_id' => $user->id
            ]);

              $user->notify(new SendWelcomeNotification($user, $password));

            // Return a success response with the newly created rider resource
            return $this->sendSuccess(trans('crud.create', ['model' => 'rider']), new RiderResource($rider), 200);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return $this->sendError(trans('api.401'), ["error" => $e->getMessage()], 401);
        }
    }

    /**
     * Display the specified rider resource.
     *
     * @param  Rider  $rider
     * @return JsonResponse
     */
    public function show(Rider $rider): JsonResponse
    {
        // Return a success response with the specified rider resource
        return $this->sendSuccess('Rider resource', new RiderResource($rider));
    }

    /**
     * Update the specified rider and associated user in storage.
     *
     * @param  RiderUpdateRequest  $request
     * @param  Rider  $rider
     * @return JsonResponse
     */
    public function update(RiderUpdateRequest $request, Rider $rider): JsonResponse
    {
        try {
            // Update the user information associated with the rider
            $rider->user->update([
                'name' => $request->name ?: $rider->user->name,
                'email' => $request->email ?: $rider->user->email,
                'phone' => $request->phone ?: $rider->user->phone,
                'address' => $request->address ?: $rider->user->address,
                'city' => $request->city ?: $rider->user->city,
                'state' => $request->state ?: $rider->user->state,
                'postal_code' => $request->postal_code ?: $rider->user->postal_code,
                'status' => $request->status
            ]);

            // Return a success response with the updated rider resource
            return $this->sendSuccess(trans('crud.update', ['model' => 'rider']), new RiderResource($rider), 200);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return $this->sendError(trans('api.401'), ["error" => $e->getMessage()], 401);
        }
    }

    /**
     * Remove the specified rider and associated user from storage.
     *
     * @param  Rider  $rider
     * @return JsonResponse
     */
    public function destroy(Rider $rider): JsonResponse
    {
        try {
            // Delete the user associated with the rider
            User::destroy($rider->user_id);

            // Return a success response after deleting the rider
            return $this->sendSuccess(trans('crud.delete', ['model' => 'rider']), []);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return $this->sendError(trans('crud.401'), ["error" => $e->getMessage()], 401);
        }
    }
}
