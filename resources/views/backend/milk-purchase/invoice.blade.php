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
                                <strong>Invoice No:</strong> #{{ $invoice->id }}
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
                                {{ $invoice->supplier->user->name }} <br />
                                {{ $invoice->supplier->user->email }}, {{ $invoice->supplier->user->phone }} <br />
                                {{ $invoice->supplier->user->address }}, {{ $invoice->supplier->user->city }} <br />
                                {{ $invoice->supplier->user->state }}, {{ $invoice->supplier->user->postal_code }}
                                <br />
                                {{ $invoice->supplier->user->country }}<br />
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
                                Items</th>
                            <th bgcolor="#f8f9fa"
                                style="white-space: nowrap; padding: 12px; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Volume (ml)</th>

                            <th bgcolor="#f8f9fa"
                                style="white-space: nowrap; padding: 12px; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Rate ({{ $companyState->currency->code }})</th>
                            <th bgcolor="#f8f9fa" align="right"
                                style="white-space: nowrap; padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                Amount ({{ $companyState->currency->code }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->items as $key => $item)
                            <tr>
                                <td align="left"
                                    style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">
                                    {{ $key + 1 }}</td>
                                <td align="left"
                                    style="padding: 12px; text-align: left; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; font-size: 14px;">
                                   {{$item->milk->name}}</td>
                                <td align="center"
                                    style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">
                                    {{ $item->volume }}</td>
                                <td align="center"
                                    style="padding: 12px; text-align: center; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">
                                    {{$item->mop}}</td>
                                <td align="right"
                                    style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6;">
                                    {{ $item->total_amt }}</td>
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
                                <strong style="white-space: nowrap;">Discount ({{$invoice->discount_type == "percentage" ? "%" : $companyState->currency->code}}) :</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{$invoice->discount}}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3"
                                style="padding: 12px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Other Charges ({{$companyState->currency->code}}):</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{$invoice->other_amt}}</td>
                        </tr>
                        <tr>
                            <td bgcolor="#f8f9fa" colspan="3"
                                style="padding: 12px; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                <strong style="white-space: nowrap;">Total ({{$companyState->currency->code}}):</strong>
                            </td>
                            <td bgcolor="#f8f9fa" align="right"
                                style="padding: 12px; text-align: right; font-family: 'Poppins', sans-serif; background-color: #f8f9fa;-webkit-print-color-adjust: exact !important;color-adjust: exact !important;print-color-adjust: exact !important;">
                                {{$invoice->grand_total}}</td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
    <p style="padding:1rem 30px">
       <b>NOTE : </b>{{$invoice->note}}
    </p>
</body>

</html>
