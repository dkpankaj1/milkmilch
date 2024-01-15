<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Backend\CustomerStoreRequest;
use App\Http\Requests\Web\Backend\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {

        $customer = Customer::query();
        $customer = $customer->with('user')->latest();
        return view('backend.customer.index', ['customers' => $customer->paginate()]);
    }
    public function show(Request $request): RedirectResponse
    {
        return redirect()->route('admin.supplier.index');
    }

    public function create(): View
    {
        return view('backend.customer.create');
    }

    public function store(CustomerStoreRequest $request): RedirectResponse
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
                'role_id' => Role::where('name', 'customer')->first()->id,
                'status' => $request->status
            ]);

            Customer::create([
                'user_id' => $user->id
            ]);

            // Notify the user with a welcome notification
            $user->notify(new SendWelcomeNotification($user, $password));

            // Display success message and redirect back
            toastr()->success(trans('crud.create', ['model' => 'customer']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function edit(Customer $customer): View
    {
        // $customerUser = User::where('id', $customer->user_id)->first();
        return view('backend.customer.edit', ['customer' => $customer]);
    }
    public function update(CustomerUpdateRequest $request, Customer $customer): RedirectResponse
    {
        try {
            // Update the user attributes based on the request
            $customer->user->update([
                'name' => $request->name ?: $customer->user->name,
                'email' => $request->email ?: $customer->user->email,
                'phone' => $request->phone ?: $customer->user->phone,
                'address' => $request->address ?: $customer->user->address,
                'city' => $request->city ?: $customer->user->city,
                'state' => $request->state ?: $customer->user->state,
                'postal_code' => $request->postal_code ?: $customer->user->postal_code,
                'status' => $request->status
            ]);

            // Display success message and redirect back
            toastr()->success(trans('crud.update', ['model' => 'customer']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function delete(Customer $customer)
    {
        // Return the view with user data
        return view('backend.customer.delete', ['customer' => $customer]);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        try {
            // Delete the specified user
            User::destroy($customer->user_id);

            // Display success message and redirect back
            toastr()->success(trans('crud.delete', ['model' => 'customer']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
