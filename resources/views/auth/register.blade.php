@extends('layouts.blankLayout')
@section('title', env('APP_NAME'))

@section('content')


    <div
        class="authentication-wrapper authentication-cover authentication-bg d-flex align-items-center justify-content-center h-100">



        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4     ">
            <div class="w-px-400 mx-auto">

                <h4 class="mb-1 pt-2">Adventure starts here 🚀</h4>
                <p class="mb-4">Make your app management easy and fun!</p>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <form id="formAuthentication" class="mb-3" action="{{ route('register-action') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan }}" />
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter your username" autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Enter your email" />
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                            <label class="form-check-label" for="terms-conditions">
                                I agree to
                                <a href="javascript:void(0);">privacy policy & terms</a>
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100">Sign up</button>
                </form>



            </div>
        </div>


    </div>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#formAuthentication').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    alert("Register User successfully")

                },
                error: function(error) {
                    alert('Error,please attention and try again!');
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }
                }
            });
        });

        function displayValidationErrors(errors) {

            $('.validation-errors').remove();


            $.each(errors, function(field, messages) {
                var input = $('[name="' + field + '"]');
                var container = input.closest('.form-control');
                $.each(messages, function(index, message) {
                    container.append('<p class="text-danger validation-errors">' + message +
                        '</p>');
                });
            });
        }
    });
</script>
