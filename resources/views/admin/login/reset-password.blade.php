@extends('layouts.master')

@section('content')

<!-- Content -->

<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Reset Password -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-4 mt-2">
                <a href="index.html" class="app-brand-link gap-2">
                  <img src="{{ asset('assets/img/illustrations/icon-login-hejdabilling.png') }}" alt="logo" width="50">
                  <span class="app-brand-text demo text-body fw-bold ms-1">Hejdabilling</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-1 pt-2">Reset Password 🔒</h4>
              <p class="mb-4">for <span class="fw-bold">Welcome</span></p>
              <form id="formAuthentication" action="{{route('admin.change')}}" method="POST">
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">New Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="confirm-password">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="confirm-password"
                      class="form-control"
                      name="confirm-password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
                <input type="hidden" id="token" name="token">
                @csrf
                <button type="submit" class="btn btn-primary d-grid w-100 mb-3">Set new password</button>
                <div class="text-center">
                  <a href="auth-login-basic.html">
                    <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                    Back to login
                  </a>
                </div>
              </form>
            </div>
          </div>
          <!-- /Reset Password -->
        </div>
      </div>
    </div>

    <!-- / Content -->
<script>
// $(document).ready(function(){ 

    var token = @json($token);

    $.ajax({
        url: `{{ route("admin.passwordfind", ['token' => $token]) }}`,
        type: 'GET',
        success: function (response) {
            $("#password").prop("disabled",false);
            $("#password2").prop("disabled",false);
            $("#token").val(token);
        },
        error: function (response) {
            Swal.fire({
             text: "Token invalido",
             icon: "error",
             buttonsStyling: !1,
             confirmButtonText: "Entendido",
             customClass: {
                 confirmButton: "btn btn-danger"
             }
            }).then((function(t) {
                window.location.href = "{{route('admin.forgotpassword')}}";
            }
            ));
        }
    });
</script>
@endsection