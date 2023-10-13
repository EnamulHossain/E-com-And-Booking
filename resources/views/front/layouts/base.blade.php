<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{setting('app_name')}} | {{setting('app_short_description')}} </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="icon" href="{{asset('front_assets/img/favicon.png')}}" />
         Place favicon.ico in the root directory -->
  <!-- google-font -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <!-- all css here -->
  <!-- bootstrap v3.3.6 css -->
  <link rel="stylesheet" href="{{asset('front_assets/css/bootstrap.min.css')}}">
  <!-- animate css -->
  <link rel="stylesheet" href="{{asset('front_assets/css/animate.css')}}">
  <!-- jquery-ui.min css -->
  <link rel="stylesheet" href="{{asset('front_assets/css/jquery-ui.min.css')}}">
  <!-- meanmenu css -->
  <link rel="stylesheet" href="{{asset('front_assets/css/meanmenu.min.css')}}">
  <!-- nivo-slider css -->
  <link rel="stylesheet" href="{{asset('front_assets/css/nivo-slider.css')}}">
  <!-- owl.carousel css -->
  <link rel="stylesheet" href="{{asset('front_assets/css/owl.carousel.css')}}">
  <!--linearicons css -->
  <link rel="stylesheet" href="{{asset('front_assets/css/linearicons-icon-font.min.css')}}">
  <!-- font-awesome css -->
  <link rel="stylesheet" href="{{asset('front_assets/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('front_assets/css/bootstrap-social.css')}}">
  <!-- style css -->
  <link rel="stylesheet" href="{{asset('front_assets/style.css')}}">
  <!-- responsive css -->
  <link rel="stylesheet" href="{{asset('front_assets/css/responsive.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('front_assets/css/product-slider.css')}}"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="{{asset('front_assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <!-- <script src="{{asset('front_assets/js/product-slider.js')}}"></script> -->
  <style>
    /* toast */
    #snackbar {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: rgb(235, 214, 26);
      color: #0a0101ef;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 99999;
      left: 50%;
      bottom: 30px;
      font-size: 17px;
    }

    #snackbar.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    #snackbarCart {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: rgb(235, 214, 26);
      color: #0a0101ef;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 1;
      left: 50%;
      bottom: 30px;
      font-size: 17px;
    }

    #snackbarCart.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    #snackbarc,
    #mustlogin,
    #snackbarAddress,
    #snackbarAccount,
    #snackbarAccountPass,
    #mustloginWish {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: rgb(235, 214, 26);
      color: #0a0101ef;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 1;
      left: 50%;
      bottom: 30px;
      font-size: 17px;
    }

    #snackbarc.show,
    #mustlogin.show,
    #snackbarAddress.show,
    #snackbarAccount.show,
    #snackbarAccountPass.show,
    #mustloginWish.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    /* booking page */
    .booking-card {
      padding: 25px;
    }

    .calender {
      border-bottom: 1px solid #cfcfcf;
      padding-bottom: 20px;
    }

    .day {
      margin: 0 5px 0 5px;
      align-items: center;
    }

    .x-border {
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .day.x-border {
      padding: 5px 15px;
    }

    .day-head-b {
      font-size: 12px;
    }

    .nav-pills {
      background-color: rgb(243, 243, 243);
      padding: 5px;
      border-radius: 5px;
    }

    .day-time-part-wrap .nav>.active>a,
    .day-time-part-wrap .nav>.active>a:hover,
    .day-time-part-wrap .nav>.active>a:focus {
      color: #000;
      background: #FFFFFF;
    }

    .day-time {
      margin-top: 25px;
    }

    .time {
      padding: 5px 15px;
      border-radius: 5px;
      text-align: center;
    }

    .text-center {
      text-align: center;
      margin: 0px;
    }

    .text-right {
      text-align: right;
      margin: 0px;
    }

    .cr-box {
      background: #f3f3f3;
      padding: 20px 30px;
      margin-top: 25px;
      border-radius: 5px;
    }

    .mt-5 {
      margin-top: 25px;
    }

    .media-carousel {
      margin-bottom: 0;
      padding: 0 40px 30px 40px;
      margin-top: 30px;
    }

    /* Previous button  */
    .media-carousel .carousel-control.left {
      left: -12px;
      background-image: none;
      background: none repeat scroll 0 0 #222222;
      border: 4px solid #FFFFFF;
      border-radius: 23px 23px 23px 23px;
      height: 40px;
      width: 40px;
    }

    /* Next button  */
    .media-carousel .carousel-control.right {
      right: -12px !important;
      background-image: none;
      background: none repeat scroll 0 0 #222222;
      border: 4px solid #FFFFFF;
      border-radius: 23px 23px 23px 23px;
      height: 40px;
      width: 40px;
    }

    /* booking page end */
    /* single saloon */
    .booking-button {
      background-color: skyblue;
      padding: 4px;
      border: 1px solid skyblue;
      border-radius: 4px;
    }

    .text-gray {
      color: #ccc;
    }

    .text-lg {
      font-size: large;
    }

    .content {
      padding: 0 18px;
      display: none;
      overflow: hidden;
    }

    .service-button {
      background-color: white;
      border: none;

    }

    .m-top-40 {
      margin-top: 40px;
    }

    .border-bottom {
      border-bottom: 1px solid #ccc;
      padding: 0px 0px 8px 0px
    }

    .border-top {
      border-top: 1px solid #ccc;
    }

    .bold-font {
      font-weight: 500;
    }

    input[type=search] {
      width: 300px;
      height: 40px;
      font-size: 16px;
      padding: 0px 20px 0px 40px;
      border-radius: 10px;
      outline: none;
      border: solid #F8F8F8 2px;
      background-color: #F7F7F7;
    }

    .comment-card {
      margin: 0 2px 0 2px;
    }

    btn-grey {
      background-color: #D8D8D8;
      color: #FFF;
    }

    .rating-block {
      background-color: #FAFAFA;
      border: 1px solid #EFEFEF;
      padding: 15px 15px 20px 15px;
      border-radius: 3px;
    }

    .bold {
      font-weight: 700;
    }

    .padding-bottom-7 {
      padding-bottom: 7px;
    }

    .review-block {
      background-color: #FAFAFA;
      border: 1px solid #EFEFEF;
      padding: 15px;
      border-radius: 3px;
      margin-bottom: 15px;
    }

    .review-block-name {
      font-size: 12px;
      margin: 10px 0;
    }

    .review-block-date {
      font-size: 12px;
    }

    .review-block-rate {
      font-size: 13px;
      margin-bottom: 15px;
    }

    .review-block-title {
      font-size: 15px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .review-block-description {
      font-size: 13px;
    }

    /* single salonn end */
    .card-footer {
      display: flex;
      align-items: center;
    }

    .service-level {
      padding: 6px;
      background-color: #FF731D;
      border-radius: 6px;
      color: white;
    }

    .service-rating {
      font-size: 16px
    }

    .button-orange {
      background-color: #FF731D;
      color: white;
    }

    @-webkit-keyframes fadein {
      from {
        bottom: 0;
        opacity: 0;
      }

      to {
        bottom: 30px;
        opacity: 1;
      }
    }

    @keyframes fadein {
      from {
        bottom: 0;
        opacity: 0;
      }

      to {
        bottom: 30px;
        opacity: 1;
      }
    }

    @-webkit-keyframes fadeout {
      from {
        bottom: 30px;
        opacity: 1;
      }

      to {
        bottom: 0;
        opacity: 0;
      }
    }

    @keyframes fadeout {
      from {
        bottom: 30px;
        opacity: 1;
      }

      to {
        bottom: 0;
        opacity: 0;
      }
    }
  </style>
  @yield('css_custom')
  @stack('css')
</head>

<body>
  @include('front.layouts.header')
  @include('front.layouts.menu')
  <!-- slider-area-start -->
  <!-- slider-area-end -->
  @yield('content')

  @if(! auth()->check())
  <!-- contact-area-start -->
  <div class="contact-area ptb-40">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mar_b-30">
          <div class="contuct-info text-center">
            <h4>@lang('front.sign_up_for_news_and_offers')</h4>
            <p>@lang('front.you_may_safely_unsubscribe_at_any_time')</p>
          </div>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-12 col-lg-offset-1 col-xs-12">
          <div class="search-box">
            <form action="#">
              <input type="email" placeholder="Enter your email address" />
              <button><span class="lnr lnr-envelope"></span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  <!-- contact-area-end -->
  <!-- footer-area-start -->
  <div class="footer-area footer-area-4 ptb-80">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 mar_b-30">
          <div class="footer-wrapper">
            <div class="footer-logo">
              <a href="#"> <img src="{{asset('front_assets/img/nefold-front-logo.png')}}" alt="" /> </a>
            </div>
            <p>{{__('front.we_are_team')}}</p>
            <ul>
              <li>
                <span>{{__('front.address')}} : </span> Yerevan Norka 4th district 2 section Bakuntsa Street 13/2
                <br>Company TIN 25261067
              </li>
              <li>
                <span>{{__('front.phone')}}: </span> +374 11 66 50 00
                <br>+374 77 99 36 62
                <br>+374 99 99 36 62 (WhatsApp. Viber .WeChat)
              </li>
              <li>
                <span>{{__('front.email')}}:</span> <a href="#">info@nefold.com </a>
              </li>
            </ul>
            <ul class="footer-social">
              <li><a href="https://www.facebook.com/CDArmenia/"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-youtube"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="#"><i class="fa fa-flickr"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 hidden-sm col-xs-12 mar_b-30">
          <div class="footer-wrapper">
            <div class="footer-title">
              <a href="#">
                <h3>{{__('front.useful_links')}}</h3>
              </a>
            </div>
            <div class="footer-wrapper">
              <ul class="usefull-link">
                <li><a href="{!! route('home.index') !!}">{{__('front.home')}}</a></li>
                <li><a href="{!! route('home.shop') !!}">{{__('front.all_products')}}</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-3 hidden-md hidden-sm col-xs-12 mar_b-30">
          <div class="footer-wrapper">
            <div class="footer-title">
              <a href="#">
                <h3>{{__('front.useful_links')}}</h3>
              </a>
            </div>
            <div class="footer-wrapper">
              <ul class="usefull-link">
                <li><a href="{!! route('home.allservices') !!}">{{__('front.all_services')}}</a></li>
                <li><a href="{!! route('home.allcategory') !!}">{{__('front.all_categories')}}</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="footer-wrapper">
            <div class="footer-title">
              <a href="#">
                <h3>{{__('front.useful_links')}}</h3>
              </a>
            </div>
            <div class="footer-wrapper">
              <ul class="usefull-link">
                <li><a href="{!! route('home.contact') !!}">{{__('front.contact_us')}}</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- footer-area-end -->
  <!-- .copyright-area-start -->
  <div class="copyright-area copyright-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mar_b-30">
          <div class="copyright text-left">
            <p>{{now()->format('Y')}} {{__('front.all_rights_reserved')}} {{config('app.name')}} <a href="#"></a></p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="copyright-img text-right">
            <a href="#"><img src="{{asset('front_assets/img/payment.png')}}" alt="" /></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .copyright-area-end -->

  <!-- all js here -->
  <!-- jquery latest version -->
  <script src="{{asset('front_assets/js/vendor/jquery-1.12.0.min.js')}}"></script>
  <!-- bootstrap js -->
  <script src="{{asset('front_assets/js/bootstrap.min.js')}}"></script>
  <!-- owl.carousel js -->
  <script src="{{asset('front_assets/js/owl.carousel.min.js')}}"></script>
  <!-- meanmenu js -->
  <script src="{{asset('front_assets/js/jquery.meanmenu.js')}}"></script>
  <!-- jquery-ui js -->
  <script src="{{asset('front_assets/js/jquery-ui.min.js')}}"></script>
  <!-- wow js -->
  <script src="{{asset('front_assets/js/wow.min.js')}}"></script>
  <!-- scrolly js -->
  <script src="{{asset('front_assets/js/jquery.scrolly.js')}}"></script>
  <!-- magnific-popup js -->
  <script src="{{asset('front_assets/js/jquery.magnific-popup.min.js')}}"></script>
  <!--  countdown js -->
  <script src="{{asset('front_assets/js/jquery.countdown.min.js')}}"></script>
  <!-- nivo.slider js -->
  <script src="{{asset('front_assets/js/jquery.nivo.slider.js')}}"></script>
  <!-- plugins js -->
  <script src="{{asset('front_assets/js/plugins.js')}}"></script>
  <!-- main js -->
  <script src="{{asset('front_assets/js/main.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
  <script type="text/javascript">
    function dynamicCart(results){
				let cartHTML = "";
				let totalPrice = 0;
				let checkout = "";
				$("#cart_count").html(results.length);
				if (results.length > 0 ){
					for (let index = 0; index < results.length; index++) {
						const prd = results[index];
						totalPrice += prd.price;
						checkout = prd.checkout;
						cartHTML += '<li><div class="cart-img"><a href="'+prd.id+'"><img src="'+prd.image+'" alt="" /></a></div><div class="cart-content"><h4><a href="'+prd.url+'">1x '+prd.name+'</a></h4><span class="cart-price">$'+prd.price+'</span></div><div class="cart-del"><a onclick="removeFromCarT('+prd.cart_id+')" class="fa fa-times-circle"></a></div></li>';
					}
				}
				cartHTML += '<li class="total-price"><span> Total $'+totalPrice+' </span></li><li class="checkout-bg"><a href="'+checkout+'">checkout <i class="fa fa-angle-right"></i></a></li>';
				$("#cart_content_block").html(cartHTML);
			}
  </script>
  <script>
    function addToCart(id) {
          @if(Auth::check())
          var quantityInput = document.getElementById("french-hens");
          var quantity = 1;
          if (quantityInput) {
              quantity = quantityInput.value;
          }

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

    function removeFromCarT(key){
				$.post('{{ route('home.removeFromCart') }}',{_token:'{{ csrf_token() }}', id:key}, function(results){
				dynamicCart(results);
				})
				var x = document.getElementById("snackbarc");
				x.className = "show";
				setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
  </script>

  <script>
    // navbar control
			let selector = '.nav li';
	 
			$(selector).on('click', function(){
					$(selector).removeClass('active');
					$(this).addClass('active');
			});
			//collapsible
			var coll = document.getElementsByClassName("collapsible");
      var i;
      for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.display === "block") {
            content.style.display = "none";
          } else {
            content.style.display = "block";
          }
        });
      }
  </script>
  @yield('js_custom')
  @stack('js')
</body>
</html>
