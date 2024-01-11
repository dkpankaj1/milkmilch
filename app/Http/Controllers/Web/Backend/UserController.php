<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Backend\UserStoreRequest;
use App\Http\Requests\Web\Backend\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a paginated list of staff users.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Retrieve staff users and paginate the results
        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'staff');
        })->latest()->paginate();

        // Return the view with a UserCollection instance
        return view('backend.users.index', ['users' => new UserCollection($users)]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        // Return the view with roles data
        return view('backend.users.create');
    }

    /**
     * Store a newly created user in the storage.
     *
     * @param  UserStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        try {
            // Generate a random password
            $password = $request->generatePassword();

            // Create a new user with the provided attributes
            $user = User::create([
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
            // $user->notify(new SendWelcomeNotification($user, $password));

            // Display success message and redirect back
            toastr()->success(trans('crud.create', ['model' => 'user']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the specified user.
     *
     * @param  string  $id
     * @return void
     */
    public function show(string $id)
    {
        // Placeholder method, not implemented
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  User  $user
     * @return View
     */
    public function edit(User $user)
    {
        // Retrieve roles excluding 'admin' and 'customer'
        $roles = Role::where('name', '!=', 'admin')->where('name', '!=', 'customer')->get();

        // Return the view with user and roles data
        return view('backend.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified user in the storage.
     *
     * @param  UserUpdateRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            // Update the user attributes based on the request
            $user->update([
                'name' => $request->name ?: $user->name,
                'email' => $request->email ?: $user->email,
                'phone' => $request->phone ?: $user->phone,
                'address' => $request->address ?: $user->address,
                'city' => $request->city ?: $user->city,
                'state' => $request->state ?: $user->state,
                'postal_code' => $request->postal_code ?: $user->postal_code,
                'status' => $request->status
            ]);

            // Display success message and redirect back
            toastr()->success(trans('crud.update', ['model' => 'user']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the confirmation view for deleting the specified user.
     *
     * @param  User  $user
     * @return View
     */
    public function delete(User $user)
    {
        // Return the view with user data
        return view('backend.users.delete', ['user' => $user]);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        try {
            // Delete the specified user
            $user->delete();

            // Display success message and redirect back
            toastr()->success(trans('crud.delete', ['model' => 'user']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
