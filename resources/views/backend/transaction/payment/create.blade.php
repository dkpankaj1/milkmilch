<x-app-layout>

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.transaction-payment.create', $transaction) }}
    @endpush


    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add New Payment</div>
                </div>
                <div class="card-body">

                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card-border">
                                    <div class="card-border-title">Payment Information</div>
                                    <div class="card-border-body">

                                        <div class="row">
                                            <div class="col-sm-6 col-12">

                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Date <span
                                                                    class="text-red">*</span></label>
                                                            <input type="date" name="date"
                                                                value="{{ old('date') }}" class="form-control">
                                                            @error('date')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Transaction Id <span
                                                                    class="text-red">*</span></label>
                                                            <input type="text" disabled=true
                                                                value="{{ $transaction->unique_id }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Customer Name <span
                                                                    class="text-red">*</span></label>
                                                            <input type="text" disabled=true
                                                                value="{{ $transaction->customer->user->name }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Total Amount <span
                                                                    class="text-red">*</span></label>
                                                            <input type="text" disabled=true
                                                                value="{{ $transaction->grand_total }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Paid Amount <span
                                                                    class="text-red">*</span></label>
                                                            <input type="number" step=".1" name="amount"
                                                                value="{{ old('amount') }}"
                                                                class="form-control"placeholder="Enter amount">
                                                            @error('amount')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Paymant method <span
                                                                    class="text-red">*</span></label>
                                                            <select class="form-select" name="method">
                                                                <option value="">-- select --</option>
                                                                <option value="cash">Cashe</option>
                                                                <option value="online">Online</option>
                                                            </select>
                                                            @error('method')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="cil-12">
                                                        <div class="mb-3">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="1" name="use_wallet">

                                                                <label class="form-check-label"
                                                                    for="inlineCheckbox1">Use Wallet
                                                                    ({{ $transaction->customer->wallet }}
                                                                    {{ $companyState->currency->symbol }} )</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12 col-12">
                                                        <hr>
                                                        <button class="btn btn-info">Save Payment</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
