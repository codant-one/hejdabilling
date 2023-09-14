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
                          <span>Session</span>
                          <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">21,459</h4>
                            <span class="text-success">(+29%)</span>
                          </div>
                          <span>Total Users</span>
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
                          <span>Paid Users</span>
                          <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">4,567</h4>
                            <span class="text-success">(+18%)</span>
                          </div>
                          <span>Last week analytics </span>
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                          <i class="ti ti-user-plus ti-sm"></i>
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
                          <span>Active Users</span>
                          <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">19,860</h4>
                            <span class="text-danger">(-14%)</span>
                          </div>
                          <span>Last week analytics</span>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                          <i class="ti ti-user-check ti-sm"></i>
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
                          <span>Pending Users</span>
                          <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">237</h4>
                            <span class="text-success">(+42%)</span>
                          </div>
                          <span>Last week analytics</span>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                          <i class="ti ti-user-exclamation ti-sm"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Users List Table -->
              <div class="card">
                <div class="card-header border-bottom">
                  
                  <div class="row">
                        <div class="col-md-4"><h5 class="card-title mb-3">Search Filter</h5></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="text-align:end;">
                            <button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New Client</span></span></button>
                        </div>
                  </div>
                </div>
                <div class="card-datatable table-responsive">
                  <table class="table border-top">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Org Num</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                      </tr>
                      <tbody class="table">
                            @foreach($clients as $client)
                                <tr> 
                                    <td></td>  
                                    @if($client->org_num)                   
                                    <td>{{ $client->name_company }}</td>
                                    @else
                                    <td>{{$client->name}} {{$client->lastname}}</td>
                                    @endif
                                    <td>{{$client->org_num}}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>
                                        <a href="{{ route('invoice.create', $client->id) }}"><i class="menu-icon tf-icons ti ti-file-dollar"></i></a>
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </thead>
                  </table>
                </div>
                <!-- Offcanvas to add new user -->
                <div
                  class="offcanvas offcanvas-end"
                  tabindex="-1"
                  id="offcanvasAddUser"
                  aria-labelledby="offcanvasAddUserLabel"
                >
                  <div class="offcanvas-header">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Client</h5>
                    <button
                      type="button"
                      class="btn-close text-reset"
                      data-bs-dismiss="offcanvas"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                    <form action ="{{route('invoice.add.client')}}" method="POST" class="pt-0" >
                      <!-- selector tipo de usuario-->

                      <div class="row">
                        <div class="col-md mb-md-0 mb-2">
                          <div class="form-check custom-option custom-option-basic">
                            <label class="form-check-label custom-option-content" for="customRadioTemp1">
                              <input
                                name="customRadioTemp"
                                class="form-check-input"
                                type="radio"
                                value="1"
                                id="optionone"
                                checked
                              />
                              <span class="custom-option-header">
                                <span class="h6 mb-0">Independent</span>
                                
                              </span>
                              <span class="custom-option-body">
                                <small>independent worker.</small>
                              </span>
                            </label>
                          </div>
                        </div>
                        <div class="col-md">
                          <div class="form-check custom-option custom-option-basic">
                            <label class="form-check-label custom-option-content" for="customRadioTemp2">
                              <input
                                name="customRadioTemp"
                                class="form-check-input"
                                type="radio"
                                value="2"
                                id="optiontwo"
                              />
                              <span class="custom-option-header">
                                <span class="h6 mb-0">Company</span>
                                
                              </span>
                              <span class="custom-option-body">
                                <small>company, legal entity.</small>
                              </span>
                            </label>
                          </div>
                        </div>
                      </div>

                      <!--fin selector-->
                      <div class="mb-3 independent">
                        <label class="form-label " for="add-user-fullname">Name</label>
                        <input
                          type="text"
                          class="form-control input-ind"
                          id="add-user-fullname"
                          placeholder="Name"
                          name="name"
                          aria-label="Name"
                          required
                        />
                      </div>
                      <div class="mb-3 independent">
                        <label class="form-label" for="add-user-fullname">Last Name</label>
                        <input
                          type="text"
                          class="form-control input-ind"
                          id="add-user-fullname"
                          placeholder="Last Name"
                          name="lastname"
                          aria-label="Last Name"
                          required
                        />
                      </div>

                      <div class="mb-3  typecompany" style="display: none;">
                        <label class="form-label" for="add-user-company">Company Name</label>
                        <input
                          type="text"
                          id="add-user-company"
                          class="form-control input-company"
                          placeholder="Company"
                          aria-label="Company"
                          name="name_company"
                          
                        />
                      </div>
                      <div class="mb-3 typecompany" style="display: none;">
                        <label class="form-label" for="add-user-company">Org Number</label>
                        <input
                          type="text"
                          id="add-user-company"
                          class="form-control input-company"
                          placeholder="Company"
                          aria-label="Company"
                          name="org_num"
                          
                        />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="add-user-email">Email</label>
                        <input
                          type="email"
                          id="add-user-email"
                          class="form-control"
                          placeholder="E-mail"
                          aria-label="E-mail"
                          name="email"
                          required
                        />
                      </div>
                      
                      <div class="mb-3">
                        <label class="form-label" for="add-user-contact">Address</label>
                        <input
                          type="text"
                          id="add-user-contact"
                          class="form-control"
                          placeholder="Address"
                          aria-label="Address"
                          name="address"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="add-user-contact">Phone</label>
                        <input
                          type="text"
                          id="add-user-contact"
                          class="form-control phone-mask"
                          placeholder="Company Phone"
                          aria-label="phone"
                          name="phone"
                          required
                        />
                      </div>
                      @csrf
                      <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                      <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->


<script>
  
$('#optionone').change(function() {
    if ($('#optionone').is(":checked")) {
      $('.independent').show();
      $('.typecompany').hide();
      $('.input-ind').attr("required", "required");
      $('.input-company').removeAttr("required", "required");
    }
  });

  $('#optiontwo').change(function() {
    if ($('#optiontwo').is(":checked")) {
      $('.independent').hide();
      $('.typecompany').show();
      $('.input-ind').removeAttr("required", "required");
      $('.input-company').attr("required", "required");
    }
  });
  


</script>  
@endsection