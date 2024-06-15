@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    

        .accordion-button .fa-circle-chevron-up {
            transition: transform 0.2s ease-in-out;
        }

        .rotate {
  transform: rotate(180deg);
}

.accordion-button {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}

.accordion-title {
  font-size: 1.5rem; /* Adjust the font size as needed */
  margin: 0;
  flex-grow: 1;
}

.accordion-button i {
  font-size: 30px;
  padding-left: 20px; /* Adjust padding if needed */
}
    
.title-container {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    margin: 0;
}

.title-left {
    margin: 0;
    margin-right: 40%;
    padding: 0;
    font-size: 22px;
    flex: 1 1 100%;
}
.table-wrapper {
    width: 100%;
    overflow-x: auto;
  }

.title-right {
    margin: 0;
    padding: 0;
    margin-right: 15%;
    font-size: 22px;
    flex: 1 1 100%;
}

.info-row {
    display: flex;
    align-items: center;
    margin-top: 5px;
    font-size: 16px;
}

.info-label {
    font-weight: 500;
}

.info-value {
    margin-left: 10px; /* Adjust the margin as needed */
}

@media (min-width: 700px) {
    .title-container {
        flex-wrap: nowrap;
    }

    .title-left {
        flex: 1 1 auto;
       
    }

    .title-right {
        flex: 1 1 auto;
     
        
    }
    
}
@media (max-width: 699px) {
    .title-left, .title-right {
        flex: 1 1 100%;
        margin-right: 0;
        margin-top: 12px;
    }
   
}

.row-cart{
  display: flex;
    align-items: center;
    margin-top: 5px;
    font-size: 16px;
}

@media (max-width: 768px) {
            .comment-section, .price-details-section {
                padding-top: 20px !important;
            }
            .price-details-section {
                padding-left: 0 !important;
            }
        }

</style>

@section('content')

