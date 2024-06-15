<!-- BEGIN: Vendor JS-->

<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/hammer/hammer.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>

<script src="../../assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->

<script src="{{ asset(mix('assets/js/main.js')) }}"></script>
<script src="../../assets/js/pages-auth.js"></script>

<script src="{{ asset('assets/js/form-layouts.js') }}"></script>

<script src="{{ asset(mix('assets/vendor/libs/select2/select2.js')) }}"></script>
<script src="{{ asset(mix('assets/js/forms-selects.js')) }}"></script>

<!-- Development Scripts -->

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<!-- Form Repeater -->

<script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

<script src="{{ asset('assets/js/forms-extras.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

<script src="{{asset('assets/js/custom/core.js')}}"></script>
<script src="{{asset('/js/components/data-table.js')}}"></script>
<!-- End Development Scripts -->
<script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="../../assets/js/cards-statistics.js"></script>
<script src="../../assets/vendor/libs/dropzone/dropzone.js"></script>
<script src="../../assets/js/forms-file-upload.js"></script>
<!--Busnisss by rawannnnn -->

<!--- end  -->

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
