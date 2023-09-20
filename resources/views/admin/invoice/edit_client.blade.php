@extends('admin.layouts.master')

@section('content')

 <!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit Client</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item">
                      <a class="nav-link active" href="{{route('invoice.client')}}"
                        ><i class="ti-xs ti ti-users me-1"></i> Return</a
                      >
                    </li>
                    
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Client Details</h5>

                    <hr class="my-0" />
                    <div class="card-body">
                     <form action="{{route('invoice.client.update',$client->id)}}" method="POST">
                        <div class="row">
                         @if($client->name)
                          <div class="mb-3 col-md-6">
                           
                            <label for="firstName" class="form-label">Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="name"
                              value="{{$client->name}}"
                              placeholder="Name"
                              autofocus
                              required
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="lastname" id="lastName" value="{{$client->lastname}}" placeholder="Lastname" required/>
                          </div>
                          @else
                          <div class="mb-3 col-md-6">
                            <label for="name_company" class="form-label">Company Name</label>
                                <input
                                class="form-control"
                                type="text"
                                id="name_company"
                                name="name_company"
                                value="{{$client->name_company}}"
                                placeholder="Name"
                                autofocus
                                required
                                />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="org_num" class="form-label">Org Num</label>
                            <input class="form-control" type="text" name="org_num" id="org_num" value="{{$client->org_num}}" placeholder="Lastname" required/>
                          </div>
                          @endif
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              placeholder="{{$client->email}}"
                              readonly
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Address</label>
                            <input
                              class="form-control"
                              type="text"
                              id="address"
                              name="address"
                              value="{{$client->address}}"
                              placeholder="Address"
                            />
                          </div> 

                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Phone number</label>
                            <input
                              class="form-control"
                              type="text"
                              id="phone"
                              name="phone"
                              value="{{$client->phone}}"
                              placeholder="Phone number"
                            />
                          </div>
                          
                          <!-- Fin datos Client-->
                      <!------------FIN DATOS DE PAGO---------------------->
                        </div>
                        
                        
                        <div class="mt-2">
                           @csrf
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-label-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- / Content -->

@endsection