<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Backend\SupplierStoreRequest;
use App\Http\Requests\Web\Backend\SupplierUpdateRequest;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\SendWelcomeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function index(Request $request): View
    {

        $supplier = Supplier::query();
        $supplier = $supplier->with('user')->latest();
        return view('backend.supplier.index', ['suppliers' => $supplier->paginate()]);
    }
    public function show(Request $request): RedirectResponse
    {
        return redirect()->route('admin.supplier.index');
    }

    public function create(): View
    {
        return view('backend.supplier.create');
    }

    public function store(SupplierStoreRequest $request): RedirectResponse
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
                'role_id' => Role::where('name','supplier')->first()->id,
                'status' => $request->status
            ]);

            Supplier::create([
                'user_id' => $user->id
            ]);

            // Notify the user with a welcome notification
            $user->notify(new SendWelcomeNotification($user, $password));

            // Display success message and redirect back
            toastr()->success(trans('crud.create', ['model' => 'suppplier']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function edit(Supplier $supplier): View
    {
        // $supplierUser = User::where('id', $supplier->user_id)->first();
        return view('backend.supplier.edit',  ['supplier' => $supplier]);
    }
    public function update(SupplierUpdateRequest $request,Supplier $supplier): RedirectResponse
    {
        try {
            // Update the user attributes based on the request
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

            // Display success message and redirect back
            toastr()->success(trans('crud.update', ['model' => 'supplier']));
            return redirect()->back();

        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function delete(Supplier $supplier)
    {
        // Return the view with user data
        return view('backend.supplier.delete', ['supplier' => $supplier]);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Supplier $supplier)
    {
        try {
            // Delete the specified user
            User::destroy($supplier->user_id);

            // Display success message and redirect back
            toastr()->success(trans('crud.delete', ['model' => 'supplier']));
            return redirect()->back();
        } catch (\Exception $e) {
            // Display error message and redirect back in case of an exception
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
