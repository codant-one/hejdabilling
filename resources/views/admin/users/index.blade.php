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
                          <span>Users</span>
                          <div class="d-flex align-items-center my-1">
                            <h4 class="mb-0 me-2">{{$total_users}}</h4>
              
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
                
              </div>
              <!-- Users List Table -->
              <div class="card">
                <div class="card-header border-bottom">
                  
                  <div class="row">
                        <div class="col-md-4"><h5 class="card-title mb-3">Search Filter</h5></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="text-align:end;">
                            <button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New User</span></span></button>
                        </div>
                  </div>
                </div>
                <div class="card-datatable table-responsive">
                  <table class="table border-top">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Nick</th>
                        <th>Actions</th>
                      </tr>
                      <tbody class="table">
                            @foreach($users as $user)
                                <tr> 
                                    <td></td>                   
                                    <td>{{ $user->name}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ $user->nick }}</td>                                    
                                    <td>
                                      <p><a href="{{route('admin.invoices.user',$user->id)}}"><i class="fa-regular fa-eye fa-lg"></i></a>
                                        <!--<a href="#"><i class="fa-regular fa-pen-to-square fa-lg" style="color: #2e0684;"></i></a>-->
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
                    <form action ="{{route('admin.add.user')}}" method="POST" class="pt-0" >

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

                      <div class="mb-3 independent">
                        <label class="form-label">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          placeholder="E-mail"
                          aria-label="E-mail"
                          name="email"
                          required
                        />
                      </div>
                      
                      <div class="mb-3 independent">
                        <label class="form-label" for="add-user-contact">Nick</label>
                        <input
                          type="text"
                          id="add-user-contact"
                          class="form-control"
                          placeholder="Nick"
                          aria-label="Address"
                          name="nick"
                          required
                        />
                      </div>
                      <div class="mb-3 independent">
                        <label class="form-label" for="add-user-contact">Rol</label>
                        <select  class="form-select mb-4" name="rol" required>
                            <option value="">Select</option>
                            @foreach($roles as $rol)
                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach
                      </select>
                      </div>

                      <div class="mb-3 independent">
                        <label class="form-label" for="add-user-contact">Password</label>
                        <input
                          type="password"
                          class="form-control"
                          placeholder="Password"
                          name="password"
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
 
@endsection