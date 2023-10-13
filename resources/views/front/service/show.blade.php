@php

// print_r("<pre>");
// print_r($availableDay['weekDay']);die();

use App\Models\AvailabilityHour;
@endphp
@extends('front.layouts.base')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<style>
  .swiper {
    width: 100%;
    height: 100px !important;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
  }

  .calender {
    border-bottom: 0px !important;
  }

  .x-border {
    width: 75px !important;
    height: 90px;
    margin-top: 5px;
    margin-left: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    
  }
  .x-border-color {
    /* box-shadow: 3px 2px 10px -2px rgba(0,166,174,.45) */

    border-color: rgb(0,166,174);
    background-color: #e1f7fb;
    /* box-shadow: 1px 2px 8px -2px rgba(0,166,174,.45); */
  }
  /* booksy-widget-border-color-dark: rgba( 23,23,23;,0.1); */

  .chip {
    /* z-index: -1;
    width: 6rem;
    max-width: 100%;
    text-align: center;
    padding: 0.5rem 0;
    color: rgba(23,23,23,.7);    
    user-select: none;
    cursor: pointer;
    box-shadow: 1px 2px 8px -2px rgba(0,166,174,.45);
    border-color:blue !important */
  }


.x-border.active, .times-lot.active {
    border-color: rgb(0,166,174);
    font-weight: 600;
    box-shadow: 1px 2px 8px -2px rgba(0,166,174,.45);
}
.chip.active, .chip:hover {
    /* color: rgb(23,23,23); */
}
.chip-narrow {
    min-width: 2.5rem;
    min-height: 5.25rem;
    justify-content: flex-start;
}

  .x-border.active, .times-lot.active {
      border-color: rgb(0,166,174);
      font-weight: 600;
      box-shadow: 1px 2px 8px -2px rgba(0,166,174,.45);
  }
  .chip.active, .chip:hover {
      /* color: rgb(23,23,23); */
  }
  .chip-narrow {
      min-width: 2.5rem;
      min-height: 5.25rem;
      justify-content: flex-start;
  }

@media (max-width: 760px) {
  .swiper-button-next {
    right: 20px;
    transform: rotate(90deg);
  }
  .swiper-button-prev {
    left: 20px;
    transform: rotate(90deg);
  }
}
  .times-lot {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    color: #333;
    font-size: 16px;
  }

  .times-lot-bg-color {
    background-color : #e1f7fb !important;
  }

</style>



<style>
  .loader,
  .loader:before,
  .loader:after {
    background: #FFF;
    -webkit-animation: load1 1s infinite ease-in-out;
    animation: load1 1s infinite ease-in-out;
    width: 1em;
    height: 4em;
  }
  .loader:before,
  .loader:after {
    position: absolute;
    top: 0;
    content: "";
  }
  .loader:before {
    left: -1.5em;
  }
  .loader {
    text-indent: -9999em;
    margin: 8em auto;
    position: relative;
    font-size: 12px;
    -webkit-animation-delay: -0.16s;
    animation-delay: -0.16s;
  }
  .loader:after {
    left: 1.5em;
    -webkit-animation-delay: -0.32s;
    animation-delay: -0.32s;
  }

  .loader4:before,
  .loader4:after,
  .loader4 {
    border-radius: 50%;
    width: 2.5em;
    height: 2.5em;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation: load4 1.8s infinite ease-in-out;
    animation: load4 1.8s infinite ease-in-out;
  }
  .loader4 {
    margin: 8em auto;
    font-size: 12px;
    position: relative;
    text-indent: -9999em;
    -webkit-animation-delay: 0.16s;
    animation-delay: 0.16s;
  }
  .loader4:before {
    left: -3.5em;
  }
  .loader4:after {
    left: 3.5em;
    -webkit-animation-delay: 0.32s;
    animation-delay: 0.32s;
  }
  .loader4:before,
  .loader4:after {
    content: "";
    position: absolute;
    top: 0;
  }
  @-webkit-keyframes load4 {
    0%,
    80%,
    100% {
      box-shadow: 0 2.5em 0 -1.3em rgba(204,204,204,1);
    }
    40% {
      box-shadow: 0 2.5em 0 0 rgba(204,204,204,1);
    }
  }
  @keyframes load4 {
    0%,
    80%,
    100% {
      box-shadow: 0 2.5em 0 -1.3em rgba(204,204,204,1);

    }
    40% {
      box-shadow: 0 2.5em 0 0 rgba(204,204,204,1);
    }
  }
  .adjust {
    z-index: -1 !important;
    min-height:60px;
    height:auto;
  }
  
  .mt
  { margin-top:50px;}
