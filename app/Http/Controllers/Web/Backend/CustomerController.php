<?php

namespace App\Http\Controllers\Web\Backend;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Backend\CustomerStoreRequest;
use App\Http\Requests\Web\Backend\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Rider;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {


        $customers = Customer::query();

        if ($request->filled("search")) {
            $customers = Customer::whereHas('user', function ($query) {
                $query->where('name', 'Like', '%' . request('search') . '%')
                    ->orwhere('email', 'Like', '%' . request('search') . '%')
                    ->orwhere('phone', 'Like', '%' . request('search') . '%');
            });
        } else {
            $customers = $customers->with('user')->latest();
        }

        return view('backend.customer.index', ['customers' => $customers->paginate()]);
    }
    public function show(Request $request): RedirectResponse
    {
        return redirect()->route('admin.supplier.index');
    }

    public function create(): View
    {
        return view('backend.customer.create', ['riders' => Rider::with('user')->latest()->get()]);
    }

    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        try {
            // Generate a random password
            // $password = $request->generatePassword();
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
                'status' => $request->status
            ]);

            Customer::create([
                'assign_to' => $request->assign_to,
                'user_id' => $user->id
            ]);

            // Notify the user with a welcome notification
            // $user->notify(new SendWelcomeNotification($user, $password));

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
        return view('backend.customer.edit', ['customer' => $customer, 'riders' => Rider::with('user')->latest()->get()]);
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

            $customer->update([
                'assign_to' => $request->assign_to ?? $customer->assign_to,
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
            $user_id = $customer->user_id;
            $customer->delete();
            User::destroy($user_id);

            // Display success message and redirect back
            toastr()->success(trans('crud.delete', ['model' => 'customer']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function exportExcel()
    {
        return Excel::download(new CustomerExport, 'customer.xlsx');
    }
}
