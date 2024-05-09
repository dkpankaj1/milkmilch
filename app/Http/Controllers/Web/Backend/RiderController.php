<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Backend\RiderStoreRequest;
use App\Http\Requests\Web\Backend\RiderUpdateRequest;
use App\Models\Rider;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiderController extends Controller
{
    /**
     * Display a paginated list of riders with associated user information.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        $rider = Rider::query();
        $rider = $rider->with('user')->latest();
        return view('backend.rider.index', ['riders' => $rider->paginate()]);
    }

    /**
     * Redirect to the index page for riders.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function show(Request $request): RedirectResponse
    {
        return redirect()->route('admin.rider.index');
    }

    /**
     * Display the form to create a new rider.
     *
     * @return View
     */
    public function create(): View
    {
        return view('backend.rider.create');
    }

    /**
     * Store a newly created rider and user in the storage.
     *
     * @param  RiderStoreRequest  $request
     * @return RedirectResponse
     */
    public function store(RiderStoreRequest $request): RedirectResponse
    {
        try {
            // Generate a random password
            // $password = $request->generatePassword();
            $password = "password";

            // Create a new user with the provided attributes
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone ?? fake()->phoneNumber(),
                'address' => $request->address ?? "no address",
                'city' => $request->city ?? "no city",
                'state' => $request->state ?? " no state",
                'postal_code' => $request->postal_code?? "no postal code",
                'password' => bcrypt($password),
                'role_id' => Role::where('name', 'rider')->first()->id,
                'status' => $request->status
            ]);

            // Create a corresponding rider record
            Rider::create([
                'user_id' => $user->id
            ]);

            // Notify the user with a welcome notification
            // $user->notify(new SendWelcomeNotification($user, $password));

            // Display success message and redirect back
            toastr()->success(trans('crud.create', ['model' => 'rider']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the form to edit an existing rider.
     *
     * @param  Rider  $rider
     * @return View
     */
    public function edit(Rider $rider): View
    {
        return view('backend.rider.edit', ['rider' => $rider]);
    }

    /**
     * Update the specified rider and associated user in storage.
     *
     * @param  RiderUpdateRequest  $request
     * @param  Rider  $rider
     * @return RedirectResponse
     */
    public function update(RiderUpdateRequest $request, Rider $rider): RedirectResponse
    {
        try {
            // Update the user attributes based on the request
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

            // Display success message and redirect back
            toastr()->success(trans('crud.update', ['model' => 'rider']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the confirmation for deleting a rider.
     *
     * @param  Rider  $rider
     * @return View
     */
    public function delete(Rider $rider)
    {
        return view('backend.rider.delete', ['rider' => $rider]);
    }

    /**
     * Remove the specified rider and associated user from storage.
     *
     * @param  Rider  $rider
     * @return RedirectResponse
     */
    public function destroy(Rider $rider): RedirectResponse
    {
        try {
            // Delete the specified user
            User::destroy($rider->user_id);

            // Display success message and redirect back
            toastr()->success(trans('crud.delete', ['model' => 'rider']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
