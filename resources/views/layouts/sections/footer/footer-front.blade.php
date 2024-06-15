<footer class="landing-footer bg-body footer-text">
  <div class="footer-top">
    <div class="container">
      <div class="row gx-0 gy-4 g-md-5">
        <div class="col-lg-5">
          @php
          $user_id = Auth::id();
         $data = App\Models\AppData::where('user_id', $user_id)->first();
        
     @endphp
         <a href="landing-page.html" class="app-brand-link">
            
                 <img  src="{{ asset('images/' . $data->image) }}"
                 style="width=32px; height:22px;"      >
            
             <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{$data->title}}</span>
           </a>
          <p class="footer-text footer-logo-description mb-4">
            Most developer friendly & highly customisable Admin Dashboard Template.
          </p>
          <form  id="sendEmailForm" class="footer-form" action="{{ route('save.email') }}" method="post" >
            @csrf
            <label for="footer-email" class="small">Subscribe to newsletter</label>
            <div class="d-flex mt-1">
              <input
                type="email"
                class="form-control rounded-0 rounded-start-bottom rounded-start-top"
                id="footer-email"
                name="footer_email"
                placeholder="Your email" required/>
              <button
                type="submit"
                name="submit"
                class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
                Subscribe
              </button>
            </div>
          </form>
        </div>
       
        <div class="col-lg-2 col-md-4 col-sm-6">
          <h6 class="footer-title mb-4">Pages</h6>
          <ul class="list-unstyled">
           
            <li class="mb-3">
              <a href="{{route('login-view')}}" target="_blank" class="footer-link">Login/Register</a>
            </li>
            <li class="mb-3">
              <a href="{{ route('login') }}" target="_blank" class="footer-link">Dashboard</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
        </div>
        <div class="col-lg-3 col-md-4">
          <h6 class="footer-title mb-4">Download our app</h6>
          <a href="{{ url('https://www.apple.com/') }}" class="d-block footer-link mb-3 pb-2">
            <img src="{{ asset('assets/img/front-pages/landing-page/apple-icon.png') }}" alt="apple icon">
        </a>
        <a href="{{ url('https://play.google.com/store') }}" class="d-block footer-link">
          <img src="{{ asset('assets/img/front-pages/landing-page/google-play-icon.png') }}" alt="google play icon">
      </a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom py-3">
    <div
      class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
      <div class="mb-2 mb-md-0">
        <span class="footer-text"
          >©
          <script>
            document.write(new Date().getFullYear());
          </script>
        </span>
        <a href="https://pixinvent.com" target="_blank" class="fw-medium text-white footer-link">Pixinvent,</a>
        <span class="footer-text"> Made with ❤️ for a better web.</span>
      </div>
      <div>
        <a href="https://github.com/pixinvent" class="footer-link me-3" target="_blank">
          <img
            src="../../assets/img/front-pages/icons/github-light.png"
            alt="github icon"
            data-app-light-img="front-pages/icons/github-light.png"
            data-app-dark-img="front-pages/icons/github-dark.png" />
        </a>
        <a href="https://www.facebook.com/pixinvents/" class="footer-link me-3" target="_blank">
          <img
            src="../../assets/img/front-pages/icons/facebook-light.png"
            alt="facebook icon"
            data-app-light-img="front-pages/icons/facebook-light.png"
            data-app-dark-img="front-pages/icons/facebook-dark.png" />
        </a>
        <a href="https://twitter.com/pixinvents" class="footer-link me-3" target="_blank">
          <img
            src="../../assets/img/front-pages/icons/twitter-light.png"
            alt="twitter icon"
            data-app-light-img="front-pages/icons/twitter-light.png"
            data-app-dark-img="front-pages/icons/twitter-dark.png" />
        </a>
        <a href="https://www.instagram.com/pixinvents/" class="footer-link" target="_blank">
          <img
            src="../../assets/img/front-pages/icons/instagram-light.png"
            alt="google icon"
            data-app-light-img="front-pages/icons/instagram-light.png"
            data-app-dark-img="front-pages/icons/instagram-dark.png" />
        </a>
      </div>
    </div>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        $('#sendEmailForm').submit(function(e) {
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
                    alert("save Email Successfuly")
                 
                },
                error: function(error) {
                    alert('Error when saving email!');
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
