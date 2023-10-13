@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title">
               <h3>@lang('front.service_details')</h3>
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
                           @if(isset($service) && $service->hasMedia('image'))
                           <img src="{!! url($service->getFirstMediaUrl('image')) !!}" alt="" />
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
                     <!-- Nav tabs -->
                     {{-- <ul class="sinple-tab-menu" role="tablist">
                        <li class=" active"><a href="#view1" data-toggle="tab"><img style="width:79px; height:99px;"
                                 src="{{asset('front_assets/img/product/15.jpg')}}" alt="" /></a></li>
                        <li><a href="#view2" data-toggle="tab"><img
                                 src="{{asset('front_assets/img/product/tab/2.jpg')}}" alt="" /></a></li>
                        <li><a href="#view3" data-toggle="tab"><img
                                 src="{{asset('front_assets/img/product/tab/1.jpg')}}" alt="" /></a></li>
                        <li><a href="#view4" data-toggle="tab"><img
                                 src="{{asset('front_assets/img/product/tab/4.jpg')}}" alt="" /></a></li>
                        <li><a href="#view5" data-toggle="tab"><img
                                 src="{{asset('front_assets/img/product/tab/5.jpg')}}" alt="" /></a></li>
                     </ul> --}}
                  </div>
                  <!-- <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                     <div class="product-simple-content">
                        <div class="sinple-c-title">
                           <h3>{{$service->name}}</h3>
                        </div>
                        <div class="checkbox">
                           <span><i class="fa fa-check-square" aria-hidden="true"></i>In stock</span>
                        </div>
                        <span> SKU:MH03</span>
                        <div class="service-price-star star-2">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                           <span>(1Review)&nbsp;&nbsp;|&nbsp;&nbsp; Add Your Review </span>
                        </div>
                        <h4>{!! getPriceColumn($service) !!}</h4>
                        <div class="quick-add-to-cart">
                           <form method="post" class="cart">
                              <div class="numbers-row">
                                 <label for="french-hens">Qty:</label>
                                 <input type="number" id="french-hens" value="3">
                              </div>
                           </form>
                        </div>
                        <br/>
                        <br/>
                        <div class="quick-add-to-cart">
                           {{-- <button href="javascript:void(0)" onclick="addToCart({{$service->id}})" class="btn btn-lg btn-success" ><span class="lnr lnr-cart"></span>Add to Cart</button> --}}
                           {{-- <form method="post" class="cart">
                              <!-- <button data-toggle="modal" data-target="#myModal" class="single_add_to_cart_button hyper-page" type="button"><span class="lnr lnr-cart"></span>Bulk Order</button> -->
                  </form> --}}
               </div>
               <br />
               <div class="quick-add-to-cart">
                  <a href="{!! route('home.checkout') !!}" onclick="addToCart({{$service->id}})" type="button"
                     class="btn btn-lg btn-warning col-sm-12"><span class="lnr lnr-cart"></span>Book Now</a>
               </div>
               <div class="action-heiper">
                  <!--<a href="#"><span class="lnr lnr-sync"></span></a>-->
                  {{-- <a href="#"><span class="lnr lnr-cart"></span></a>
                  <a href="#"><span class="lnr lnr-heart"></span></a>
               </div>
               <p>Stay comfortable and stay in the race no matter what the weather's up to. The Bruno Compete Hoodie's
                  water-repellent exterior shields you from the elements, while advanced fabric technology inside wicks
                  moisture to keep you dry.</p>
            </div> --}}
            {{--
         </div> -->old template <-- --}} {{-- --> new template start <-- --}} <section class="booking-card">
               <div class="container">
                  <div class="row">
                     <div class="col-3"></div>
                     <div class="col-6">
                        <div class="box-warp">
                           <!-- Content Start -->
                           <div class="">
                              <h3>@lang('front.pick_date_and_time')</h3>
                           </div>
                           <!-- Calender start -->
                           <div class="calender text-center">
                              <div class="calender-head">
                                 <h5>December 2022</h5>
                              </div>
                              <div class="container-fluid">
                                 <div class="row col-md-offset-4">
                                    <div class="day x-border col-md-1">
                                       <p class="day-head-b">MON</p>
                                       <p>01</p>
                                    </div>
                                    <div class="day x-border col-md-1">
                                       <p class="day-head-b">MON</p>
                                       <p>01</p>
                                    </div>
                                    <div class="day x-border col-md-1">
                                       <p class="day-head-b">MON</p>
                                       <p>01</p>
                                    </div>
                                    <div class="day x-border col-md-1">
                                       <p class="day-head-b">MON</p>
                                       <p>01</p>
                                    </div>
                                    <div class="day x-border col-md-1">
                                       <p class="day-head-b">MON</p>
                                       <p>01</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Calender end -->
                           <!-- time picker -->
                           <div class="container-fluid">
                              <div class="row">
                                 <div class="day-time col-md-6 col-md-offset-3">
                                    <div class="day-time-part-wrap">
                                       <ul class="nav nav-pills nav-justified">
                                          <li class="active">
                                             <a href="#">@lang('front.morning')</a>
                                          </li>
                                          <li><a href="#">@lang('front.afternoon')</a></li>
                                          <li><a href="#">@lang('front.evening')</a></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- time slots -->
                           <div class="container">
                              <div class='row'>
                                 <div class='col-md-8 col-md-offset-2'>
                                    <div class="carousel slide media-carousel" id="media">
                                       <div class="carousel-inner">
                                          <div class="item active">
                                             <div class="row">
                                                <div class="col-md-3">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                                <div class="col-md-3">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                                <div class="col-md-3">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                                <div class="col-md-3">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="item">
                                             <div class="row">
                                                <div class="col-md-4">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                                <div class="col-md-4">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                                <div class="col-md-4">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="item">
                                             <div class="row">
                                                <div class="col-md-4">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                                <div class="col-md-4">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                                <div class="col-md-4">
                                                   <p class="text-center">4:00 PM</p>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
                                       <a data-slide="next" href="#media" class="right carousel-control">›</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-3"></div>
                  </div>
                  <div class="row cr-box">
                     <div class="col-md-7">
                        <p>Specialty Haircut(Skin fades, blow out, Mohawk)</p>
                     </div>
                     <div class="col-md-5 text-right">
                        <p>$33.00</p>
                        <p>4:15 PM - 4:45 PM</p>
                     </div>
                     <div class="col-md-12">
                        <div class="media">
                           <div class="media-left">
                              <img src="01.png" class="media-object" alt="">
                           </div>
                           <div class="media-body">
                              <h4>Luis D Garcia</h4>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row mt-5">
                     <div class="col-md-12">
                        <a href="#">+ Add another service</a>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-7"></div>
                     <div class="col-md-5 text-right">
                        <p>Total</p>
                        <h3>$33.00</h3>
                        <p>30min</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <button type="button" class="btn btn-primary btn-lg btn-block">Continue</button>
                     </div>
                  </div>
               </div>
               </section>
               {{-- --> new template end <-- --}} </div>
      </div>
      <!-- product-simple-area-end -->
      {{-- <div class="product-info-detailed pb-80">
         <div class="row">
            <div class="col-lg-12">
               <div class="product-info-tab">
                  <!-- Nav tabs -->
                  <ul class="product-info-tab-menu" role="tablist">
                     <li class="active"><a href="#details" data-toggle="tab">details</a></li>
                     <li><a href="#property" data-toggle="tab">Properties</a></li>
                     <!-- <li><a href="#careinstru" data-toggle="tab">Care Instruction</a></li> -->
                     <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                     <!--  <li><a href="#return" data-toggle="tab">Return</a></li> -->
                     <li><a href="#reviews" data-toggle="tab">reviews 1</a></li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div class="tab-pane active" id="details">
                        <div class="product-info-tab-content">
                           <p>Chilly weather is just an excuse to throw on your toasty, handsome new Oslo Trek Hoodie.
                              It features an adjustable drawstring hood and a kangaroo pocket for extra hand warmth. The
                              ultra-soft, cozy lining will have you wishing for more brisk days.</p>
                           <ul>
                              <li> Brown hoodie with black detail.</li>
                              <li>Pullover.</li>
                              <li>Adjustable drawstring hood.</li>
                              <li>Ribbed cuffs/waistband.</li>
                              <li>Machine wash/dry.</li>
                           </ul>
                        </div>
                     </div>
                     <div class="tab-pane" id="property">
                        <div class="product-info-tab-content">
                           <p>Chilly property is just an excuse to throw on your toasty, handsome new Oslo Trek Hoodie.
                              It features an adjustable drawstring hood and a kangaroo pocket for extra hand warmth. The
                              ultra-soft, cozy lining will have you wishing for more brisk days.</p>
                           <ul>
                              <li> Brown hoodie with black detail.</li>
                              <li>Pullover.</li>
                              <li>Adjustable drawstring hood.</li>
                              <li>Ribbed cuffs/waistband.</li>
                              <li>Machine wash/dry.</li>
                           </ul>
                        </div>
                     </div>
                     <!-- <div class="tab-pane" id="careinstru">
                              <div class="product-info-tab-content">
                              	<p>Chilly careinstru is just an excuse to throw on your toasty, handsome new Oslo Trek Hoodie. It features an adjustable drawstring hood and a kangaroo pocket for extra hand warmth. The ultra-soft, cozy lining will have you wishing for more brisk days.</p>
                              	<ul>
                              		<li> Brown hoodie with black detail.</li>
                              		<li>Pullover.</li>
                              		<li>Adjustable drawstring hood.</li>
                              		<li>Ribbed cuffs/waistband.</li>
                              		<li>Machine wash/dry.</li>
                              	</ul>
                              </div>
                              </div> -->
                     <div class="tab-pane" id="warranty">
                        <div class="product-info-tab-content">
                           <p>Chilly warranty is just an excuse to throw on your toasty, handsome new Oslo Trek Hoodie.
                              It features an adjustable drawstring hood and a kangaroo pocket for extra hand warmth. The
                              ultra-soft, cozy lining will have you wishing for more brisk days.</p>
                           <ul>
                              <li> Brown hoodie with black detail.</li>
                              <li>Pullover.</li>
                              <li>Adjustable drawstring hood.</li>
                              <li>Ribbed cuffs/waistband.</li>
                              <li>Machine wash/dry.</li>
                           </ul>
                        </div>
                     </div>
                     <!-- <div class="tab-pane" id="return">
                              <div class="product-info-tab-content">
                              	<p>Chilly return is just an excuse to throw on your toasty, handsome new Oslo Trek Hoodie. It features an adjustable drawstring hood and a kangaroo pocket for extra hand warmth. The ultra-soft, cozy lining will have you wishing for more brisk days.</p>
                              	<ul>
                              		<li> Brown hoodie with black detail.</li>
                              		<li>Pullover.</li>
                              		<li>Adjustable drawstring hood.</li>
                              		<li>Ribbed cuffs/waistband.</li>
                              		<li>Machine wash/dry.</li>
                              	</ul>
                              </div>
                              </div> -->
                     <div class="tab-pane" id="reviews">
                        <div class="customer-review-top">
                           <h3>Customer Reviews</h3>
                           <h4>Plazathemes</h4>
                           <div class="cus-review-left">
                              <div class="single-customer-rating">
                                 <span>Quality</span>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star-o"></i>
                                 <i class="fa fa-star-o"></i>
                              </div>
                              <div class="single-customer-rating">
                                 <span>Price</span>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star-o"></i>
                                 <i class="fa fa-star-o"></i>
                              </div>
                              <div class="single-customer-rating">
                                 <span>Value</span>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                              </div>
                           </div>
                           <div class="cus-review-left">
                              <p>Plazathemes</p>
                              <span> Review by Plazathemes </span>
                              <span> Posted on 7/21/16 </span>
                           </div>
                        </div>
                        <div class="customer-review-bottom fix">
                           <h2>You're reviewing:</h2>
                           <h2>Bruno Compete Hoodie</h2>
                           <p>Your Rating <span>*</span></p>
                           <div class="cus-review-left">
                              <div class="single-customer-rating">
                                 <span>Price</span>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star-o"></i>
                                 <i class="fa fa-star-o"></i>
                              </div>
                              <div class="single-customer-rating">
                                 <span>Value</span>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star-o"></i>
                              </div>
                              <div class="single-customer-rating">
                                 <span> Quality</span>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                                 <i class="fa fa-star"></i>
                              </div>
                           </div>
                        </div>
                        <div class="customer-review-form">
                           <form>
                              <div class="form-group contuct_f">
                                 <label for="exampleInputEmail1">Nickname <span>*</span></label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name">
                              </div>
                              <div class="form-group contuct_f">
                                 <label for="exampleInputPassword1">Summary <span>*</span></label>
                                 <input type="email" class="form-control" id="exampleInputPassword1"
                                    placeholder="Email">
                              </div>
                              <div class="form-group contuct_f">
                                 <label for="exampleInputPassword1">Review <span>*</span></label>
                                 <textarea class="form-control" rows="3"></textarea>
                              </div>
                              <button type="submit" class="btn btn-default contact-btn">Submit Review</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> --}}
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
      <!--<div class="row">
               <div class="col-lg-12">
               	<div class="bedroom-sideber mt-40">
               		<div class="bedroom-title text-uppercase">
               			<h4>Compare Products</h4>		
               		</div>
               		<p>You have no items to compare.</p>
               	</div>	
               	<div class="bedroom-sideber mt-40">
               		<div class="bedroom-title text-uppercase">
               			<h4>My Wish List</h4>
               		</div>
               		<p>You have no items in your wish list.</p>
               	</div>								
               </div>
               </div>-->
   </div>
