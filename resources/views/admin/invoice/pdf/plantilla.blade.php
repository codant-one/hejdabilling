<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura</title>
    <style>
        /* Estilos CSS aquí */
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
        }
        .logo {
            width: 100px; /* Ajusta el tamaño de tu logotipo */
        }
        .invoice-details {
            text-align: right;
        }
        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-items th,
        .invoice-items td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .invoice-items th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <div class="logo">
                <img src="{{auth()->user()->avatar}}" alt="" width="50">
            </div>
            <div class="invoice-details">
                <p>Número de Factura: 12345</p>
                <p>Fecha de Emisión: 2023-09-11</p>
                <p>Fecha de Vencimiento: 2023-10-11</p>
            </div>
        </div>
        <div class="customer-info">
            <h2>Información del Cliente:</h2>
            <p>Nombre: Cliente Ejemplo</p>
            <p>Dirección: Dirección del Cliente</p>
            <p>Correo Electrónico: cliente@example.com</p>
        </div>
        <div class="bank-info">
            <h2>Información Bancaria:</h2>
            <p>Nombre del Banco: Banco Ejemplo</p>
            <p>Número de Cuenta: 1234567890</p>
            <p>IBAN: ES12345678901234567890</p>
        </div>
        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th><img src="{{url('https://acmgen.org/wp-content/uploads/2022/06/logo_acmgen_2023.png')}}" alt="logo" width="50"></th>{{public_path().'/storage/images/pdf/your_image.jpeg'}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Producto 1</td>
                    <td>10.00</td>
                    <td>2</td>
                    <td>20.00</td>
                </tr>
                <tr>
                    <td>Producto 2</td>
                    <td>15.00</td>
                    <td>3</td>
                    <td>45.00</td>
                </tr>
            </tbody>
        </table>
        <div class="total">
            <p>Total a Pagar: $65.00</p>
        </div>
    </div>
</body>
</html>