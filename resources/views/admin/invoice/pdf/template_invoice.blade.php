<!DOCTYPE html>
<html lang="es">
 <style>
    .table-main{
        width:100%;
	    height:100%;
    }
    body
    {
        background-color:#FFFFFF;
        padding: 20px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    .title-header
    {
        color: #2E0684;
        font-size: 32px;
        border-bottom: solid 1px #4d4d4d;
        border-top: solid 1px #4d4d4d;
    }
    .subtitle{
        font-size: 16px;
        font-weight: bold;
    }
    .text-1{
        font-size: 16px;
        font-weight: 400;
    }
    .data-from
    {
        padding: 15px;
    }
    .data-from table
    {
        padding: 10px;
        border: solid 1px #4d4d4d;
        border-radius: 20px;
        font-size: 12px;
    }
    .faktur-title{
        padding: 5px 10px;
        background-color: #2E0684;
        color: #FFFFFF;
        font-weight: bold;
        border-radius: 20px;
    }
    .table-items
    {
        padding: 10px;
        border: solid 1px #4d4d4d;
        border-radius: 20px;
        font-size: 12px;
    }
    .header-items
    {
        background-color: #2E0684;
        color: #FFFFFF;
        font-weight: bold;
        padding: 10px;
        border-radius: 20px;
        

    }
    .totales
    {
        height: 200px;
    }

    .total
    {
        font-size: 12px;
        font-weight: bold;
    }

 </style>   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Template</title>
</head>
<body>
    
    <table class="table-main" width="100%" cellspacing="0" cellpadding="0">
        <tbody> 
            <!------------------------TABLE HEADER--------------------->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="50%"><img src="{{asset('storage/'.$company->logo) }}" width="auto" height="70" alt="logo-main"></td>
                            @if($invoices->mode_payment)
                            <td width="50%" style="text-align: right;"><span class="title-header">{{$invoices->mode_payment}}</span></td>
                            @else
                            <td width="50%" style="text-align: right;"><span class="title-header">FAKTURA</span></td>
                            @endif
                        </tr>
                        
                    </table>
                    
                </td>
            </tr>
            <!------------------------TABLE DATA FROM--------------------->
            <tr>
                <td>
                    <table width="100%" style="margin-top:10px">
                        <tr>
                            <td width="65%" class="data-from">
                                <table width="100%">
                                    <tr>
                                        <td width="33%" style="font-weight: bold;">Fakturanr</td>
                                        <td width="33%">{{$cant_invoice}}</td>
                                        <td width="33%" style="font-weight: bold;">Vår referens</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">Kundnr</td>
                                        <td>{{$invoices->client_id}}</td>
                                        <td>{{auth()->user()->name}} {{auth()->user()->lastname}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">Fakturadatum</td>
                                        <td>{{$invoices->date}} </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">Betalningsvillkor</td>
                                        <td>15 dagar netto</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">Förfallodatum</td>
                                        <td style="font-weight: bold;">{{$invoices->due_date}}</td>
                                        
                                    </tr>  
                                </table>
                            </td>
                            <td width="35%" class="data-from">

                                <table width="100%">

                                    <tr>
                                        <td class="faktur-title">
                                            Faktureringsadress
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">
                                            {{$invoices->client->name}} {{$invoices->client->lastname}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$invoices->client->name_company}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$invoices->client->org_num}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$invoices->client->phone}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$invoices->client->email}}
                                        </td>
                                    </tr>

                                </table>
                            
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!------------------------TABLE ITEMS--------------------->    
            <tr>
                <td style="padding: 15px;">
                    <table width="100%" class="table-items">
                        <tr class="header-items">
                            <th width="55%" style="font-weight: bold; padding: 5px;">Produkt / tjänst</th>
                            <th width="15%">Antal</th>
                            <th width="15%" style="font-weight: bold;">À-pris</th>
                            <th width="15%">Belopp</th>
                        </tr>
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
                        <tr><td class="totales"></td></tr>
                        <tr>
                            
                                    <td></td>
                                    <td></td>
                                    <td>Netto:</td>
                                    <td>{{$currency->simbol}}{{$invoices->total}}</td>
                        </tr>
                        <tr>
                            
                            <td></td>
                            <td></td>
                            <td>Öresutjämning:</td>
                            <td>{{$currency->simbol}} 0,00</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td><span class="total">Summa att betala:</span></td>
                            <td><span class="total">{{$currency->simbol}}{{$invoices->total}}</span></td>
                        </tr>
                    </table>     
                </td>
            </tr>
            <!------------------------- BILL TO---------------------------------->

            <tr>
                <td style="padding: 15px;">
                    <table width="100%" class="table-items">

                        <tr>
                            <td width="30%" style="font-weight: bold;">Adress</td>
                            <td width="30%" style="font-weight: bold;">Företagets säte</td>
                            <td width="20%" style="font-weight: bold;">Org.nr</td>
                            <td width="20%" style="font-weight: bold;">Webbplats</td>
                        </tr>
                        
                        <tr>
                            <td>{{$company->name}}</td>
                            <td>{{$company->country->name}}</td>
                            <td>{{$company->org_number}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>{{$company->address}}</td>
                            <td></td>
                            <td style="font-weight: bold;">Momsreg.nr</td>
                            <td style="font-weight: bold;">Företagets e-post</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>SE559374026801</td>
                            <td>{{$company->email}}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">BIC/Swift</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>NDEASESS</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            
                            <td style="font-weight: bold;">Bank</td>
                            <td style="font-weight: bold;">Kontonummer</td>
                            <td style="font-weight: bold;">IBAN</td>
                            <td></td>
                        </tr>
                        <tr>
                            @foreach($company->payment_method as $payment)
                            
                            <td>{{$payment->name_bank}}</td>
                            <td>{{$payment->account_number}}</td>
                            <td>{{$payment->iban}}</td>
                            <td></td>
                            @endforeach
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Godkänd för F-skat</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    
    
</body>
</html>