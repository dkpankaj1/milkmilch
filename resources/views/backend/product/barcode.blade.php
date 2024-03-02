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

        div{
            height: 300px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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


    <div class="container">
        
        <img src="data:image/png;base64,{{ Milon\Barcode\Facades\DNS1DFacade::getBarcodePNG($text, 'C128', 2, 50) }}" alt="barcode"   />
        <p>{{$text}}</p>
    </div>


</body>

</html>