</style>
@endpush
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


<div style="z-index: -1;">

  <div class="adjust">
    <div class="loader4"></div>
  </div>
</div>



  <input type="hidden" value="{{json_encode($avaibleDates['times'])}}" name="avaiableTimeslot">
  <input type="hidden" value="{{json_encode(AvailabilityHour::availabilityHour()['timeslots'])}}" name="timeslots">

  <section class="booking-card">
    <div class="container">
      <div class="row">
          <div class="box-warp">
            <!-- Content Start -->
            <div class="" style="margin-bottom: -200px">
              <h3>@lang('front.pick_date_and_time')</h3>
                <img src="{!! $service->getFirstMediaUrl('image') !!}" alt="" style="width: 200px; height: 200px;" >
                <h4>{{$service->name}}</h4>
            </div>

            <!-- Calender start -->
            <div class="calender text-center">
              <div class="calender-head">
                <h5>February 2023</h5>
              </div>
              
              <div class="row ">
                <div class="col-md-6 col-md-offset-3">
                <div class="calender2 swiper abc">
                  <div class="swiper-wrapper">

                    @isset($dates)
                      @foreach($dates as $date)
                        <div class="swiper-slide x-border {{isset($date['weekDay']) && isset($avaibleDates['weekDay']) ? (in_array($date['weekDay'], $avaibleDates['weekDay']) ? 'x-border-color enabled' : "") : ""}}">
                          <div class="">
                            <p class="day-head-b">
                              <a data-weekDay="{{$date['weekDay'] ?? ""}}" data-date="{{$date['date'] ?? ""}}" class="day-slot">
                                {{ucfirst($date['weekDay']) ?? ""}}
                              </a>
                            </p>
                            <p>{{$date['day'] ?? ""}}</p>
                          </div>
                        </div>
                      @endforeach
                    @endisset
                  </div>
                  <div class="swiper-button-next calender-button-next"></div>
                  <div class="swiper-button-prev calender-button-prev"></div>
                </div>
              </div>
            </div>

            <!-- Calender end -->

            <div class="row">
              <div class="day-time col-md-6 col-md-offset-3">
                <div class="day-time-part-wrap">
                  <ul class="nav nav-pills nav-justified">
                    <li class="active"><a href="#morning">@lang('front.morning')</a></li>
                    <li><a href="#afternoon">@lang('front.afternoon')</a></li>
                    <li><a href="#evening">@lang('front.evening')</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- time slots -->
            <div class="container">
              <div class='row'>
                <div class='col-md-8 col-md-offset-2'>
                  <!-- Swiper -->
                  <div class="swiper">
                    <div class="swiper-wrapper">
                      @isset(AvailabilityHour::availabilityHour()['morning'])
                        {{-- <div id="morning"> --}}
                          @foreach(AvailabilityHour::availabilityHour()['morning'] as $key => $morning)
                            <div class="swiper-slide">
                              <div class="times-lot" data-timeslot="morning" data-time="{{$key}}" id="{{$key}}">{{$morning}}</div>
                            </div>
                          @endforeach
                        {{-- </div> --}}
                      @endisset

                      @isset(AvailabilityHour::availabilityHour()['afternoon'])
                        {{-- <div id="afternoon"> --}}
                          @foreach(AvailabilityHour::availabilityHour()['afternoon'] as $key2 => $afternoon)
                            <div class="swiper-slide">
                              <div class="times-lot" data-timeslot="afternoon" data-time="{{$key2}}" id="{{$key2}}">{{$afternoon}}</div>
                            </div>
                          @endforeach
                        {{-- </div> --}}
                      @endisset

                      @isset(AvailabilityHour::availabilityHour()['evening'])
                        @foreach(AvailabilityHour::availabilityHour()['evening'] as $key3 => $evening)
                          <div class="swiper-slide">
                            <div class="times-lot" data-timeslot="evening" data-time="{{$key3}}" id="{{$key3}}">{{$evening}}</div>
                          </div>
                        @endforeach
                      @endisset

                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="row cr-box">
        <div class="col-md-7">
          <p>{{$service->description}}</p>
        </div>
        <div class="col-md-5 text-right">
          <p>{!! getPriceColumn($service) !!}</p>
          <p>{{$service->duration}}</p>
        </div>
        <div class="col-md-12">
          <div class="media">
            <div class="media-left">
              <img src="01.png" class="media-object" alt="">
            </div>
            <div class="media-body">
              <h4>{{$service->name}}</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-md-12">
          {{-- <a href="#">+ Add another service</a> --}}
        </div>
      </div>
      <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-5 text-right">
          <p>@lang('front.total')</p>
          <h3>{!! getPriceColumn($service) !!}</h3>
          <p>{{$service->duration}}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary btn-lg btn-block service-form">@lang('front.continue')</button>
        </div>
      </div>
    </div>
  </section>
