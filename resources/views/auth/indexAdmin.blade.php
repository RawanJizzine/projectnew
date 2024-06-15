@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts.blankLayout')
@section('title',env('APP_NAME'))

@section('content')


<div class="authentication-wrapper authentication-cover authentication-bg d-flex align-items-center justify-content-center h-100">

 
      
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4     ">
            <div class="w-px-400 mx-auto">
              
                <h2 >Welcome to Digital Services 👋 </h2>
                <p class="mb-4">Please sign-in to your account and start the adventure</p>
                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
               @endif

                <form id="formAuthentication" class="mb-3" action="{{ route('loginAdmin') }}" method="GET">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label" >Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus>
                    </div>
                    <div class="mb-3 form-password-toggle">
                       
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                    </div>
            </div>
           
            <br>
            <button  class="btn btn-primary d-grid w-100">
                Sign in
            </button>
            </form>
  
            

            
        </div>
    </div>


</div>


@endsection
