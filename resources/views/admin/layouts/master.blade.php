<!DOCTYPE html>
<html lang="es"
class="light-style layout-navbar-fixed layout-menu-fixed layout-menu-collapsed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('/assets\/')}}"
  data-template="vertical-menu-template"
>

@include('admin.layouts.partials.header')

<body>

<!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        
        <div class="layout-container">
            <!-- SIDEBAR -->
            @include('admin.layouts.partials.sidebar')
            <!-- FIN SIDEBAR -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('admin.layouts.partials.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                        @yield('content')
                    <!--/Content-->
                    @include('admin.layouts.partials.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>    
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

    @include('layouts.partials.scripts')

    @yield('scripts')
</body>    

</html>