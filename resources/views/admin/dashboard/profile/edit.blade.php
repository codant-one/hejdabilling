@extends('admin.layouts.master')

@section('content')

 <!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit Profile</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item">
                      <a class="nav-link active" href="{{route('admin.profile')}}"
                        ><i class="ti-xs ti ti-users me-1"></i> Account</a
                      >
                    </li>
                    
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        @if(auth()->user()->avatar)
                        <img
                          src="{{auth()->user()->avatar}}"
                          alt="user-avatar"
                          class="d-block w-px-100 h-px-100 rounded"
                          id="uploadedAvatar"
                        />
                        @else
                        <img
                          src="{{ asset('/assets/img/illustrations/usuario.png') }}"
                          alt="user-avatar"
                          class="d-block w-px-100 h-px-100 rounded"
                          id="uploadedAvatar"
                        />
                        @endif
                     <form action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data" >
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="ti ti-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                              name="avatar"
                            />
                          </label>
                          <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                          <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                     <!-- <form action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data" >-->
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="name"
                              value="{{auth()->user()->name}}"
                              placeholder="Name"
                              autofocus
                              require
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="lastname" id="lastName" value="{{auth()->user()->lastname}}" placeholder="Lastname" require/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              placeholder="{{auth()->user()->email}}"
                              readonly
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Company</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                              name="company"
                              value="{{auth()->user()->company}}"
                              placeholder="{{auth()->user()->company}}"
                              require
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">SWE (+46)</span>
                              <input
                                type="text"
                                id="phoneNumber"
                                name="phone_company"
                                class="form-control"
                                value="{{auth()->user()->phone_company}}"
                                placeholder="{{auth()->user()->phone_company}}"
                              />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address_company" value="{{auth()->user()->address_company}}" placeholder="{{auth()->user()->address_company}}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="formFile" class="form-label">Upload company logo</label>
                            <input class="form-control" type="file" id="formFile" name="logo_company" />
                          </div>
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
                  <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                      <form id="formAccountDeactivation" onsubmit="return false">
                        <div class="form-check mb-4">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            name="accountActivation"
                            id="accountActivation"
                          />
                          <label class="form-check-label" for="accountActivation"
                            >I confirm my account deactivation</label
                          >
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

@endsection