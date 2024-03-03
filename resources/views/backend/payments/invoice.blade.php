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
                                style="text-align: right; font-family: 'Poppins', sans-serif; margin: 0;">
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
                            <p style="font-family: 'Poppins', sans-serif;">
                                <strong>Date:</strong> {{ now() }}
                            </p>
                        </td>
                        <td
                            style="padding-top: 12px; padding-bottom: 12px; border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                            <p align="right" style="text-align: right; font-family: 'Poppins', sans-serif;">
                                <strong>Invoice No:</strong> #{{ $payment->id }}
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
                            <p style="font-family: 'Poppins', sans-serif; line-height: 1.2;">
                                <strong style="display: block; margin-bottom: 5px;">Invoiced To:</strong>
                                {{ $companyState->name }} <br />
                                {{ $companyState->email }}, {{ $companyState->phone }} <br />
                                {{ $companyState->address }}, {{ $companyState->city }} <br />
                                {{ $companyState->state }}, {{ $companyState->postal_code }}<br />
                                {{ $companyState->country }}<br />
                            </p>
                        </td>
                        <td style="padding-top: 20px; padding-bottom: 20px;">
                            <p align="right"
                                style="text-align: right; font-family: 'Poppins', sans-serif; line-height: 1.2;">
                                <strong style="display: block; margin-bottom: 5px;">Pay To:</strong>
                                {{ $payment->customer->user->name }} <br />
                                {{ $payment->customer->user->email }}, {{ $payment->customer->user->phone }} <br />
                                {{ $payment->customer->user->address }}, {{ $payment->customer->user->city }} <br />
                                {{ $payment->customer->user->state }}, {{ $payment->customer->user->postal_code }}
                                <br />
                                {{ $payment->customer->user->country }}<br />
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
                                style="white-space: nowrap; padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                SR.</th>

                            <th bgcolor="#f8f9fa" align="left"
                                style="white-space: nowrap; padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Date</th>

                            <th bgcolor="#f8f9fa"
                                style="white-space: nowrap; padding: 12px; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Discount</th>

                            <th bgcolor="#f8f9fa"
                                style="white-space: nowrap; padding: 12px; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Order Status</th>

                            <th bgcolor="#f8f9fa" align="right"
                                style="white-space: nowrap; padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Amount ({{ $companyState->currency->code }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payment->sales as $key => $item)
                            <tr>
                                <td align="left"
                                    style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">
                                    {{ $key + 1 }}</td>

                                <td align="left"
                                    style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">
                                    {{ $item->date }}</td>


                                <td align="center"
                                    style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">
                                    {{$item->discount}} {{ $item->discount == 'percentage' ? '%' : $companyState->currency->code  }}</td>

                                <td align="center"
                                    style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">
                                    {{ $item->order_status }}</td>

                                <td align="right"
                                    style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">
                                    {{ $item->grand_total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3"
                                style="padding: 12px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Discount
                                    ({{ $payment->discount_type == 'percentage' ? '%' : $companyState->currency->code }})
                                    :</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{ $payment->discount }}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3"
                                style="padding: 12px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Other Charges
                                    ({{ $companyState->currency->code }}):</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{ $payment->other_amt }}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3"
                                style="padding: 12px; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Total
                                    ({{ $companyState->currency->code }}):</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{ $payment->grand_total }}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3"
                                style="padding: 12px; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Total Paid
                                    ({{ $companyState->currency->code }}):</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{ $payment->paid_amount ?? 0 }} [ {{ $payment->payment_status }} ]</td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