</div>
</div>
</div>
<!-- all-hyperion-page-end -->
<!-- Related product Start -->
{{-- <section>
   <div class="container">
      <div class="upsell-product">
         <div class="upsell-product-title">
            <h3 class="text-uppercase">Related Products</h3>
         </div>
         <div class="row dotted-style3">
            <div class="upsell-product-active">
               <div class="col-lg-12">
                  <div class="single-new-product">
                     <div class="product-img">
                        <a href="#">
                           <img src="{{asset('front_assets/img/product/5.jpg')}}" class="first_img" alt="" />
                           <img src="{{asset('front_assets/img/product/12.jpg')}}" class="seceond_img" alt="" />
                        </a>
                        <div class="new-product-action feature-action">
                           <!--	<a href="#"><span class="lnr lnr-sync"></span></a>-->
                           <a href="#"><span class="lnr lnr-cart cart_pad"></span>Add to Cart</a>
                           <a href="#"><span class="lnr lnr-heart"></span></a>
                        </div>
                     </div>
                     <div class="product-content text-center">
                        <a href="#">
                           <h3>Beaumont Summit</h3>
                        </a>
                        <div class="product-price-star">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                        </div>
                        <h4>Rs44.00</h4>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div class="single-new-product">
                     <div class="product-img">
                        <a href="#">
                           <img src="{{asset('front_assets/img/product/3.jpg')}}" class="first_img" alt="" />
                           <img src="{{asset('front_assets/img/product/5.jpg')}}" class="seceond_img" alt="" />
                        </a>
                        <div class="new-product-action feature-action">
                           <!--<a href="#"><span class="lnr lnr-sync"></span></a>-->
                           <a href="#"><span class="lnr lnr-cart cart_pad"></span>Add to Cart</a>
                           <a href="#"><span class="lnr lnr-heart"></span></a>
                        </div>
                     </div>
                     <div class="product-content text-center">
                        <a href="#">
                           <h3>Beaumont Summit</h3>
                        </a>
                        <div class="product-price-star">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                        </div>
                        <h4>Rs23.00</h4>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div class="single-new-product">
                     <div class="product-img">
                        <a href="#">
                           <img src="{{asset('front_assets/img/product/10.jpg')}}" class="first_img" alt="" />
                           <img src="{{asset('front_assets/img/product/5.jpg')}}" class="seceond_img" alt="" />
                        </a>
                        <div class="new-product-action feature-action">
                           <!--	<a href="#"><span class="lnr lnr-sync"></span></a>-->
                           <a href="#"><span class="lnr lnr-cart cart_pad"></span>Add to Cart</a>
                           <a href="#"><span class="lnr lnr-heart"></span></a>
                        </div>
                     </div>
                     <div class="product-content text-center">
                        <a href="#">
                           <h3>Beaumont Summit</h3>
                        </a>
                        <div class="product-price-star">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star-o"></i>
                           <i class="fa fa-star-o"></i>
                        </div>
                        <h4>Rs88.00</h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section> --}}
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
            <h5 style="padding:5px 0;">@lang('cod')</h5>
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
@endsection
<script>
   function addToCart(id){
		@if(Auth::check())
			$.post('{{ route('home.storecart') }}',{_token:'{{ csrf_token() }}', id:id}, function(results){
				dynamicCart(results);
			});
			var x = document.getElementById("snackbarCart");
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		@else
			var x = document.getElementById("mustlogin");
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		@endif
	}
</script>