</form>

{{-- <div class="all-hyperion-page">
<div class="all-hyperion-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
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

<section class="icon_section">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3">
        <h4 style="padding:5px 0;"><img src="{{asset('front_assets/img/004-delivery-truck.png')}}"></h4>
        <h5 style="padding:5px 0;">@lang('front.free_home_delivery')</h5>
        <p>@lang('front.whatever_you_order_our_products_ship_free_always')</p>
      </div>
      <div class="col-md-3 col-sm-3">
        <h4 style="padding:5px 0;"><img src="{{asset('front_assets/img/003-undo-button.png')}}"></h4>
        <h5 style="padding:5px 0;">@lang('front.on_the_spot_returns')</h5>
        <p>@lang('front.didnt_like_it_no_problem')</p>
      </div>
      <div class="col-md-3 col-sm-3">
        <h4 style="padding:5px 0;"><img src="{{asset('front_assets/img/002-cash-money.png')}}"></h4>
        <h5 style="padding:5px 0;">@lang('front.cod')</h5>
        <p>@lang('front.you_can_pay_by_cash_or_card_at_the_time_of_delivery')</p>
      </div>
      <div class="col-md-3 col-sm-3">
        <h4 style="padding:5px 0;"><img src="{{asset('front_assets/img/001-tools.png')}}"></h4>
        <h5 style="padding:5px 0;">@lang('front.free_installation')</h5>
        <p>@lang('front.we_assemble_the_product_and_clear_away_the_packaging')</p>
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

@push('js')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
  var swiper = new Swiper('.swiper', {
      slidesPerView: 6,
      direction: getDirection(),
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      on: {
        resize: function () {
          swiper.changeDirection(getDirection());
        },
      },
    });

  var calender = new Swiper('.calender2', {
      slidesPerView: 6,
      direction: getDirection(),
      navigation: {
        nextEl: '.calender-button-next',
        prevEl: '.calender-button-prev',
      },
      on: {
        resize: function () {
          calender.changeDirection(getDirection());
        },
      },
    });

    function getDirection() {
      var windowWidth = window.innerWidth;
      var direction = window.innerWidth <= 760 ? 'vertical' : 'horizontal';

      return direction;
    }

    $(".calender2").on('click', '.enabled', function() {
      $("input[name=booking_date]").val(" ")
      $("input[name=booking_time]").val(" ")
      $(".times-lot").removeClass('active');
      $(".times-lot").removeClass('times-lot-bg-color');
      $(".x-border").removeClass('active');
      $(".time-slot").removeClass('active');

      $(this).addClass('active');

      const weekDay = $(this).find('.day-slot').data('weekday')
      const date = $(this).find('.day-slot').data('date')

      const avaiableTimeslot = JSON.parse($('input[name=avaiableTimeslot]').val())[weekDay] || [];
      const timeslots = JSON.parse($('input[name=timeslots]').val()) || [];

      for(index in timeslots) {
        $(`#${timeslots[index]}`).css('border-color', '#ccc');
        $(`#${timeslots[index]}`).removeClass('time-enabled');
      }
      
      for(slot in avaiableTimeslot) {  
        $(`#${avaiableTimeslot[slot]}`).addClass('time-enabled');
        $(`#${avaiableTimeslot[slot].replace(":", "_")}`).css('border-color', '#00a6ae');
        $(`#${avaiableTimeslot[slot].replace(":", "_")}`).addClass('times-lot-bg-color');
      }

      $("input[name=booking_date]").val(date)      
    })
    
    $(".swiper").on('click', '.times-lot-bg-color', function() {
      $(".times-lot-bg-color").removeClass('active');
      $(this).addClass('active');

      const time = $(this).data('time')

      $("input[name=booking_time]").val("00:"+time.replace("_", ":"))
    })

    $(".service-form").on("click", function() {

      let type = true;

      const bookingDate = $.trim($("input[name=booking_date]").val())
      const bookingTime = $.trim($("input[name=booking_time]").val())

      if(bookingDate == "" && bookingTime == "") {
        alert("Select avaible date and time.")
        type = false;
      }else if(bookingDate == "") {
        alert("Select avaible date.")
        type = false;
      }else if(bookingTime == "") {
        alert("Select avaible time.")
        type = false;
      }

      return type;
    })
</script>
@endpush
