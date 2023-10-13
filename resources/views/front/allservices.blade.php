@extends('front.layouts.base')
@section('content')
<section>
	<div class="row text-center all-header"
		style="background: rgba(0, 0, 0, 0) url('{{asset('front_assets/img/bg/contuct.webp')}}') no-repeat scroll center center / cover ;">
		<div class="col-12">
			@if ($categoryName != '')
			<h3 class="color-wh">{{$categoryName}}</h3>
			@else
			<h3 class="color-wh">{{__('front.browse_all_services')}}</h3>
			@endif
			@if ($categoryDescription != '')
			<p class="color-wh">{!! $categoryDescription !!}</p>
			@else
			<p class="color-wh">{{__('front.get_your_suitable_service')}}</p>
			@endif
		</div>
		<form action="#" method="post" class="search-container">
			<div class="search-area col-md-4">
				<input type="text" name="search" id="">
				<button type="submit">{{__('front.search')}}</button>
			</div>
		</form>
	</div>
	<div class="container">
		<div class="row category-row all-service-4-active">
			<!-- TODO: need to remove inner after add dynamic Data -->
			@foreach ($allServices as $svc)
			<div class="col-sm-6 col-lg-4 card-container">
				<div class="card">
					<a href="{!! route('saloon.booking', $svc->id) !!}">
						@if(isset($svc) && $svc->hasMedia('image'))
						<img src="{!! url($svc->getFirstMediaUrl('image')) !!}" alt="" />
						@endif
						{{-- <img src="{{asset('front_assets/img/banner/ads-middle-grand4.jpg')}}" alt="" /> --}}
					</a>
					<div class="card-body">
						<a href="{!! route('saloon.booking', $svc->id) !!}" class="">
							<h4 class="card-title">{{$svc->name}}</h4>
						</a>
						<div class="card-description">
							<p>{{$svc->description}}</p>
						</div>
						<div class="card-footer">
							<div class="service-price">{{__('front.starts_from')}} &nbsp;<h4>{!! getPriceColumn($svc) !!}/</h4>
								{{__('front.hourly')}}</div>
							<a href="{!! route('saloon.booking', $svc->id) !!}">{{__('front.details')}}</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<!-- TODO: need to remove inner after add dynamic Data -->
		</div>
	</div>
</section>
@endsection
