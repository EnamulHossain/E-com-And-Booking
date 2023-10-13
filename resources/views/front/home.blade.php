@extends('front.layouts.base')
@section('content')
<!-- service-area-start -->
<!-- slider-area-start -->
<div class="product-slider-section ">
	@if(count($sliders) > 0)
	<div class="container">
		<div class="product-slider-images">
			@foreach ($sliders as $sld)
			@if(isset($sld) && $sld->hasMedia('image'))
			<img src="{!! url($sld->getFirstMediaUrl('image')) !!}" alt="" />
			@endif
			@endforeach
			{{-- TODO:get image from backend and remove below image --}}
			<img src="{{asset('front_assets/img/slider/main-slide-1.jpg')}}" alt="">
			<img src="{{asset('front_assets/img/slider/main-slide-2.jpg')}}" alt="">
			<img src="{{asset('front_assets/img/slider/main-slide-1.jpg')}}" alt="">
		</div>
	</div>
	@endif
</div>
</div>
<!-- slider-area-end -->
<section>
	<div class="container">
		<div class="row">
			<div class="text-center service-blog-header">
				<h3 class="custom-fonts">@lang('front.our_services')</h3>
			</div>
		</div>
		<div class="section-container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-lg-3 service-blog">
					<a href="{!! route('home.saloon') !!}">
						<div class="service-blog-card service-blog-odd">
							<div class="service-blog-body">
								<div class="mb-4">
									<i class="fa fa-scissors fa-4x" aria-hidden="true"></i>
								</div>
								<h4 class="service-heading">@lang('front.spa_or_saloon')</h4>
								<p class="service-short-details">@lang('front.spa_or_saloon_details')</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-lg-3 service-blog">
					<a href="{!! route('home.hotel') !!}">
						<div class="service-blog-card">
							<div class="service-blog-body">
								<div class="mb-4">
									<i class="fa fa-hotel fa-4x" aria-hidden="true"></i>
								</div>
								<h4 class="service-heading">@lang('front.hotel_and_guest_house')</h4>
								<p class="service-short-details">@lang('front.hotel_and_guest_house_details')</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-lg-3 service-blog">
					<a href="{!! route('home.underconstruction') !!}">
						<div class="service-blog-card service-blog-odd">
							<div class="service-blog-body">
								<div class="mb-4">
									<i class="fa fa-cutlery fa-4x" aria-hidden="true"></i>
								</div>
								<h4 class="service-heading">@lang('front.restaurant')</h4>
								<p class="service-short-details">
									@lang('front.your_staffs_clients_will_get_access_to_their_own_portal') </p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-lg-3 service-blog">
					<a href="{!! route('home.underconstruction') !!}">
						<div class="service-blog-card">
							<div class="service-blog-body">
								<div class="mb-4">
									<i class="fa fa-film fa-4x" aria-hidden="true"></i>
								</div>
								<h4 class="service-heading">@lang('front.entertainment')</h4>
								<p class="service-short-details">
									@lang('front.accept_online_offline_payments_from_your_clients') </p>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- recommended services -->
<div class="new-product-area hot-deal-area dotted-5 new-product-4 pt-80">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 rmv-next-prev">
				<div class="section-title section-title-4">
					<h2>@lang('front.recommended_services')</h2>
					<a class="link-a" href="{!! route('home.allservices') !!}">@lang('front.view_all')</a>
				</div>
				<div class="row">
					<div class="new-product-home-4-active">
						@foreach ($recommendedServices as $svc)
						<div class="col-lg-12 card-container">
							<div class="card">
								<a href="{!! route('saloon.booking', $svc->id) !!}">
									@if(isset($svc) && $svc->hasMedia('image'))
									<img src="{!! url($svc->getFirstMediaUrl('image')) !!}" alt="" />
									@endif
								</a>
								<div class="card-body">
									<a href="{!! route('saloon.booking', $svc->id) !!}" class="">
										<h4 class="card-title">{{$svc->name}}</h4>
									</a>
									<div class="card-description">
										<p>{{$svc->description}}</p>
									</div>
									<div class="card-footer">
										<div class="service-price">@lang('front.starts_from') &nbsp;<h4>
												{!! getPriceColumn($svc) !!}/</h4>@lang('front.hourly')</div>
										<div>
											<a
												href="{!! route('saloon.booking', $svc->id) !!}">@lang('front.details')</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="single-static-banner static-banner-area">
							<div class="single-static-img">
								<a href="{!! route('home.underconstruction') !!}">
									{{-- TODO:get image from backend --}}
									<img src="{{asset('front_assets/img/static/8.jpg')}}" alt="" />
								</a>
								<div class="single-static-text single-static-text-4">
									<h3>@lang('front.beauty_and_spa_salon')</h3>
									<span>@lang('front.beauty_and_spa_salon_details')</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--featured categories-->
