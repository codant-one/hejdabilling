<!-- Helpers -->
    
<script src="{{asset('/assets/vendor/js/helpers.js')}}"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
<script src="{{asset('/assets/vendor/js/template-customizer.js')}}"></script>
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{asset('/assets/js/config.js')}}"></script>

<!--ALERTAS-->
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<script src="{{ asset('/assets/js/fakit.js') }}"></script>

<!---------------------public/vendor---------------------->

<!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/swiper/swiper.js') }}"></script>

    <script src="{{ asset('/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    
    <script src="{{ asset('/assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    
    <script src="{{ asset('/assets/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/mega-dropdown.js') }}"></script>
    
    <script src="{{ asset('/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <script src="{{ asset('/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/moment/moment.js') }}"></script>
    

<!----------------fin public/vendor----------------------------->


<!--------------------------public/js---------------->

<!-- Main JS -->
<script src="{{ asset('/assets/js/main.js') }}"></script>
<!-- Page JS -->

<!-- Page JS -->
<script src="{{ asset('/assets/js/dashboards-analytics.js') }}"></script>

<!-- <script src="{{ asset('/assets//js/pages-pricing.js') }}"></script> -->
<script src="{{ asset('/assets/js/pages-auth.js') }}"></script>
<script src="{{ asset('/assets/js/pages-profile.js') }}"></script>

<!-- <script src="{{ asset('/assets/js/modal-add-new-cc.js') }}"></script> -->
<!-- <script src="{{ asset('/assets/js/modal-add-new-address.js') }}"></script> -->
<!-- <script src="{{ asset('/assets/js/modal-edit-user.js') }}"></script> -->
<!-- <script src="{{ asset('/assets/js/modal-enable-otp.js') }}"></script> -->
<!-- <script src="{{ asset('/assets/js/modal-share-project.js') }}"></script> -->
<!-- <script src="{{ asset('/assets/js/modal-create-app.js') }}"></script> -->
<script src="{{ asset('/assets/js/modal-two-factor-auth.js') }}"></script>

<!-- <script src="{{ asset('/assets/js/offcanvas-send-invoice.js') }}"></script> -->
<script src="{{ asset('/assets/js/app-invoice-add.js') }}"></script>

<!-- <script src="{{ asset('/assets/js/pages-auth-two-steps.js') }}"></script> -->
<!-- <script src="{{ asset('/assets/js/pages-account-settings-account.js') }}"></script> -->
<!-- <script src="{{ asset('/assets/js/app-user-list.js') }}"></script> -->

<script src="{{ asset('/assets/js/ui-navbar.js') }}"></script>
<script src="{{ asset('/assets/js/offcanvas-add-payment.js') }}"></script>
<!-- <script src="{{ asset('/assets/js/offcanvas-send-invoice.js') }}"></script> -->
<!--------------------------fin public/js---------------->

<!----------------- JS DASHBOARD ADMIN----------------------------->

<!-----------------FIN JS DASHBOARD ADMIN----------------------------->



@if(session()->has('jsAlert'))
                <script>
                  swal({text:"{{ session()->get('jsAlert') }}", icon: "success"});
                  
                </script>
             @endif 

@if(session()->has('jsAlerterror'))
                <script>
                  swal({text:"{{ session()->get('jsAlerterror') }}", icon: "error"});
                </script>
             @endif 