
@extends('layouts/commonFront')
@section('layoutContentFront')


@include('layouts/sections/navbar/navbar-front')

<!-- Sections:Start -->

<!-- / Sections:End -->

    @yield('contentFront')

@include('layouts/sections/footer/footer-front')
@endsection