<div class="new-product-area hot-deal-area dotted-5 new-product-4 ptb-50">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title section-title-4 section_4">
					<h2>@lang('front.services_categories')</h2>
					<a class="link-a" href="{!! route('home.allcategory') !!}">@lang('front.view_all')</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="new-product-home-2-active rmv-next-prev">
				@foreach ($featureCategories as $cat)
				<div class="col-lg-12">
					<a href="{!! route('home.allservices', $cat->id) !!}">
						<div class="feat-card" style="width: 17rem;">
							@if(isset($cat) && $cat->hasMedia('image'))
							<img src="{!! url($cat->getFirstMediaUrl('image')) !!}" alt="" />
							@endif
							<div class="feat-card-body">
								<h4 class="feat-card-title">{{$cat->name}}</h4>
								<p class="feat-card-text card-text-ellipsis">
									@php
									$taglessBody = strip_tags($cat->description)
									@endphp
									{{$taglessBody}}</p>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<!--new products start-->
<div class="new-product-area hot-deal-area dotted-5 new-product-4 ptb-50">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title section-title-4 section_4">
					<h2>@lang('front.new_products')</h2>
					<a class="link-a" href="{!! route('home.shop') !!}">@lang('front.view_all')</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="new-product-home-2-active rmv-next-prev">
				@foreach ($newProducts as $prd)
				<div class="col-lg-12">
					<div class="single-new-product">
						<div class="product-img" style="width: 200px; height: 200px; overflow: hidden;">
							<a href="{!! route('home.productdetails', $prd->id) !!}" style="display: block; width: 100%; height: 100%;">
								@if(isset($prd) && $prd->hasMedia('image'))
									<img src="{!! url($prd->getFirstMediaUrl('image')) !!}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
								@endif
							</a>
						</div>
						<div class="product-content text-center">
							<a href="{!! route('home.productdetails', $prd->id) !!}">
								<h3>{{ $prd->name }}</h3>
							</a>
							<div class="product-price-star">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
							</div>
							<div class="price">
								<h4>{!! getPriceColumn($prd, 'offer_price') !!}</h4>
								<h3 class="del-price"><del>{!! getPriceColumn($prd) !!}</del></h3>
							</div>
						</div>
						<div class="product-icon-wrapper">
							<div class="product-icon">
								<ul>
									<li><a href="#"><span class="lnr lnr-sync"></span></a></li>
									<li><a href="javascript:void(0)" onclick="addToWishList({{$prd->id}})"><span class="lnr lnr-heart"></span></a></li>
									<li><a href="javascript:void(0)" onclick="addToCart({{$prd->id}})"><span class="lnr lnr-cart"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>				
				@endforeach
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="single-static-banner static-banner-area">
					<div class="single-static-img">
						<a href="{!! route('home.underconstruction') !!}">
							<img src="{{asset('front_assets/img/static/2.jpg')}}" alt="" />
						</a>
						<div class="single-static-text single-static-text-4">
							<h3>@lang('front.the_perfect_finishing_touch_for_the_perfect_look') </h3>
							<span>@lang('front.the_perfect_finishing_touch_for_the_perfect_look_details')</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--featured products-->
<div class="new-product-area hot-deal-area dotted-5 new-product-4 ptb-50">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title section-title-4 section_4">
					<h2>@lang('front.featured_products')</h2>
					<a class="link-a" href="{!! route('home.shop') !!}">@lang('front.view_all')</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="new-product-home-2-active rmv-next-prev">
				@foreach ($featureProducts as $fprd)
				<div class="col-lg-12">
					<div class="single-new-product">
						<div class="product-img" style="width: 200px; height: 200px; overflow: hidden;">
							<a href="{!! route('home.productdetails', $fprd->id) !!}" style="display: block; width: 100%; height: 100%;">
								<div style="position: relative; width: 100%; height: 100%;">
									<div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center;">
										@if(isset($fprd) && $fprd->hasMedia('image'))
											<img src="{!! url($fprd->getFirstMediaUrl('image')) !!}" alt="" style="max-width: 100%; max-height: 100%; object-fit: cover;">
										@else
											<div style="width: 100%; height: 100%; background-color: #ccc;"></div>
										@endif
									</div>
								</div>
							</a>
						</div>
						<div class="product-content text-center">
							<a href="{!! route('home.productdetails', $fprd->id) !!}">
								<h3>{{ $fprd->name }}</h3>
							</a>
							<div class="product-price-star">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
							</div>
							<div class="price">
								<h4>{!! getPriceColumn($fprd, 'offer_price') !!}</h4>
								<h3 class="del-price"><del>{!! getPriceColumn($fprd) !!}</del></h3>
							</div>
						</div>
						<div class="product-icon-wrapper">
							<div class="product-icon">
								<ul>
									<li><a href="javascript:void(0)"><span class="lnr lnr-sync"></span></a></li>
									<li><a href="javascript:void(0)" onclick="addToWishList({{$fprd->id}})"><span
												class="lnr lnr-heart"></span></a></li>
									<li><a href="javascript:void(0)" onclick="addToCart({{$fprd->id}})"><span
												class="lnr lnr-cart"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<!-- static-slider-area-start -->
