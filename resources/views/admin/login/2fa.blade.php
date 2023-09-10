@extends('layouts.master')

@section('content')

<!-- Content -->

<div class="authentication-wrapper authentication-basic px-4">
      <div class="authentication-inner py-4">
        <!--  Two Steps Verification -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mt-2">
              <a href="https://hejdabil.se" class="app-brand-link gap-2">
              <img src="{{ asset('assets/img/illustrations/icon-login-hejdabilling.png') }}" alt="logo" width="50">
                <span class="app-brand-text demo text-body fw-bold ms-1">Hejdabilling</span>
              </a>
            </div>
            <!-- /Logo -->
           
            @if ($errors->any())
                <span class="alert alert-danger">
                    {{ $errors->first() }}
                </span>
                @endif
            <h4 class="mb-1 pt-2">Two Step Verification 💬</h4>
            <p class="text-start mb-4">
                Google Authenticator
              <span class="fw-bold d-block mt-2">{{ $token }}</span>
            </p>
            <p class="mb-0 fw-semibold">Type your 6 digit security code</p>
            <form id="twoStepsForm" action="{{route('auth.2fa.validate')}}" method="POST">
              <div class="mb-3">
                <div
                  class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper"
                >
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1"
                    autofocus
                  />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1"
                  />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1"
                  />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1"
                  />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1"
                  />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1"
                  />
                </div>
                <!-- Create a hidden field which is combined by 3 fields above -->
                <input type="hidden" name="otp" />
              </div>
              @csrf
              <button type="submit" class="btn btn-primary d-grid w-100 mb-3">Verify my account</button>
              
            </form>
          </div>
        </div>
        <!-- / Two Steps Verification -->
      </div>
    </div>


@endsection