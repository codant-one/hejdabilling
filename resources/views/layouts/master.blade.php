<!DOCTYPE html>
<html lang="es"
dir="ltr" 
style="overflow-x: hidden;" 
data-theme="theme-default" 
data-assets-path="{{asset('/assets\/')}}" 
data-template="vertical-menu-template">

@include('layouts.partials.header')

<body class="text-left ">

    <div class="app-admin-wrap layout-sidebar-large clearfix">
    @include('layouts.partials.navbar')

        

        <!-- ============ Body content start ============= -->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @yield('content')
            </div>
        </div>

        <!-- ============ Body content End ============= -->

    </div>
    <!--=============== End app-admin-wrap ================-->

   
    @include('layouts.partials.footer')
    @include('layouts.partials.scripts')

    @yield('scripts')

</body>

</html>