<div class="static-slider-area dotted-style new-product-4 pb-80 hidden-xs">
	<div class="static-slider-active">
		<div class="static-single-slider">
			<div class="static-slider-img">
				<img src="{{asset('front_assets/img/slider/slide1.jpg')}}" alt="">
			</div>
			<!-- <div class="static-slider-text">
				<h2>Chairs & Chaises</h2>
				<h1>Ethen Accent Chair - Laguna</h1>
				<p>Vacation at Home. With its dashingly refined good looks, the Ethen accent chair is <br /> perfectly suited for any room that can use a dose of vibrant colour. Tight-back upholstery <br /> from top to bottom gives the chair.</p>
				<a href="bedroom.html" class="shopnow">shop now</a>
			</div> -->
		</div>
		<div class="static-single-slider">
			<div class="static-slider-img">
				<img src="{{asset('front_assets/img/slider/slide2.jpg')}}" alt="">
			</div>
		</div>
		<div class="static-single-slider">
			<div class="static-slider-img">
				<img src="{{asset('front_assets/img/slider/slide3.jpg')}}" alt="">
			</div>
		</div>
	</div>
</div>
<!-- sale products start -->
<div class="feature-preduct-area home-page-2 feature-product-4 dotted-5 new-product-4 hot-deal-area  pb-50">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title hot-deal-title sale-4 section-title-4">
					<h2>@lang('front.sale_products')</h2>
					<a class="link-a" href="{!! route('home.shop') !!}">@lang('front.view_all')</a>
				</div>
			</div>
			<div class="col-lg-12 col-md-12">
				<div class="feature-home-2-active feature-home-4-active rmv-next-prev">
					@foreach ($featureProducts as $fprd)
					<div class="single-product-items">
						<div class="single-new-product">
							{{-- <div class="product-img" >
								<a href="{!! route('home.productdetails', $fprd->id) !!}">
									@if(isset($fprd) && $fprd->hasMedia('image'))
									<img src="{!! url($fprd->getFirstMediaUrl('image')) !!}" alt="" style="max-width: 200px; max-height: 200px;" />
									@endif
								</a>
							</div> --}}

							<div class="product-img" style="width: 200px; height: 200px; overflow: hidden;">
								<a href="{!! route('home.productdetails', $fprd->id) !!}" style="display: block; width: 100%; height: 100%;">
									<div style="position: relative; width: 100%; height: 100%;">
										<div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center;">
											@if(isset($fprd) && $fprd->hasMedia('image'))
												<img src="{!! url($fprd->getFirstMediaUrl('image')) !!}" alt="" style="max-width: 100%; max-height: 100%; object-fit: cover;">
											@else
												<div style="width: 100%; height: 100%; background-color: #ccc;"></div>
											@endif
										</div>
									</div>
								</a>
							</div>
							
							

							
							<div class="product-content text-center">
								<a href="{!! route('home.productdetails', $fprd->id) !!}">
									<h3>{{$fprd->name}}</h3>
								</a>
								<div class="product-price-star">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<h4>{!! getPriceColumn($fprd, 'offer_price') !!}</h4>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="">
					<div class="single-static-banner">
						<div class="single-static-img">
							<a href="{!! route('home.underconstruction') !!}">
								<img src="{{asset('front_assets/img/static/7.jpg')}}" alt="">
							</a>
							<div class="single-static-text single-static-text-4">
								<h3>@lang('front.the_best_thing_you_can_do_for_beauty')</h3>
								<span class="set-w">@lang('front.the_best_thing_you_can_do_for_beauty_details')</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="col-lg-3 col-md-3 hidden-sm">
				<div class="single-banner mar_b-30">
					<a href="{!! route('home.underconstruction') !!}">
						<img src="{{asset('front_assets/img/banner/12.jpg')}}" alt="" />
					</a>
				</div>				
			</div> -->
		</div>
	</div>
</div>
<div id="snackbar">@lang('front.added_item_to_wishlist')</div>
<div id="snackbarCart">@lang('front.added_item_to_cart')</div>
<div id="mustlogin">@lang('front.please_login_to_add_to_cart')</div>
<div id="mustloginWish">@lang('front.please_login_to_add_item_to_wish_list')</div>
<!-- sale products end -->
@endsection
@section('js_custom')
<script>
	$(document).ready(function(){
		$('.product-slider-images').bxSlider({
			mode: 'fade',
			auto: true,
			pause: 4000,
			speed: 900,
			keyboardEnabled: true,
			pager: false,
		});
	});
</script>
<script>
	function addToWishList(id){
		@if(Auth::check())
		$.post('{{ route('home.storewishlist') }}',{_token:'{{ csrf_token() }}', id:id})
		var x = document.getElementById("snackbar");
		x.className = "show";
		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		@else
			var x = document.getElementById("mustloginWish");
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		@endif
	}
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
@endsection
