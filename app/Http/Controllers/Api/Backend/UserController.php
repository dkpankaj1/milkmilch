<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Backend\UserStoreRequest;
use App\Http\Requests\Api\Backend\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use HttpResponses;

    /**
     * Display a paginated list of staff users.
     *
     * @return UserCollection
     */
    public function index()
    {
        // Retrieve staff users and paginate the results
        $users = User::whereHas('role', function ($query) {
                $query->where('name', 'staff');
            })
            ->paginate();

        return new UserCollection($users);
    }

    /**
     * Store a newly created user with staff role.
     *
     * @param  UserStoreRequest  $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        try {
            // Generate a random password
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
                'role_id' => Role::where('name','staff')->first()->id,
                'status' => $request->status
            ]);

            // Notify the user with a welcome notification
            $user->notify(new SendWelcomeNotification($user, $password));

            // Return success response
            return $this->sendSuccess(trans('crud.create', ['model' => 'staff']), new UserResource($user), 200);

        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('api.401'), ["error" => $e->getMessage()], 401);
        }
    }

    /**
     * Display the specified user.
     *
     * @param  User  $user
     * @return UserResource
     */
    public function show(User $user)
    {
        // Return a resource representing the specified user
        return $this->sendSuccess("Staff Resource", new UserResource($user));
    }

    /**
     * Update the specified user.
     *
     * @param  UserUpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            // Update the user attributes based on the request
            $user->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->email ?? $user->email,
                'phone' => $request->phone ?? $user->phone,
                'address' => $request->address ?? $user->address,
                'city' => $request->city ?? $user->city,
                'state' => $request->state ?? $user->state,
                'postal_code' => $request->postal_code ?? $user->postal_code,
                'role_id' => Role::where('name','staff')->first()->id,
                'status' => $request->has('status') ? $request->status : $user->status
            ]);

            // Return success response
            return $this->sendSuccess(trans('crud.update', ['model' => 'staff']), new UserResource($user));

        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('crud.401'), ["error" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        // Check if the user is the default admin (ID 1)
        if ($user->id == 1) {
            // Return error response for attempting to delete the default admin
            return $this->sendError(trans('api.405'), [], 405);
        }

        try {
            // Delete the specified user
            $user->delete();

            // Return success response
            return $this->sendSuccess(trans('crud.delete', ['model' => 'staff']), new UserResource($user));

        } catch (\Exception $e) {
            // Return error response in case of an exception
            return $this->sendError(trans('crud.401'), ["error" => $e->getMessage()]);
        }
    }
}
