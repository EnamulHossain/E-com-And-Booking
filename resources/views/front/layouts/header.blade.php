<header>
	<div class="header-top-area ptb-10 hidden-xs header-top-area-4">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-5">
					<div class="header-top-right header-top-left-4">
						<p>{{__('front.free_shipping_on_orders_over')}}</p>
					</div>
				</div>
				<div class="col-lg-9 col-md-8 col-sm-7 header-top-right-4">
					<div class="header-top-left">
						<ul>
							<li class="click_lang">
								<a href="#">
									@isset(getAvailableLanguages()[app()->getLocale()])
									{{getAvailableLanguages()[app()->getLocale()]}} <i class="fa fa-angle-down"></i>
									@endisset
								</a>
								<ul class="click_lang_show">
									@foreach(getAvailableLanguages() as $code => $lang)

									@if(app()->getLocale() != $code)
										<li>
											<form action="{{route('set_language')}}" id="languages-form-front" method="post">
												@csrf
												<input type="hidden" id="current-language" name="lang">

												<a href="#"
												class="dropdown-item @if(setting('language') == $code) active @endif"
												onclick="changeLanguage('{{$code}}')">
												<i class="fas fa-circle mr-2"></i> {!! __($lang) !!}
											</a>
											</form>
										</li>
									@endif
									@endforeach

								</ul>
							</li>
							<li class="click_menu"><a href="#"> {{__('front.my_account')}} <i
										class="fa fa-angle-down"></i></a>
								<ul class="click_menu_show">
									@if(Auth::check())
									<li><a href="{!! route('home.useraccount') !!}">{{ __('front.my_account')}}</a></li>
									<li><a href="{!! route('home.wishlist') !!}">{{__('front.my_wish_list')}}</a></li>
									<li><a href="{!! url('/logout') !!}"
											onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
											{{__('auth.logout')}}</a></li>
									<form id="logout-form" action="{{ url('/logout') }}" method="POST"
										style="display: none;">
										{{ csrf_field() }}
									</form>
									@else
									<li><a href="{!! route('home.cuslogin') !!}">{{ __('front.my_account')}}</a></li>
									<li><a href="{!! route('home.wishlist') !!}">{{__('front.my_wish_list')}}</a></li>
									<li><a href="{!! route('home.cuslogin') !!}">{{__('front.sign_in')}}</a></li>
									@endif
								</ul>
							</li>
							@if(Auth::check())
							<li>
								<p>Hi {!! auth()->user()->name !!}</p>
							</li>
							@else
							<li><a href="{!! route('front.regestration') !!}">{{__('front.create_an_account')}}</a></li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-bottom-area home-page-2 ptb-10">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="menu-search-box scnd-fix">
						<form action="#">
							<input type="text" placeholder="@lang('front.search_here')" />
							<button><span class="lnr lnr-magnifier"></span></button>
						</form>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="logo logo2">
						<a href="{!! route('home.index') !!}">
							<img src="{{asset('front_assets/img/nefold-front-logo.png')}}" alt="" />
							{{-- <h3>NeFold</h3> --}}
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">
					<div class="header-bottom-right-4-inner">
						<!-- <a href="#"><span class="lnr lnr-heart"></span></a> -->
					</div>
					<div class="header-bottom-right header-bottom-right-4 front-header-right">
						<div class="shop-cart shop-cart-4">
							<a href="#">
								<span class="lnr lnr-cart">
									<span id="cart_count" class="cart_count">
										<?php echo count($carts); ?>
									</span>
								</span>
							</a>
						</div>
						@php
						$total = 0;
						@endphp
						<div class="shop-cart-hover shop-cart-hover-4 fix">
							<ul id="cart_content_block">
								@foreach ($carts as $cart)
								@php
								$total = $total + ($cart['new_price']) * $cart['quantity'];
								@endphp
								<li>
									<div class="cart-img">
										<a href="#"><img src="{{asset('front_assets/img/cart/1.jpg')}}" alt="" /></a>
									</div>
									<div class="cart-content">
										<h4><a href="#">{{$cart->quantity}}x {{$cart->product->name}}</a></h4>
										<span><a href="#">S, Orange</a></span>
										<span class="cart-price">${{$cart->new_price}}</span>
									</div>
									<div class="cart-del">
										<a onclick="removeFromCarT({{ $cart->id}})"
											class="fa fa-times-circle"></a>
									</div>
								</li>
								@endforeach
								<li class="total-price"><span> {{__('front.total')}} ${{$total}} </span></li>
								<li class="checkout-bg">
									<a href="{!! route('home.checkout') !!}">{{__('front.checkout')}} <i
											class="fa fa-angle-right"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="snackbarc">{{__('front.item_removed_successfully')}}</div>
</header>
<!-- header-end -->

@push('js')
	<script>
		function changeLanguage(code) {
			event.preventDefault();
			document.getElementById('current-language').value = code;
			document.getElementById('languages-form-front').submit();
		}
	</script>
@endpush