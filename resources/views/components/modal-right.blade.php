 <!-- Enable Scrolling & Backdrop Offcanvas -->
 <div class="col-lg-4 col-md-6">
    <div class="mt-3">
      <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="{{ $id }}" aria-labelledby="offcanvasBothLabel">
        <div class="offcanvas-header">
          <h5 id="offcanvasBothLabel" class="offcanvas-title">{{ $title }}</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mb-auto mx-0 flex-grow-0">
          <form action="{{ $route }}">
            @csrf
            {{ $form }}
          </form>
        </div>
        <div class="p-5 justify-content-center d-flex">
          <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
      </div>
    </div>
  </div>