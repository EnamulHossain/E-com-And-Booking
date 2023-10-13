@extends('front.layouts.base')
@section('content')
<div style="padding: 0px 140px">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-8">
        <!-- Carousel container -->
        <div id="my-pics" class="carousel slide" style="height: 400px; overflow: hidden; margin-top: 10px;"
          data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#my-pics" data-slide-to="0" class="active"></li>
            <li data-target="#my-pics" data-slide-to="1"></li>
            <li data-target="#my-pics" data-slide-to="2"></li>
          </ol>
          <!-- Content -->
          <div class="carousel-inner" role="listbox">
            <!-- Slide 1 -->
            <div class="item active">
              <img src="{{asset('front_assets/img/single-saloon/lake.jpg')}}" alt="Image1">
            </div>
            <!-- Slide 2 -->
            <div class="item">
              <img src="{{asset('front_assets/img/single-saloon/landscape.jpg')}}" alt="Image2">
            </div>
            <!-- Slide 3 -->
            <div class="item">
              <img src="{{asset('front_assets/img/single-saloon/sunset.jpg')}}" alt="Image3">
            </div>
          </div>
          <!-- Previous/Next controls -->
          <a class="left carousel-control" href="#my-pics" role="button" data-slide="prev">
            <span class="icon-prev" aria-hidden="true"></span>
            <span class="sr-only">@lang('front.previous')</span>
          </a>
          <a class="right carousel-control" href="#my-pics" role="button" data-slide="next">
            <span class="icon-next" aria-hidden="true"></span>
            <span class="sr-only">@lang('front.next')</span>
          </a>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <h1>
              @lang('front.barbar_shop_name')
            </h1>
            <p class="text-gray">
              @lang('front.address')
            </p>
          </div>
          <div class="col-sm-6 text-right" style="margin-top: 25px;">
            <i class="fa-regular fa-2xl fa-heart text-gray fa"></i>
          </div>
        </div>
        <!-- search bar -->
        <div class="row">
          <div class="col-sm-6">
            <h3>@lang('front.services')</h3>
          </div>
          <div class="col-sm-6 text-right">
            <input type="search" placeholder="Search for service">
          </div>
        </div>
        <!-- Services card -->
        <div class="row">
          <div class="col-sm-12">
            <button type="button" class="collapsible service-button text-left bold"
              style="width: 100%; font-size: large; display: flex; justify-content: space-between; margin: 20px 0px;">@lang('front.popular_services')
              <span><i class="fa-light fa-chevron-right fa"></i></span></button>
            <div class="row content">
              <!-- each service -->
              <div class="col-sm-12 border-bottom" style="padding-top: 10px; margin-bottom: 10px;">
                <div class="col-sm-6 text-lg">
                  @lang('front.service_name')
                </div>
                <div class="col-sm-6 text-right">
                  <div class="col-sm-10">
                    <div class="bold">
                      @lang('front.amount')
                    </div>
                    <div class="text-gray">
                      @lang('front.time')
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <button class="booking-button">
                      @lang('front.book')
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- image galary -->
        <div class="row">
          <h3 style="padding-bottom: 10px; padding-left:14px;">@lang('front.see_our_work')</h3>
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
              </img>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
              </img>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
              </img>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
              </img>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
              </img>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
              </img>
            </div>
          </div>
        </div>
        <!-- comment card -->
        <div class="row">
          <div class="container" style="margin: 10px 0px 0px 0px;">
            <div class="row">
              <div class="col-sm-4">
                <h4>
                  @lang('front.reviews')
                </h4>
                <p>
                  @lang('front.some_details_about_the_review')
                </p>
              </div>
              <div class="col-sm-3">
                <div class="rating-block">
                  <h4>@lang('front.average_user_rating')</h4>
                  <h2 class="bold padding-bottom-7">4.3 <small>/ 5</small></h2>
                  <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                    <span><i class="fa-solid fa-star fa"></i></span>
                  </button>
                  <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                    <span><i class="fa-solid fa-star fa"></i></span>
                  </button>
                  <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                    <span><i class="fa-solid fa-star fa"></i></span>
                  </button>
                  <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                    <span><i class="fa-solid fa-star fa"></i></span>
                  </button>
                  <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                    <span><i class="fa-solid fa-star fa"></i></span>
                  </button>
                </div>
              </div>
              <div class="col-sm-4">
                <h4>@lang('front.rating_breakdown')</h4>
                <div class="pull-left">
                  <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">5 <span><i class="fa-solid fa-star fa"></i></span></div>
                  </div>
                  <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5"
                        aria-valuemin="0" aria-valuemax="5" style="width: 1000%">
                        <span class="sr-only">80% Complete (danger)</span>
                      </div>
                    </div>
                  </div>
                  <div class="pull-right" style="margin-left:10px;">1</div>
                </div>
                <div class="pull-left">
                  <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">4 <span><i class="fa-solid fa-star fa"></i></span></div>
                  </div>
                  <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4"
                        aria-valuemin="0" aria-valuemax="5" style="width: 80%">
                        <span class="sr-only">80% Complete (danger)</span>
                      </div>
                    </div>
                  </div>
                  <div class="pull-right" style="margin-left:10px;">1</div>
                </div>
                <div class="pull-left">
                  <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">3 <span><i class="fa-solid fa-star fa"></i></span></div>
                  </div>
                  <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0"
                        aria-valuemax="5" style="width: 60%">
                        <span class="sr-only">80% Complete (danger)</span>
                      </div>
                    </div>
                  </div>
                  <div class="pull-right" style="margin-left:10px;">0</div>
                </div>
                <div class="pull-left">
                  <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">2 <span><i class="fa-solid fa-star fa"></i></span></div>
                  </div>
                  <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2"
                        aria-valuemin="0" aria-valuemax="5" style="width: 40%">
                        <span class="sr-only">80% Complete (danger)</span>
                      </div>
                    </div>
                  </div>
                  <div class="pull-right" style="margin-left:10px;">0</div>
                </div>
                <div class="pull-left">
                  <div class="pull-left" style="width:35px; line-height:1;">
                    <div style="height:9px; margin:5px 0;">1 <span><i class="fa-solid fa-star fa"></i></span></div>
                  </div>
                  <div class="pull-left" style="width:180px;">
                    <div class="progress" style="height:9px; margin:8px 0;">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1"
                        aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                        <span class="sr-only">80% Complete (danger)</span>
                      </div>
                    </div>
                  </div>
                  <div class="pull-right" style="margin-left:10px;">0</div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-10">
                <hr />
                <div class="review-block">
                  <div class="row">
                    <div class="col-sm-3">
                      <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                      <div class="review-block-name"><a href="#">nktailor</a></div>
                      <div class="review-block-date">January 29, 2016<br />1 day ago</div>
                    </div>
                    <div class="col-sm-9">
                      <div class="review-block-rate">
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                      </div>
                      <div class="review-block-title">this was nice in buy</div>
                      <div class="review-block-description">this was nice in buy. this was nice in buy. this was nice in
                        buy. this was nice in buy this was nice in buy this was nice in buy this was nice in buy this
                        was nice in buy</div>
                    </div>
                  </div>
                  <hr />
                  <div class="row">
                    <div class="col-sm-3">
                      <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                      <div class="review-block-name"><a href="#">nktailor</a></div>
                      <div class="review-block-date">January 29, 2016<br />1 day ago</div>
                    </div>
                    <div class="col-sm-9">
                      <div class="review-block-rate">
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                      </div>
                      <div class="review-block-title">@lang('front.this_was_nice_in_buy')</div>
                      <div class="review-block-description">@lang('front.this_was_nice_in_buy_details')</div>
                    </div>
                  </div>
                  <hr />
                  <div class="row">
                    <div class="col-sm-3">
                      <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                      <div class="review-block-name"><a href="#">nktailor</a></div>
                      <div class="review-block-date">January 29, 2016<br />1 day ago</div>
                    </div>
                    <div class="col-sm-9">
                      <div class="review-block-rate">
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                          <span><i class="fa-solid fa-star fa"></i></span>
                        </button>
                      </div>
                      <div class="review-block-title">this was nice in buy</div>
                      <div class="review-block-description">this was nice in buy. this was nice in buy. this was nice in
                        buy. this was nice in buy this was nice in buy this was nice in buy this was nice in buy this
                        was nice in buy</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
      {{-- contact card --}}
      <div class="col-sm-4">
        <div>
          <h3 class="border-bottom">
            @lang('front.contact_and_bussiness_hours')
          </h3>
        </div>
        <div class="container-fluid">
          <div class="row border-bottom" style="padding-top:8px">
            <div class="col-sm-8" style="display: flex; align-items:center; height:50px">
              <i class="fa-thin fa-mobile fa fa-2xl" style="padding-right: 8px"></i>
              123456789
            </div>
            <div class="col-sm-4" style="padding-top:5px;">
              <button style="border: 1px solid #ccc; border-radius:5px; padding:8px 20px;">
                @lang('front.call')
              </button>
            </div>
          </div>
          <h4 style="padding-top: 16px">@lang('front.availablity')</h4>
          <div class="row" style="padding-bottom: 5px; padding-top:16px;">
            <div class="col-sm-6">
              Sunday
            </div>
            <div class="col-sm-6 bold-font">
              Closed
            </div>
          </div>
          <div class="row" style="padding-bottom: 5px;">
            <div class="col-sm-6">
              Monday
            </div>
            <div class="col-sm-6 bold-font">
              10:00 AM - 7:00 PM
            </div>
          </div>
          <div class="row" style="padding-bottom: 5px;">
            <div class="col-sm-6">
              Tuesday
            </div>
            <div class="col-sm-6 bold-font">
              10:00 AM - 7:00 PM
            </div>
          </div>
          <div class="row" style="padding-bottom: 5px;">
            <div class="col-sm-6">
              Wednesday
            </div>
            <div class="col-sm-6 bold-font">
              10:00 AM - 7:00 PM
            </div>
          </div>
          <div class="row" style="padding-bottom: 5px;">
            <div class="col-sm-6">
              Thursday
            </div>
            <div class="col-sm-6 bold-font">
              10:00 AM - 7:00 PM
            </div>
          </div>
          <div class="row" style="padding-bottom: 5px;">
            <div class="col-sm-6">
              Friday
            </div>
            <div class="col-sm-6 bold-font">
              10:00 AM - 7:00 PM
            </div>
          </div>
          <div class="row" style="padding-bottom: 5px;">
            <div class="col-sm-6">
              Saturday
            </div>
            <div class="col-sm-6 bold-font">
              10:00 AM - 7:00 PM
            </div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <p style="border-left: 2px solid gray; padding: 10px;">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qui quas porro eligendi, ducimus corporis
              excepturi amet culpa, repudiandae vel quos repellendus animi possimus dignissimos aliquid cupiditate
              consequatur. Rem, expedita asperiores.
            </p>
          </div>
          <div class="row">
            <div class="col-sm-12 border-top" style="border-bottom: 1px solid #CCCCCC; padding-bottom: 10px;">
              <!-- Trigger the modal with a button -->
              <div class="" style="display: flex;">
                <button type="button" class="btn" data-toggle="modal" data-target="#myModal"
                  style="margin-top: 10px; width: 100%; text-align: left; background-color: #FFFFFF;">@lang('front.payment_and_cancelation_policy')</button>
                <i class="fa-light fa-chevron-right fa" style="margin-top: 20px;"></i>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                      <p>Some text in the modal.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12" style="border-bottom: 1px solid #CCCCCC; padding-bottom: 10px;">
              <!-- Trigger the modal with a button -->
              <div class="" style="display: flex;">
                <button type="button" class="btn" data-toggle="modal" data-target="#myModal1"
                  style="margin-top: 10px; width: 100%; text-align: left; background-color: #FFFFFF;">@lang('front.payment_and_cancelation_policy')</button>
                <i class="fa-light fa-chevron-right fa" style="margin-top: 20px;"></i>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="myModal1" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                      <!-- Default unchecked -->
                      <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="defaultUnchecked"
                          name="defaultExampleRadios">
                        <label class="custom-control-label" for="defaultUnchecked">Default unchecked</label>
                      </div>

                      <!-- Default checked -->
                      <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="defaultChecked" name="defaultExampleRadios"
                          checked>
                        <label class="custom-control-label" for="defaultChecked">Default checked</label>
                      </div>
                    </div>
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
  