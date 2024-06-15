<!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/tabler-icons.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/fontawesome.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/flag-icons.css')) }}" />
<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css' .$configData['rtlSupport'] .'/core.css')) }}" class="{{ $configData['hasCustomizer'] ? 'template-customizer-core-css' : '' }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css' .$configData['rtlSupport'] .'/' .$configData['theme'].'.css')) }}" class="{{ $configData['hasCustomizer'] ? 'template-customizer-theme-css' : '' }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/css/demo.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')) }}" />
<link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="../../assets/vendor/libs/dropzone/dropzone.css" />
<!--Rawannnnnnnnnn Busnissss -->

<!-- end busnusssssss -->

<!-- Vendor -->
   
    <link rel="stylesheet" href="../../assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />


<link rel="stylesheet" href="{{asset(mix('assets/vendor/libs/select2/select2.css'))}}" />
<!-- Development Styles -->
<link rel="stylesheet" href="{{asset(mix('assets/vendor/libs/tagify/tagify.css'))}}" />
<link rel="stylesheet" href="{{asset(mix('assets/vendor/css/pages/page-auth.css'))}}">
<link rel="stylesheet" href="{{asset(mix('assets/vendor/libs/sweetalert2/sweetalert2.css'))}}" />
<link rel="stylesheet" href="{{asset(mix('assets/vendor/libs/toastr/toastr.css'))}}" />
<link rel="stylesheet" href="{{asset(mix('assets/vendor/libs/animate-css/animate.css'))}}" />
<link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />

<!-- Form Repeater -->

<!-- End Form Repeater -->


<!-- End Development Styles -->

<!-- Vendor Styles -->
@yield('vendor-style')


<!-- Page Styles -->
@yield('page-style')
