@extends('admin.layouts.master')

@section('content')

  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row g-4 mb-4">
                <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Due Total</span>
                          <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{$due_total}}</h4>
                          </div>
                          
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                          <i class="ti ti-user ti-sm"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Total Invoices</span>
                          <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{$total_invoices}}</h4>
                            
                          </div>
                          
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                          <i class="ti ti-user-plus ti-sm"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                </div>
                <div class="col-sm-6 col-xl-3" style="margin:auto;text-align:right;">
                  <button class="btn btn-secondary add-new btn-primary" onclick="window.location.href='{{route('invoice.client')}}';"><span><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i><span class="d-none d-sm-inline-block">List Clients</span></span></button>
                </div>
                
              </div>
              <!-- Users List Table -->
              <div class="card">
                <div class="card-header border-bottom">
                  
                  <div class="row">
                        <div class="col-md-4">
                            @if($client->name)
                            <h5 class="card-title mb-3">{{$client->name}} {{$client->lastname}}</h5>
                            @else
                            <h5 class="card-title mb-3">{{$client->name_company}}</h5>
                            @endif
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="text-align:end;">
                            <button class="btn btn-secondary add-new btn-primary" onclick="window.location.href='{{route('invoice.create', $client->id)}}';"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New Invoice</span></span></button>
                        </div>
                  </div>
                </div>
                <div class="card-datatable table-responsive">
                  <table class="table border-top">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Invoice #</th>
                        <th>Date</th>
                        <th>Due Date</th>
                        <th>Total Due</th>
                        <th>Actions</th>
                      </tr>
                      <tbody class="table">
                            @foreach($invoices as $invoice)
                                <tr> 
                                    <td></td>                    
                                    <td>{{ $invoice->num_invoice }}</td>
                                    <td>{{ $invoice->date }}</td>
                                    <td>{{ $invoice->due_date }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>
                                        <p>
                                            <a href="{{route('invoice.preview',$invoice->id)}}"><i class="fa-regular fa-eye" style="color: #2e0684;"></i></a>
                                            <a href="#"><i class="fa-regular fa-pen-to-square fa-lg" style="color: #2e0684;"></i></a>
                                        </p>

                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </thead>
                  </table>
                </div>
                
                
              </div>
            </div>
            <!-- / Content -->


 
@endsection