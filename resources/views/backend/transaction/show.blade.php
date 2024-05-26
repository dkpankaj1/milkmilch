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
        {{ Breadcrumbs::render('admin.transaction.show', $transaction) }}
    @endpush

    <div class="card">
        <div class="card-header">
            <div class="card-title">Show Transaction</div>
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
                                            <strong>Date:</strong> {{ $transaction->created_at }}
                                        </p>
                                    </td>
                                    <td
                                        style="padding-top: 12px; padding-bottom: 12px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                                        <p align="right"
                                            style="text-align: right; font-family: 'Poppins', sans-serif;">
                                            <strong>Invoice No:</strong> #{{ $transaction->id }}
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
                                            {{ $transaction->customer->user->name }} <br />
                                            {{ $transaction->customer->user->email }},
                                            {{ $transaction->customer->user->phone }} <br />
                                            {{ $transaction->customer->user->address }},
                                            {{ $transaction->customer->user->city }} <br />
                                            {{ $transaction->customer->user->state }},
                                            {{ $transaction->customer->user->postal_code }}
                                            <br />
                                            {{ $transaction->customer->user->country }}<br />
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

                                            <th class="bg-primary text-white">#</th>
                                            <th class="bg-primary text-white">Invoice</th>
                                            <th class="bg-primary text-white">Date</th>
                                            <th class="bg-primary text-white">Order Status</th>
                                            <th class="bg-primary text-white">Payment Status</th>
                                            <th class="bg-primary text-white">Grand
                                                Total({{ $companyState->currency->symbol }})</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->sells as $key => $sale)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>#S-{{ $sale->id }}</td>
                                                <td>{{ $sale->date }}</td>
                                                <td>{{ $sale->order_status }}</td>
                                                <td>{{ $sale->payment_status }}</td>
                                                <td>{{ $sale->grand_total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <form action="{{ route('admin.transaction.store', $transaction) }}" method="POST"
                                id="myForm">
                                @csrf
                                <div class="row mt-3" id="calculet_amt">
                                    <div class=" col-md-8 col-12">

                                    </div>
                                    <div class="col-md-4 col-12">

                                        <div class="mb-2">
                                            <span class="">Discount
                                                ({{ $transaction->discount_type == 'percentage' ? '%' : $companyState->currency->code }})
                                                : {{ $transaction->discount }} </span>
                                        </div>
                                        <div class="mb-2">
                                            <span>Other Charges ({{ $companyState->currency->symbol }}) :
                                                {{ $transaction->other_amt }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <hr>
                                            <h5 class="text-bold">Grand Total {{ $companyState->currency->symbol }} :
                                                {{ $transaction->grand_total }}</h5>
                                            <hr>
                                        </div>
                                        <div class="mb-3">
                                            <hr>
                                            <h5 class="text-bold">Paid Total {{ $companyState->currency->symbol }} :
                                                {{ $transaction->paid_amount }}</h5>
                                            <hr>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
