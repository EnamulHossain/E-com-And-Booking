@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title">
               <h3>@lang('front.product_details')</h3>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- page-title-wrapper-end -->
<!-- all-hyperion-page-start -->
<div class="all-hyperion-page">
   <div class="container">
      <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <!-- product-simple-area-start -->
            <div class="product-simple-area ptb-80">
               <div class="row">
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                     <div class="tab-content">
                        <div class="tab-pane active" id="view1">
                           @if(isset($product) && $product->hasMedia('image'))
                           <img src="{!! url($product->getFirstMediaUrl('image')) !!}" alt="" style="width: 400px; height: 550px;"/>
                           @endif
                        </div>
                        <div class="tab-pane" id="view2">
                           <a class="image-link" href="{{asset('front_assets/img/product/2.jpg')}}"><img
                                 src="{{asset('front_assets/img/product/2.jpg')}}" alt=""></a>
                        </div>
                        <div class="tab-pane" id="view3">
                           <a class="image-link" href="{{asset('front_assets/img/product/3.jpg')}}"><img
                                 src="{{asset('front_assets/img/product/3.jpg')}}" alt=""></a>
                        </div>
                        <div class="tab-pane" id="view4">
                           <a class="image-link" href="{{asset('front_assets/img/product/13.jpg')}}"><img
                                 src="{{asset('front_assets/img/product/13.jpg')}}" alt=""></a>
                        </div>
                        <div class="tab-pane" id="view5">
                           <a class="image-link" href="{{asset('front_assets/img/product/6.jpg')}}"><img
                                 src="{{asset('front_assets/img/product/6.jpg')}}" alt=""></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                     <div class="product-simple-content">
                        <div class="sinple-c-title">
                           <h3>{{$product->name}}</h3>
                        </div>
                        <div class="checkbox">
                           <span><i class="fa fa-check-square" aria-hidden="true"></i>@lang('front.in_stock')</span>
                        </div>
                        <span> SKU:MH03</span>
                        <div class="product-price-star star-2">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <span>(1Review)&nbsp;&nbsp;|&nbsp;&nbsp; @lang('front.add_your_review') </span>
                        </div>
                        <h4>{!! getPriceColumn($product, 'offer_price') !!}</h4>

                        {{-- <div class="color-selector">
                           <label for="product-color"></label>
                           <div class="color-boxes" id="color-boxes">
                              
                           </div>
                           <input type="hidden" id="selected-color" name="selected-color">
                        </div> --}}
                        
                        @if ($colors)
                        <label for="selectOptions">Color: </label>
                        <select id="selectOptions">
                           {{-- <option value="{{$colors}}">{{$colors}}</option> --}}
                           @foreach ($colors as $color)
                              <option value="{{ $color }}">{{ $color }}</option>
                           @endforeach
                        </select>
                        @endif
                        <br>
                        <br>
                        <div class="quick-add-to-cart">
                           <form method="post" class="cart">
                              <div class="numbers-row">
                                 <label for="french-hens">@lang('front.qty'):</label>
                                 <input type="number" id="french-hens" value="1" min="1" onkeypress="return isNumberKey(event)">
                              </div>
                           </form>
                        </div>
                        <br />
                        <br />
                        
                        @if (auth()->check())
                           <div class="quick-add-to-cart">
                              <a href="{!! route('home.cart') !!}" onclick="addToCart({{$product->id}})" class="btn btn-lg btn-success">
                                    <span class="lnr lnr-cart"></span>@lang('front.add_to_cart')
                              </a>
                           </div>
                        @else
                           <div class="quick-add-to-cart">
                              <a href="javascript:void(0)" onclick="AddToCart({{ $product->id }})" class="btn btn-lg btn-success">
                                    <span class="lnr lnr-cart"></span>@lang('front.add_to_cart')
                              </a>
                           </div>
                        @endif

                        <br />
                        <div class="quick-add-to-cart">
                           <a href="{!! route('home.checkout') !!}" onclick="addToCart({{$product->id}})" type="button"
                              class="btn btn-lg btn-warning col-sm-12"><span
                                 class="lnr lnr-cart"></span>@lang('front.buy_now')</a>
                        </div>
                        <div class="action-heiper">
                           <!--<a href="#"><span class="lnr lnr-sync"></span></a>-->
                           <a href="#"><span class="lnr lnr-cart"></span></a>
                           <a href="#"><span class="lnr lnr-heart"></span></a>
                        </div>
                        <p>
                           {!! $product->description !!}
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="hyper-banner pt-80 pb-40">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="single-banner">
                        <a href="#"></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Related product end -->
<!-- Icons related start -->
<section class="icon_section">
   <div class="container">
      <div class="row">
         <div class="col-md-3 col-sm-3">
            <h4 style="padding:5px 0;"><img src="{{asset('front_assets/img/004-delivery-truck.png')}}"></h4>
            <h5 style="padding:5px 0;">@lang('front.free_home_delivery')</h5>
            <p>@lang('front.free_home_delivery_details')</p>
         </div>
         <div class="col-md-3 col-sm-3">
            <h4 style="padding:5px 0;"><img src="{{asset('front_assets/img/003-undo-button.png')}}"></h4>
            <h5 style="padding:5px 0;">@lang('front.on_the_spot_returns')</h5>
            <p>@lang('front.on_the_spot_returns_details')</p>
         </div>
         <div class="col-md-3 col-sm-3">
            <h4 style="padding:5px 0;"><img src="{{asset('front_assets/img/002-cash-money.png')}}"></h4>
            <h5 style="padding:5px 0;">@lang('front.cod')</h5>
            <p>@lang('front.cod_details')</p>
         </div>
         <div class="col-md-3 col-sm-3">
            <h4 style="padding:5px 0;"><img src="{{asset('front_assets/img/001-tools.png')}}"></h4>
            <h5 style="padding:5px 0;">@lang('front.free_installation')</h5>
            <p>@lang('front.free_installation_details')</p>
         </div>
      </div>
   </div>
