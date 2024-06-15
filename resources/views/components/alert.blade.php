<div class="toast-container top-0 end-0 mt-2 mx-2">
    <div class="bs-toast toast animate__animated my-2 fade animate__fade hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
        <div class="toast-header">
            <i class="ti ti-bell ti-xs"></i>
            <div class="me-auto fw-medium toast-title mt-sm-1 mx-2"></div>
            <small class="text-muted">just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            
        </div>
    </div>
</div>
@if(count(request()->all())>0)
@if ($errors->any())
<div class="toast-container top-0 end-0 mt-2 mx-2">
    @foreach ($errors->all() as $key => $error)
    <div class="bs-toast toast animate__animated my-2 fade animate__fade hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
        <div class="toast-header text-danger ">
            <i class="ti ti-bell ti-xs me-2"></i>
            <strong class="me-auto">Error</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ $error }}
        </div>
    </div>

    @endforeach
</div>
@endif
@endif



<script>
    $(document).ready(function() {
        @if(Session::has('error'))
        $('.toast-body').html('{{ Session::get('error') }}');
        $('.toast-title').html('Error');
        $('.toast-title').addClass('text-danger');
        $('.toast-header').addClass('text-danger');
        $('.toast').toast('show');

        @elseif (Session::has('success'))
        $('.toast-body').html('{{ Session::get('success') }}');
        $('.toast-title').html('Success');
        $('.toast-title').addClass('text-success');
        $('.toast-header').addClass('text-success');
        $('.toast').toast('show');

        @elseif (Session::has('warning'))
        $('.toast-body').html('{{ Session::get('warning') }}');
        $('.toast-title').html('Warning');
        $('.toast-title').addClass('text-warning');
        $('.toast-header').addClass('text-warning');
        $('.toast').toast('show');

        @elseif (Session::has('info'))
        $('.toast-body').html('{{ Session::get('info') }}');
        $('.toast-title').html('Info');
        $('.toast-title').addClass('text-info');
        $('.toast-header').addClass('text-info');
        $('.toast').toast('show');
        @endif
        @if(count(request()->all())>0)
        @if ($errors->any())
            $('.toast').toast('show');
        @endif
        @endif
    });

</script>
