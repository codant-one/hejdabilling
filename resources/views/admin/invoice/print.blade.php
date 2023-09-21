<!DOCTYPE html>
<html lang="es"
class="light-style layout-navbar-fixed layout-menu-fixed layout-menu-collapsed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('/assets\/')}}"
  data-template="vertical-menu-template"
>

@include('admin.layouts.partials.header')

<link rel="stylesheet" href="{{ asset('/assets/vendor/css/pages/app-invoice-print.css') }}" />
<body>
    

<!-- Content -->

<div class="invoice-print p-5">
      <div class="d-flex justify-content-between flex-row">
        <div class="mb-4">
          <div class="d-flex svg-illustration mb-3 gap-2">
            @if($company->logo)
                <img src="{{$company->logo}}" alt="Company logo" width="70">
            @else
                <img src="{{ asset('assets/img/illustrations/icon-login-hejdabilling.png') }}" alt="logo" width="50">
            @endif

            <span class="app-brand-text fw-bold"> {{$company->name}} </span>
          </div>
          <p class="mb-1">{{$company->address}}</p>
          <p class="mb-1">{{$company->country->name}}</p>
          <p class="mb-0">{{$company->phone}}</p>
        </div>
        <div>
          <h4 class="fw-bold">INVOICE #{{$invoices->num_invoice}}</h4>
          <div class="mb-2">
            <span class="text-muted">Date Issues:</span>
            <span class="fw-bold">{{$invoices->date}}</span>
          </div>
          <div>
            <span class="text-muted">Date Due:</span>
            <span class="fw-bold">{{$invoices->due_date}}</span>
          </div>
        </div>
      </div>

      <hr />

      <div class="row d-flex justify-content-between mb-4">
        <div class="col-sm-6 w-50">
          <h6>Invoice To:</h6>
          <p class="mb-1">{{$invoices->client->name}} {{$invoices->client->lastname}}</p>
          <p class="mb-1">{{$invoices->client->name_company}}</p>
          <p class="mb-1">{{$invoices->client->address}}</p>
          <p class="mb-1">{{$invoices->client->phone}}</p>
          <p class="mb-0">{{$invoices->client->email}}</p>
        </div>
        <div class="col-sm-6 w-50">
          <h6>Bill To:</h6>
          <table>
            <tbody>
              <tr>
                <td class="pe-3">Total Due:</td>
                <td><strong>{{$currency->simbol}}{{$invoices->total}}</strong></td>
              </tr>
              @foreach($company->payment_method as $payment)
              <tr>
                <td class="pe-3">Bank name:</td>
                <td>{{$payment->name_bank}}</td>
              </tr>
              <tr>
                <td class="pe-3">Country:</td>
                <td>{{$company->country->name}}</td>
              </tr>
              <tr>
                <td class="pe-3">IBAN:</td>
                <td>{{$payment->iban}}</td>
              </tr>
              <tr>
                <td class="pe-3">SWIFT code:</td>
                <td>{{$payment->swish}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table m-0">
          <thead class="table-light">
            <tr>
                <th>Item</th>
                <th></th>
                <th>Cost</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
          </thead>
          <tbody>
           @foreach($invoices->item as $item)
                @php
                    $price = $item->price * $item->qty;
                @endphp 
            <tr>
              <td>{{$item->description}}</td>
              <td></td>
              <td>{{$item->price}}</td>
              <td>{{$item->qty}}</td>
              <td>{{$price}}</td>
            </tr>
           @endforeach
            <tr>
              <td colspan="3" class="align-top px-4 py-3">
                
              </td>
              <td class="text-end px-4 py-3">
                <p class="mb-2">Subtotal:</p>
                <p class="mb-2">Discount:</p>
                <p class="mb-2">Tax:</p>
                <p class="mb-0">Total:</p>
              </td>
              <td class="px-4 py-3">
                <p class="fw-bold mb-2">{{$currency->simbol}}{{$invoices->total}}</p>
                <p class="fw-bold mb-2">{{$currency->simbol}}00.00</p>
                <p class="fw-bold mb-2">{{$currency->simbol}}00.00</p>
                <p class="fw-bold mb-0">{{$currency->simbol}}{{$invoices->total}}</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="row">
        <div class="col-12">
          <span class="fw-bold">Note:</span>
          <span
            >Overdue invoices will incur a surcharge for payment delays.</span
          >
        </div>
      </div>
    </div>

    <!-- / Content -->
    @include('layouts.partials.scripts')
    <script src="{{ asset('/assets/js/app-invoice-print.js') }}"></script>
    @yield('scripts')
</body>

</html>