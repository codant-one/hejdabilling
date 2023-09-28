@extends('admin.layouts.master')

@section('content')


 <!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                  <div class="card invoice-preview-card">
                    <div class="card-body">
                      <div
                        class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0"
                      >
                        <div class="mb-xl-0 mb-4">
                          <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                            @if($company->logo)
                                <img src="{{asset('storage/'.$company->logo) }}" alt="Company logo" width="70">
                            @else
                                <img src="{{ asset('assets/img/illustrations/icon-login-hejdabilling.png') }}" alt="logo" width="50">
                            @endif

                            <span class="app-brand-text fw-bold fs-4"> {{$company->name}} </span>
                          </div>
                          <p class="mb-2">{{$company->address}}</p>
                          <p class="mb-2">{{$company->country->name}}</p>
                          <p class="mb-0">{{$company->phone}}</p>
                        </div>
                        <div>
                          <h4 class="fw-semibold mb-2">INVOICE {{$invoices->num_invoice}}</h4>
                          <div class="mb-2 pt-1">
                            <span>Date Issues:</span>
                            <span class="fw-semibold">{{$invoices->date}}</span>
                          </div>
                          <div class="pt-1">
                            <span>Date Due:</span>
                            <span class="fw-semibold">{{$invoices->due_date}}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <div class="row p-sm-3 p-0">
                        <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                          <h6 class="mb-3">Invoice To:</h6>
                          <p class="mb-1">{{$invoices->client->name}} {{$invoices->client->lastname}}</p>
                          <p class="mb-1">{{$invoices->client->name_company}}</p>
                          <p class="mb-1">{{$invoices->client->address}}</p>
                          <p class="mb-1">{{$invoices->client->phone}}</p>
                          <p class="mb-0">{{$invoices->client->email}}</p>
                        </div>
                        <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                          <h6 class="mb-4">Bill To:</h6>
                          <table>
                            
                                <tbody>
                                <tr>
                                    <td class="pe-4">Total Due:</td>
                                    <td><strong>{{$currency->simbol}}{{$invoices->total}}</strong></td>
                                </tr>
                                @foreach($company->payment_method as $payment)
                                <tr>
                                    <td class="pe-4">Bank name:</td>
                                    <td>{{$payment->name_bank}}</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">Country:</td>
                                    <td>{{$company->country->name}}</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">IBAN:</td>
                                    <td>{{$payment->iban}}</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">SWIFT code:</td>
                                    <td>{{$payment->swish}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive border-top">
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Item</th>
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
                                <td></td>
                                <td class="text-nowrap">{{$item->description}}</td>
                                <td>{{$currency->simbol}}{{$item->price}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$currency->simbol}}{{$price}}</td>
                            </tr>
                          @endforeach
                          <tr>
                            <td colspan="3" class="align-top px-4 py-4">
                              
                            </td>
                            <td class="text-end pe-3 py-4">
                              <p class="mb-2 pt-3">Subtotal:</p>
                              <p class="mb-2">Discount:</p>
                              <p class="mb-2">Tax:</p>
                              <p class="mb-0 pb-3">Total:</p>
                            </td>
                            <td class="ps-2 py-4">
                              <p class="fw-semibold mb-2 pt-3">{{$currency->simbol}}{{$invoices->total}}</p>
                              <p class="fw-semibold mb-2">{{$currency->simbol}}00.00</p>
                              <p class="fw-semibold mb-2">{{$currency->simbol}}00.00</p>
                              <p class="fw-semibold mb-0 pb-3">{{$currency->simbol}}{{$invoices->total}}</p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="card-body mx-3">
                      <div class="row">
                        <div class="col-12">
                          <span class="fw-semibold">Note:</span>
                          <span
                            >Overdue invoices will incur a surcharge for payment delays.</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Invoice -->

                <!-- Invoice Actions -->
                <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                  <div class="card">
                    <div class="card-body">
                      <button 
                        class="btn btn-primary d-grid w-100 mb-2" onclick="window.location.href='{{route('invoice.send', $invoices->id)}}';"
                      >
                        <span class="d-flex align-items-center justify-content-center text-nowrap"
                          ><i class="ti ti-send ti-xs me-1"></i>Send Invoice</span
                        >
                      </button>
                      
                      <button
                        class="btn btn-primary d-grid w-100" onclick="window.location.href='{{route('invoice.show.client', $invoices->id)}}';"
                      >
                        <span class="d-flex align-items-center justify-content-center text-nowrap"
                          >Download</span
                        >
                      </button>
                                  <br>
                      <button
                        class="btn btn-primary d-grid w-100" onclick="window.location.href='{{route('invoice.history.client', $invoices->client->id)}}';"
                      >
                        <span class="d-flex align-items-center justify-content-center text-nowrap"
                          >Invoice Client</span
                        >
                      </button>
                    </div>
                  </div>
                </div>
                <!-- /Invoice Actions -->
              </div>

              <!-- Offcanvas -->
              <!-- Send Invoice Sidebar -->
              <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
                <div class="offcanvas-header my-1">
                  <h5 class="offcanvas-title">Send Invoice</h5>
                  <button
                    type="button"
                    class="btn-close text-reset"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="offcanvas-body pt-0 flex-grow-1">
                  <form>
                    <div class="mb-3">
                      <label for="invoice-from" class="form-label">From</label>
                      <input
                        type="text"
                        class="form-control"
                        id="invoice-from"
                        value="shelbyComapny@email.com"
                        placeholder="company@email.com"
                      />
                    </div>
                    <div class="mb-3">
                      <label for="invoice-to" class="form-label">To</label>
                      <input
                        type="text"
                        class="form-control"
                        id="invoice-to"
                        value="qConsolidated@email.com"
                        placeholder="company@email.com"
                      />
                    </div>
                    <div class="mb-3">
                      <label for="invoice-subject" class="form-label">Subject</label>
                      <input
                        type="text"
                        class="form-control"
                        id="invoice-subject"
                        value="Invoice of purchased Admin Templates"
                        placeholder="Invoice regarding goods"
                      />
                    </div>
                    <div class="mb-3">
                      <label for="invoice-message" class="form-label">Message</label>
                      <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">
                        Dear Queen Consolidated,
                        Thank you for your business, always a pleasure to work with you!
                        We have generated a new invoice in the amount of $95.59
                        We would appreciate payment of this invoice by 05/11/2021</textarea>
                    </div>
                    <div class="mb-4">
                      <span class="badge bg-label-primary">
                        <i class="ti ti-link ti-xs"></i>
                        <span class="align-middle">Invoice Attached</span>
                      </span>
                    </div>
                    <div class="mb-3 d-flex flex-wrap">
                      <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                      <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /Send Invoice Sidebar -->

              <!-- Add Payment Sidebar -->
              <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
                <div class="offcanvas-header mb-3">
                  <h5 class="offcanvas-title">Add Payment</h5>
                  <button
                    type="button"
                    class="btn-close text-reset"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="offcanvas-body flex-grow-1">
                  <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
                    <p class="mb-0">Invoice Balance:</p>
                    <p class="fw-bold mb-0">$5000.00</p>
                  </div>
                  <form>
                    <div class="mb-3">
                      <label class="form-label" for="invoiceAmount">Payment Amount</label>
                      <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input
                          type="text"
                          id="invoiceAmount"
                          name="invoiceAmount"
                          class="form-control invoice-amount"
                          placeholder="100"
                        />
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="payment-date">Payment Date</label>
                      <input id="payment-date" class="form-control invoice-date" type="text" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="payment-method">Payment Method</label>
                      <select class="form-select" id="payment-method">
                        <option value="" selected disabled>Select payment method</option>
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Paypal">Paypal</option>
                      </select>
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="payment-note">Internal Payment Note</label>
                      <textarea class="form-control" id="payment-note" rows="2"></textarea>
                    </div>
                    <div class="mb-3 d-flex flex-wrap">
                      <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                      <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /Add Payment Sidebar -->

              <!-- /Offcanvas -->
            </div>
            <!-- / Content -->


@endsection