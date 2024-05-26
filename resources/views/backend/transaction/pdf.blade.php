<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoive</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Courier New', sans-serif !important;
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
            print-color-adjust: exact !important;
            font-size: 10px;
        }

        body {
            color: #404040;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
        }

        @media print {
            @page {
                size: auto;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body style="color: #404040; margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tr>
            <td style="padding-top: 20px; padding-left: 30px; padding-right: 30px;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tr>
                        <td style="padding-top: 12px; padding-bottom: 12px;">
                            <img src="{{ $companyState->logo }}" alt="logo" height="35" draggable="false" />
                        </td>
                        <td style="padding-top: 12px; padding-bottom: 12px;">
                            <h1 align="right"
                                style="text-align: right;  margin: 0;">
                                Invoice
                            </h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 30px; padding-right: 30px;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tr>
                        <td
                            style="padding-top: 12px; padding-bottom: 12px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                            <p style="">
                                <strong>Date:</strong> {{ now() }}
                            </p>
                        </td>
                        <td
                            style="padding-top: 12px; padding-bottom: 12px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                            <p align="right" style="text-align: right; ">
                                <strong>Invoice No:</strong> #{{ $transaction->id }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 30px; padding-right: 30px;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tr>
                        <td style="padding-top: 20px; padding-bottom: 20px;">
                            <p style=" line-height: 1.2;">
                                <strong style="display: block; margin-bottom: 5px;">{{ $companyState->name }}</strong>
                                {{ $companyState->email }}, {{ $companyState->phone }} <br />
                                {{ $companyState->address }}, {{ $companyState->city }} <br />
                                {{ $companyState->state }}, {{ $companyState->postal_code }}<br />
                                {{ $companyState->country }}<br />
                            </p>
                            <br>
                            <p><b>UPI ID : {{ $companyState->upi }} </b></p>
                            <br>
                            <p><b>Customer care : {{ $companyState->phone }} </b></p>
                            <p><b>Whatsapp : {{ $companyState->phone }} </b></p>
                        </td>

                        <td style="padding-top: 20px; padding-bottom: 20px;">
                            <p><b>Scan QR To Pay</b></p>
                            <img style="margin: .5rem 0rem;border:solid 0.5px" src="{{ $companyState->upi_barcode }}"
                                alt="">
                        </td>
                        <td style="padding-top: 20px; padding-bottom: 20px;">
                            <p align="right"
                                style="text-align: right;  line-height: 1.2;">
                                <strong style="display: block; margin-bottom: 5px;">Bill To:</strong>
                                {{ $transaction->customer->user->name }} <br />
                                {{ $transaction->customer->user->email }}, {{ $transaction->customer->user->phone }}
                                <br />
                                {{ $transaction->customer->user->address }}, {{ $transaction->customer->user->city }}
                                <br />
                                {{ $transaction->customer->user->state }},
                                {{ $transaction->customer->user->postal_code }}
                                <br />
                                {{ $transaction->customer->user->country }}<br />
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 30px; padding-right: 30px;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border: 1px solid #dee2e6;">
                    <thead>
                        <tr>
                            <th bgcolor="#f8f9fa" align="left"
                                style="white-space: nowrap; padding: 4px; text-align: left;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                SR.</th>

                            <th bgcolor="#f8f9fa" align="left"
                                style="white-space: nowrap; padding: 4px; text-align: left;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Date</th>

                            <th bgcolor="#f8f9fa"
                                style="white-space: nowrap; padding: 4px;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Discount</th>

                            <th bgcolor="#f8f9fa"
                                style="white-space: nowrap; padding: 4px;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Order Status</th>

                            <th bgcolor="#f8f9fa"
                                style="white-space: nowrap; padding: 4px;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Payment Status</th>

                            <th bgcolor="#f8f9fa" align="right"
                                style="white-space: nowrap; padding: 4px; text-align: right;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Amount ({{ $companyState->currency->code }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->sells as $key => $item)
                            <tr>
                                <td align="left"
                                    style="padding: 4px; text-align: left;  border-bottom: 1px solid #dee2e6;">
                                    {{ $key + 1 }}</td>

                                <td align="left"
                                    style="padding: 4px; text-align: left;  border-bottom: 1px solid #dee2e6;">
                                    {{ $item->date }}</td>


                                <td align="center"
                                    style="padding: 4px; text-align: center;  border-bottom: 1px solid #dee2e6;">
                                    {{ $item->discount }}
                                    {{ $item->discount == 'percentage' ? '%' : $companyState->currency->code }}</td>

                                <td align="center"
                                    style="padding: 4px; text-align: center;  border-bottom: 1px solid #dee2e6;">
                                    {{ $item->order_status }}</td>

                                <td align="center"
                                    style="padding: 4px; text-align: center;  border-bottom: 1px solid #dee2e6;">
                                    {{ $item->payment_status }}</td>


                                <td align="right"
                                    style="padding: 4px; text-align: right;  border-bottom: 1px solid #dee2e6;">
                                    {{ $item->grand_total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="4"
                                style="padding: 4px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 4px; text-align: right;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Discount
                                    ({{ $transaction->discount_type == 'percentage' ? '%' : $companyState->currency->code }})
                                    :</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 4px; text-align: right;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{ $transaction->discount }}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="4"
                                style="padding: 4px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 4px; text-align: right;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Other Charges
                                    ({{ $companyState->currency->code }}):</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 4px; text-align: right;  border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{ $transaction->other_amt }}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="4"
                                style="padding: 4px; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 4px; text-align: right;  background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Total
                                    ({{ $companyState->currency->code }}):</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 4px; text-align: right;  background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{ $transaction->grand_total }}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="4"
                                style="padding: 4px; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 4px; text-align: right;  background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Total Paid
                                    ({{ $companyState->currency->code }}):</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 4px; text-align: right;  background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{ $transaction->paid_amount ?? 0 }}</td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