</section>
<div id="snackbarCart">@lang('front.added_item_to_cart')</div>
<div id="mustlogin">@lang('front.please_login_to_add_to_cart')</div>
<!-- Icons related Ends -->
<!-- comment card -->
<div class="row" style="margin-left: 400px">
   @foreach ($productReviews as $pr )
      
      <div class="container" style="margin: 10px 0px 0px 0px;">
         <div class="row">
            <div class="col-sm-10">
                  <hr />
                  <div class="review-block">
                     <div class="row">
                        <div class="col-sm-3">
                              <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image"
                                 class="img-rounded">
                              <div class="review-block-name"><a href="#">{{$pr->name}}</a></div>
                              <div class="review-block-date">{{$pr->created_at}}<br />     {{ Carbon\Carbon::parse($pr->created_at)->diffForHumans(Carbon\Carbon::now()) }}                              </div>
                        </div>
                        <div class="col-sm-9">
                           <div class="review-block-rate">
                              @php
                                  // Calculate the number of filled stars based on the rate value
                                  $filledStars = min(5, max(0, floor($pr->rate)));
                                  // Calculate the number of unfilled stars
                                  $unfilledStars = 5 - $filledStars;
                              @endphp

                              @for ($i = 0; $i < $filledStars; $i++)
                                  <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                      <span><i class="fa-solid fa-star fa"></i></span>
                                  </button>
                              @endfor

                              @for ($i = 0; $i < $unfilledStars; $i++)
                                  <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                      <span><i class="fa-solid fa-star fa"></i></span>
                                  </button>
                              @endfor
                          </div>
                              <div class="review-block-description">{{$pr->review}}</div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>

      @endforeach
</div>


<style>
   .color-selector {
      display: flex;
      align-items: center;
   }

   .color-boxes {
      display: flex;
      gap: 5px;
   }

   .color-box {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      cursor: pointer;
      box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
      transition: transform 0.2s ease-in-out;
   }

   .color-box:hover {
      transform: scale(1.1);
   }
   .color-box {
   /* Your existing styles */
   position: relative; /* Add this line */
}

.color-box:hover::after {
   content: attr(title);
   position: absolute;
   top: -30px; /* Adjust as needed */
   left: 50%;
   transform: translateX(-50%);
   padding: 5px;
   background-color: rgba(0, 0, 0, 0.8);
   color: #fff;
   border-radius: 4px;
   white-space: nowrap;
   opacity: 0;
   visibility: hidden;
   transition: opacity 0.2s, visibility 0.2s;
}

.color-box:hover::after {
   opacity: 1;
   visibility: visible;
}



</style>
@endsection
@section('js_custom')
<script>
   function addToCart(id) {
       @if(Auth::check())
       var quantityInput = document.getElementById("french-hens");
       var quantity = 0;
       if (quantityInput) {
           // Get the value of the input field using .value, not .val
           quantity = quantityInput.value;
       }

       // Use the proper route for the AJAX call, assuming 'home.storecart' is the correct route
       $.post('{{ route('home.storecart') }}', {
           _token: '{{ csrf_token() }}',
           id: id,
           quantity: quantity
       }, function (results) {
           dynamicCart(results);
       });
       
       var x = document.getElementById("snackbarCart");
       x.className = "show";
       setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
       @else
       var x = document.getElementById("mustlogin");
       x.className = "show";
       setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
       @endif
   }

   function isNumberKey(evt) {
       var charCode = (evt.which) ? evt.which : evt.keyCode;
       if (charCode > 31 && (charCode < 48 || charCode > 57))
           return false;
       return true;
   }
   

   function AddToCart(id) {
            @if (Auth::check())
                $.post('{{ route('home.storecart') }}', {
                    _token: '{{ csrf_token() }}',
                    id: id
                }, function(results) {
                    dynamicCart(results);
                });
                var x = document.getElementById("snackbarCart");
                x.className = "show";
                setTimeout(function() {
                    x.className = x.className.replace("show", "");
                }, 3000);
            @else
                var x = document.getElementById("mustlogin");
                x.className = "show";
                setTimeout(function() {
                    x.className = x.className.replace("show", "");
                }, 3000);
            @endif
        }
</script>

<script>
   const colorBoxesContainer = document.getElementById('color-boxes');
   const selectedColorInput = document.getElementById('selected-color');

   const colors = @json($colors);

   colors.forEach(color => {
   const colorBox = document.createElement('div');
   colorBox.className = 'color-box';
   colorBox.style.backgroundColor = color;
   colorBox.title = color; 
   colorBox.addEventListener('click', () => selectColor(color));
   colorBoxesContainer.appendChild(colorBox);
   });


   function selectColor(color) {
      selectedColorInput.value = color;
      clearSelectedColor();
      const selectedColorBox = colorBoxesContainer.querySelector(`[style="background-color: ${color};"]`);
      if (selectedColorBox) {
         selectedColorBox.classList.add('selected');
      }
   }

   function clearSelectedColor() {
      const selectedColorBox = colorBoxesContainer.querySelector('.color-box.selected');
      if (selectedColorBox) {
         selectedColorBox.classList.remove('selected');
      }
   }


   
</script>
@endsection
