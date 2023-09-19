<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
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
                <p><img src="{{$company->logo}}" alt="Company logo" width="70"> {{$company->name}}<p>
                <p>{{$company->address}}</p>
                <p>{{$company->country->name}}</p>
                <p>{{$company->phone}}</p>
            </td>
            <td style="width: 50%;">
                <p>Invoice #12345</p>
                <p>Date: {{$date_ini}}</p>
                <p>Due Date: {{$due_date}}</p>
            </td>
          </tr>
        </table>

        <!-- Datos del emisor y receptor -->
        <table>
            <tr>
                <td style="width: 50%;">
                    <h3>Invoice To:</h3>
                    @if($client->name)
                    <p>{{$client->name}} {{$client->lastname}}</p>
                    @else
                    <p>{{$client->name_company}}</p>
                    @endif
                    <p>{{$client->address}}</p>
                    <p>{{$client->phone}}</p>
                    <p>{{$client->email}}</p>
                </td>
                <td style="width: 50%;">
                    <h3>Bill To:</h3>
                    @foreach($company->payment_method as $payment)
                      <p>Bank name: {{$payment->name_bank}}</p>
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
                
                    <th>ITEM</th>
                    <th>COST</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                  
                </tr>
              
            </thead>
            <tbody>
                @foreach ($items as $item)
                  @php
                    $costo = $costos[$loop->index];
                    $qty = $qtys[$loop->index];
                    $price = $prices[$loop->index];
                @endphp 
                <tr>
                    <th>{{$item}}</th>
                    <th>{{$costo}}</th>
                    <th>{{$qty}}</th>
                    <th>{{$price}}</th>
                </tr>
                @endforeach
                <!-- Agrega más filas de items según sea necesario -->
            </tbody>
        </table>

        <!-- Resumen de la factura -->
        <div class="resumen">
            <h3>Resumen</h3>
            <table>
                <tr>
                    <td>Subtotal:{{$currency->simbol}} {{$subtotal}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Discount:</td>
                    <td>{{$currency->simbol}} 0</td>
                </tr>
                <tr>
                    <td>Tax:</td>
                    <td>{{$currency->simbol}} 0</td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>Subtotal:{{$currency->simbol}} {{$subtotal}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>