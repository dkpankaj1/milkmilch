<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('assets/vendor/bs-select/bs-select.css') }}">
        <style>
            .table-responsive {
                max-height: 300px;
            }
        </style>
    @endpush

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.transaction.create', $payment) }}
    @endpush

    <div class="card">
        <div class="card-header">
            <div class="card-title">Transaction</div>
        </div>
        <div class="card-body">
            <div class="card-border">

                <div class="card-border-body">
                    <div class="row">
                        <div class="col-12">
                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                <tr>
                                    <td
                                        style="padding-top: 12px; padding-bottom: 12px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                                        <p style="font-family: 'Poppins', sans-serif;">
                                            <strong>Date:</strong> {{ now() }}
                                        </p>
                                    </td>
                                    <td
                                        style="padding-top: 12px; padding-bottom: 12px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                                        <p align="right"
                                            style="text-align: right; font-family: 'Poppins', sans-serif;">
                                            <strong>Invoice No:</strong> #{{ $payment->id }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table class="w-100">
                                <tr>
                                    <td style="padding-top: 20px; padding-bottom: 20px;">
                                        <p align="right"
                                            style="text-align: left; font-family: 'Poppins', sans-serif; line-height: 1.2;">
                                            <strong style="display: block; margin-bottom: 5px;">Invoiced To:</strong>
                                            {{ $payment->customer->user->name }} <br />
                                            {{ $payment->customer->user->email }},
                                            {{ $payment->customer->user->phone }} <br />
                                            {{ $payment->customer->user->address }},
                                            {{ $payment->customer->user->city }} <br />
                                            {{ $payment->customer->user->state }},
                                            {{ $payment->customer->user->postal_code }}
                                            <br />
                                            {{ $payment->customer->user->country }}<br />
                                        </p>
                                    </td>
                                    <td style="padding-top: 20px; padding-bottom: 20px;">
                                        <p align="left" style="font-family: 'Poppins', sans-serif; line-height: 1.2;">
                                            <strong style="display: block; margin-bottom: 5px;">Pay To:</strong>
                                            {{ $companyState->name }} <br />
                                            {{ $companyState->email }}, {{ $companyState->phone }} <br />
                                            {{ $companyState->address }}, {{ $companyState->city }} <br />
                                            {{ $companyState->state }}, {{ $companyState->postal_code }}<br />
                                            {{ $companyState->country }}<br />
                                        </p>
                                    </td>

                                </tr>
                            </table>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="table-responsive mb-3 border">
                                <table class="table m-0 text-nowrap">
                                    <thead>
                                        <tr>

                                            <th class="bg-primary text-white">ID</th>
                                            <th class="bg-primary text-white">Date</th>
                                            <th class="bg-primary text-white">Order Status</th>
                                            <th class="bg-primary text-white">Payment Status</th>
                                            <th class="bg-primary text-white">Grand
                                                Total({{ $companyState->currency->symbol }})</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payment->sales as $sale)
                                            <tr>
                                                <td>#S{{ $sale->id }}</td>
                                                <td>{{ $sale->date }}</td>
                                                <td>{{ $sale->order_status }}</td>
                                                <td>{{ $sale->payment_status }}</td>
                                                <td>{{ $sale->grand_total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <form action="{{ route('admin.transaction.store',$payment) }}" method="POST" id="myForm">
                                @csrf
                                <div class="row mt-5" id="calculet_amt">
                                    <div class=" col-md-8 col-12">

                                    </div>
                                    <div class="col-md-4 col-12">

                                        <div class="mb-2">
                                            <span class="">Discount
                                                ({{ $payment->discount_type == 'percentage' ? '%' : $companyState->currency->code }})
                                                : {{ $payment->discount }} </span>
                                        </div>
                                        <div class="mb-2">
                                            <span>Other Charges ({{ $companyState->currency->symbol }}) :
                                                {{ $payment->other_amt }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <hr>
                                            <h5 class="text-bold">Grand Total {{ $companyState->currency->symbol }}) :
                                                {{ $payment->grand_total }}</h5>
                                            <hr>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    name="use_wallet">

                                                <label class="form-check-label" for="inlineCheckbox1">Use Wallet
                                                    ({{ $payment->customer->wallet }}
                                                    {{ $companyState->currency->symbol }} )</label>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Paid Amount
                                                    ({{ $companyState->currency->symbol }})</span>
                                                <input type="text" class="form-control" placeholder="0"
                                                    name="paid_amt"
                                                    value="{{ old('paid_amt', $payment->paid_amount) }}" />
                                                @error('paid_amt')
                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        @error('id')
                                            <div class="invalid-feedback d-block py-2-">{{ $message }}
                                            </div>
                                        @enderror
                                        <hr>
                                        <button class="btn btn-info px-5">Save</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