<div class="col-md">
  <h4 class=" fw-medium">Order #{{$order->id}}</h4>
  <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow">
    <div class="accordion-item card">
      <h1 class="accordion-header text-body d-flex justify-content-between align-items-center" id="accordionIconOne">
        <button
          type="button"
          class="accordion-button collapsed d-flex justify-content-between align-items-center"
          data-bs-toggle="collapse"
          data-bs-target="#accordionIcon-1"
          aria-controls="accordionIcon-1">
          <span class="accordion-title">Order and Account</span>
          <i class="fa-solid fa-circle-chevron-down"></i>
        </button>
      </h1>
      <div id="accordionIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
        <div  style="margin-top: 2%;" class="accordion-body">
          <hr>
          <div class="title-container">
            
            <div class="title-left">
              <h3>Order Information</h3>
              <div class="info-row">
                <span class="info-label">Order Date</span><span style="margin-left:25px;">{{$order->created_at
                    }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Order Status</span><span class="info-value"      >Order {{$order->status}}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Address</span><span style="margin-left:50px;"     >  <textarea name="description" class="form-control" cols="70" rows="7" required>{{$order->customaddress}} </textarea></span>
              </div>
            </div>

            <div class="title-right">
              <h3>Account Information</h3>
              <div class="info-row">
                <span class="info-label">Customer Name </span><span style="margin-left:25px;"     >{{$order->customfullName}}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Email</span><span style="margin-left:110px;"       class="info-value"      >{{$order->custommodalemail}}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Channel</span><span style="margin-left:90px;"       class="info-value"      >{{$order->modalAddressCountry}}</span>
              </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  
  <div id="accordionIconTwo" class="accordion mt-3 accordion-without-arrow">
    <div class="accordion-item card">
        <h1 class="accordion-header text-body d-flex justify-content-between align-items-center" id="accordionIconTwo">
            <button type="button" class="accordion-button collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#accordionIcon-2" aria-controls="accordionIcon-2">
                <span class="accordion-title">Payment</span>
                <i class="fa-solid fa-circle-chevron-down"></i>
            </button>
        </h1>
        <div id="accordionIcon-2" class="accordion-collapse collapse" data-bs-parent="#accordionIconTwo">
          <div  style="margin-top: 2%;" class="accordion-body">
            <hr>
            <div class="title-container">
              
              <div class="title-left">
                <h3>Order Payment</h3>
                <div class="info-row">
                  <span class="info-label">On OMT</span><span style="margin-left:47px;">{{$order->switchonOmt==1?"YES":"NO"  }}</span>
                </div>
                <div class="info-row">
                  <span class="info-label">On Delivery</span><span style="margin-left:25px;">{{$order->switchondelivery==1?"YES":"NO"  }}</span>
                </div>
                
              </div>
  
              
          </div>
          </div>
        </div>
    </div>
  </div>
  <div id="accordionIconThree" class="accordion mt-3 accordion-without-arrow">
    <div class="accordion-item card">
        <h1 class="accordion-header text-body d-flex justify-content-between align-items-center" id="accordionIconThree">
            <button type="button" class="accordion-button collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#accordionIcon-3" aria-controls="accordionIcon-3">
                <span class="accordion-title">Products Ordered</span>
                <i class="fa-solid fa-circle-chevron-down"></i>
            </button>
        </h1>
        <div id="accordionIcon-3" class="accordion-collapse collapse" data-bs-parent="#accordionIconThree">
          <div  style="margin-top: 2%;" class="accordion-body">
            <hr>
            <div class="title-container">
              
              <div class="table-wrapper">
               
               
               
                  <table class="table">
                      <thead>
                          <tr>
                              <th>SKU</th>
                              <th>Barcode</th>
                              <th>Product Name </th>
                              <th>Unit Price</th>
                              <th>Subtotal</th>
                              <th>Discount Amount</th>
                              <th>Tax Amount</th>
                              <th>Grand Total</th>
      
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($orders ?? [] as $index => $data)
                      

                        <tr>
                           
                            <td>{{$data->product->sku}} </td>
                            <td>{{$data->product->barcode}} </td>
                             <td>{{$data->product->title}} </td>
                               <td>{{$data->product->price}} </td>
                               <td>{{ $data->product->price * $data->quantity }}</td>
                               <td>0.00 </td>
                            <td>0.00 </td>
                             <td>{{ $data->product->price * $data->quantity }} </td>
                              
                        </tr>
                    @endforeach
                      </tbody>
      
      
                      
                  </table>
      
      
        


                
              </div>
  
              
          </div>
          
          <div class="container">
            <div class="row d-flex align-items-start">
              <div class="col-12 col-lg-6 comment-section" style="padding-top: 50px;">
                <form action="{{ route('submit.comment.order') }}" method="POST">
                    @csrf
                    <label style="font-size: 20px;" class="form-label">Comment</label>
                    <textarea name="description" class="form-control" cols="70" rows="7" required></textarea>
                    <input type="hidden" name="orderEmail" value="{{ $order->custommodalemail }}">
                    <button style="margin-top: 20px; width: 100%; height: 50px;" type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            </div>
                <div class="col-12 col-lg-6 price-details-section ms-auto" style="padding-left: 10px; padding-top: 50px;">
                    <div class="border rounded p-4 mb-3 pb-3">
                        <!-- Price Details -->
                        <h6>Price Details</h6>
                        <hr class="mx-n4" />
                        <dl class="row mb-0">
                            <dt class="col-6 fw-normal text-heading">Bag Total</dt>
                            <dd class="col-6 text-end">${{$order->total_price}}</dd>
            
                            <dt class="col-sm-6 fw-normal">Coupon Discount</dt>
                            <dd class="col-6 text-end">$0.00</dd>
            
                            <dt class="col-6 fw-normal text-heading">Order Total</dt>
                            <dd class="col-6 text-end">${{$order->total_price}}</dd>
            
                            <dt class="col-6 fw-normal text-heading">Delivery Charges</dt>
                            <dd class="col-6 text-end">
                                <s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span>
                            </dd>
                        </dl>
                        <hr class="mx-n4" />
                        <dl class="row mb-0">
                            <dt class="col-6 text-heading">Total</dt>
                            <dd class="col-6 fw-medium text-end text-heading mb-0">${{$order->total_price}}</dd>
                        </dl>
                    </div>
                  
                </div>
            </div>
        </div>

        </div>
        </div>
    </div>
</div>
</div>


@endsection
@include('content.dashboard.appointments.scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var accordionButtons = document.querySelectorAll('#accordionIcon .accordion-button');

  accordionButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var icon = this.querySelector('i');
      var allIcons = document.querySelectorAll('#accordionIcon i');

      allIcons.forEach(function (ic) {
        ic.classList.remove('fa-circle-chevron-up');
        ic.classList.add('fa-circle-chevron-down');
      });

      if (this.classList.contains('collapsed')) {
        icon.classList.remove('fa-circle-chevron-up');
        icon.classList.add('fa-circle-chevron-down');
      } else {
        icon.classList.remove('fa-circle-chevron-down');
        icon.classList.add('fa-circle-chevron-up');
      }
    });
  });
});
document.addEventListener('DOMContentLoaded', function () {
  var accordionButtons = document.querySelectorAll('#accordionIconTwo .accordion-button');

  accordionButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var icon = this.querySelector('i');
      var allIcons = document.querySelectorAll('#accordionIconTwo i');

      allIcons.forEach(function (ic) {
        ic.classList.remove('fa-circle-chevron-up');
        ic.classList.add('fa-circle-chevron-down');
      });

      if (this.classList.contains('collapsed')) {
        icon.classList.remove('fa-circle-chevron-up');
        icon.classList.add('fa-circle-chevron-down');
      } else {
        icon.classList.remove('fa-circle-chevron-down');
        icon.classList.add('fa-circle-chevron-up');
      }
    });
  });
});
document.addEventListener('DOMContentLoaded', function () {
  var accordionButtons = document.querySelectorAll('#accordionIconThree .accordion-button');

  accordionButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var icon = this.querySelector('i');
      var allIcons = document.querySelectorAll('#accordionIconThree i');

      allIcons.forEach(function (ic) {
        ic.classList.remove('fa-circle-chevron-up');
        ic.classList.add('fa-circle-chevron-down');
      });

      if (this.classList.contains('collapsed')) {
        icon.classList.remove('fa-circle-chevron-up');
        icon.classList.add('fa-circle-chevron-down');
      } else {
        icon.classList.remove('fa-circle-chevron-down');
        icon.classList.add('fa-circle-chevron-up');
      }
    });
  });
});
</script>
