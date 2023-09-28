<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <style>
        /* Estilos generales de la factura */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        /* Estilos del encabezado */
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header-left {
            width: 40%;
        }
        .header-right {
            width: 40%;
            text-align: right;
        }
        .logo {
            max-width: 100px;
            height: auto;
        }
        /* Estilos de la tabla de items */
        .items-table {
            border: 1px solid #606060;
        }
        .items-table th, .items-table td {
            border-bottom: 1px solid #606060;
        }
        /* Estilos del resumen */
        .resumen {
            margin-top: 20px;
            width: 50%;
        }
        .resumen table {
            border-collapse: collapse;
            width: 100%;
        }
        .resumen th, .resumen td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Encabezado de la factura -->

        <table>
            <tr>
                <td style="width: 50%;">
                    <p><img src="{{asset('storage/'.$company->logo) }}" alt="" width="50"> <span>{{$company->name}}</span><p>
                    <p>{{$company->address}}</p>
                    <p class="mb-2">{{$company->country->name}}</p>
                    <p>{{$company->phone}}</p>
                </td>
                <td style="width: 50%;">
                    <p>Invoice #{{$cant_invoice}}</p>
                <p>Date Issues: {{$invoices->date}}</p>
                <p>Date Due: {{$invoices->due_date}}</p>
                </td>
            </tr>
        </table>

        <!-- Datos del emisor y receptor -->
        <table>
            <tr>
                <td style="width: 50%;">
                    <h3>Invoice To:</h3>
                    <p>{{$invoices->client->name}} {{$invoices->client->lastname}}</p>
                    <p>{{$invoices->client->name_company}}</p>
                    <p>{{$invoices->client->org_num}}</p>
                    <p>{{$invoices->client->phone}}</p>
                    <p>{{$invoices->client->email}}</p>
                </td>
                <td style="width: 50%;">
                    <h3>Bill To:</h3>
                    <p>Total Due: {{$invoices->total}}</p>
                    @foreach($company->payment_method as $payment)
                    <p>Bank name:{{$payment->name_bank}}</p>
                    <p>Country: {{$company->country->name}}</p>
                    <p>IBAN: {{$payment->iban}}</p>
                    <p>SWIFT code: {{$payment->swish}}</p>
                    @endforeach
                </td>
            </tr>
        </table>

        <!-- Tabla de items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Costo</th>
                    <th>QTY</th>
                    <th>price</th>
                </tr>
            </thead>
            <tbody>
            @foreach($invoices->item as $item)
                            @php
                              $price = $item->price * $item->qty;
                            @endphp  
                <tr>
                    <td>{{$item->description}}</td>
                    <td>{{$currency->simbol}}{{$item->price}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$currency->simbol}}{{$price}}</td>
                </tr>
            @endforeach    
                <!-- Agrega más filas de items según sea necesario -->
            </tbody>
        </table>

        <!-- Resumen de la factura -->
        <div class="resumen">
            <h3>Summary</h3>
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td>{{$currency->simbol}}{{$invoices->total}}</td>
                </tr>
                <tr>
                    <td>Disscount:</td>
                    <td>{{$currency->simbol}}00.00</td>
                </tr>
                <tr>
                    <td>TAX:</td>
                    <td>{{$currency->simbol}}00.00</td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>{{$currency->simbol}}{{$invoices->total}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>