<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://kit.fontawesome.com/d77b722d2c.js" crossorigin="anonymous"></script>
<!--ALERTAS-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!--<script src="{{ asset('/fakit.js') }}"></script>-->

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
    <script src="{{ asset('/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    
    <script src="{{ asset('/assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    
    <script src="{{ asset('/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<!----------------fin public/vendor----------------------------->


<!--------------------------public/js---------------->

<!-- Main JS -->
<script src="{{ asset('/assets/js/main.js') }}"></script>
<!-- Page JS -->

<script src="{{ asset('/assets//js/pages-pricing.js') }}"></script>
<script src="{{ asset('/assets/js/pages-auth.js') }}"></script>
<script src="{{ asset('/assets/js/pages-profile.js') }}"></script>

<script src="{{ asset('/assets/js/modal-add-new-cc.js') }}"></script>
<script src="{{ asset('/assets/js/modal-add-new-address.js') }}"></script>
<script src="{{ asset('/assets/js/modal-edit-user.js') }}"></script>
<script src="{{ asset('/assets/js/modal-enable-otp.js') }}"></script>
<script src="{{ asset('/assets/js/modal-share-project.js') }}"></script>
<script src="{{ asset('/assets/js/modal-create-app.js') }}"></script>
<script src="{{ asset('/assets/js/modal-two-factor-auth.js') }}"></script>

<script src="{{ asset('/assets/js/pages-account-settings-account.js') }}"></script>

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