<?php

namespace App\Http\Controllers\Api\Backend;

use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    use HttpResponses;
    public function getByCustomer(Request $request)
    {
        $request->validate([
            'customer' => ['required', Rule::exists(Customer::class, 'id')]
        ]);

        try {
            $transactions = Transaction::where('customer_id', $request->customer)->where('status', TransactionStatus::GENERATED)->get();
            $customer = Customer::with('user')->find($request->customer)->first();

            return $this->sendSuccess('stock', [
                'customer' => [
                    "id" => $customer->id,
                    "name" => $customer->user->name,
                    "email" => $customer->user->email,
                    "phone" => $customer->user->phone,
                    "address" => $customer->user->address,
                    "city" => $customer->user->city,
                    "state" => $customer->user->state,
                    "postal_code" => $customer->user->postal_code,
                    "country" => $customer->user->country,
                    "wallet" => $customer->wallet,
                ],
                "transaction" => $transactions
            ]);
        } catch (\Exception $e) {
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }


    }
    public function addPaymentCollection(Request $request)
    {
        $request->validate([
            'transaction' => ['required', Rule::exists(Transaction::class, 'id')],
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);


        try {

            $transaction = Transaction::where('id', $request->transaction)->first();

            if ($transaction->status == TransactionStatus::COMPLETED) {
                return $this->sendError('update error', ["error" => "Only transactions with status 'Completed' or 'Processing' cannot be updated."], 422);
            }

            $transaction->update([
                'collect_amount' => $request->amount,
                'status' => TransactionStatus::PROCESSING
            ]);

            return $this->sendSuccess('transaction', [
                'transaction' => [
                    $transaction
                ]
            ]);
        } catch (\Exception $e) {
            return $this->sendError(trans('api.422'), ["error" => $e->getMessage()], 422);
        }
    }
}
