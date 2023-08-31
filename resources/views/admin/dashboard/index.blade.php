@extends('admin.layouts.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
              <!-- Layout Demo -->
              <div class="layout-demo-wrapper">
                <div>
                  <img
                    src="{{asset('/assets/img/illustrations/fundadores.jpg')}}"
                    class="img-fluid"
                    alt="fundadores"
                    width="480"
                  />
                </div>
                <div class="layout-demo-info">
                  <h4>Soon Hejdabilling</h4>
                  <!--<div class="alert alert-primary mt-4" role="alert">
                    <strong>Important:</strong> If you have enabled localStorage then the menu (navigation) will be
                    synced with localStorage value.
                  </div>-->
                </div>
              </div>
              <!--/ Layout Demo -->
            </div>

@endsection