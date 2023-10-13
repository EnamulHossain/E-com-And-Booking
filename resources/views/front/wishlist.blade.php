@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="page-title">
					<h3>@lang('front.wishlist')</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- page-title-wrapper-end -->
<!-- wishlist-area start -->
<div class="wishlist-area pt-80 pb-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="wishlist-content">
					<form action="#">
						<div class="wishlist-title">
							<h2>@lang('front.my_wishlist')</h2>
						</div>
						<div class="wishlist-table table-responsive">
							<table>
								<thead>
									<tr>
										<th class="product-remove"><span class="nobr">@lang('remove')</span></th>
										<th class="product-thumbnail">@lang('front.image')</th>
										<th class="product-name"><span class="nobr">@lang('front.product_name')</span>
										</th>
										<th class="product-price"><span class="nobr"> @lang('front.unit_price') </span>
										</th>
										<th class="product-stock-stauts"><span
												class="nobr">@lang('front.stock_status')</span></th>
										<th class="product-add-to-cart"><span
												class="nobr">@lang('front.add_to_cart')</span></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($wishlist as $wsl)
									<tr>
										<td class="product-remove"><a
												onclick="removeFromWishlist({{ $wsl['id'] }})">x</a></td>
										<td class="product-thumbnail"><a
												href="{!! route('home.productdetails', $wsl->product->id) !!}">@if(isset($wsl)
												&& $wsl->product->hasMedia('image'))
												<img src="{!! url($wsl->product->getFirstMediaUrl('image')) !!}"
													alt="" />
												@endif</a></td>
										<td class="product-name"><a
												href="{!! route('home.productdetails', $wsl->product->id) !!}">{{$wsl->product->name}}</a>
										</td>
										<td class="product-price"><span class="amount">{!! getPrice($wsl->product->price) !!}</span>
										</td>
										<td class="product-stock-status"><span
												class="wishlist-in-stock">@lang('front.in_stock')</span></td>
										<td class="product-add-to-cart"><a href="#">@lang('front.add_to_cart')</a></td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<td colspan="6">
											<div class="wishlist-share">
												<h4 class="wishlist-share-title">@lang('front.share_on'):</h4>
												<ul>
													<li><a class="facebook" href="#"></a></li>
													<li><a class="twitter" href="#"></a></li>
													<li><a class="pinterest" href="#"></a></li>
													<li><a class="googleplus" href="#"></a></li>
													<li><a class="email" href="#"></a></li>
												</ul>
											</div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="snackbar">@lang('front.item_removed_successfully')</div>
<!-- wishlist-area end -->
@endsection
@section('js_custom')
<script>
	function removeFromWishlist(key){
     $.post('{{ route('home.removeFromWishlist') }}',{_token:'{{ csrf_token() }}', id:key})
     var x = document.getElementById("snackbar");
     x.className = "show";
     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
 }
</script>
@endsection
