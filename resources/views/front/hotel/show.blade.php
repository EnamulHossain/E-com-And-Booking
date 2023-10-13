@extends('front.layouts.base')
@section('content')
<style>
    .service-p {
        display: block;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 280px;
        margin-bottom: 4px;
        word-break: break-word;
        overflow: hidden;
        padding-right: 20px;
    }
</style>
<div style="padding: 0px 140px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <!-- Carousel container -->
                <div id="my-pics" class="carousel slide" style="height: 400px; overflow: hidden; margin-top: 10px;"
                    data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        {!! $hotel->getMediaindicators("my-pics") !!}
                    </ol>
                    <!-- Content -->
                    <div class="carousel-inner" role="listbox">
                        {!! $hotel->getMediaListBox() !!}
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
                    <div class="col-sm-11">
                        <h1>{{$hotel->name ?? ""}}</h1>
                        <p class="text-gray">@lang('front.address'): {{$hotel->address->address ?? ""}}</p>
                    </div>
                    <div class="col-sm-1 text-right" style="margin-top: 25px;">
                        <i class="fa-regular fa-2xl fa-heart text-gray fa"></i>
                    </div>
                </div>
                <!-- search bar -->
                <div class="row">
                    <div class="col-sm-6">
                        <h3>@lang('front.services')</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        <input type="search" placeholder="@lang('search_for_service')">
                    </div>
                </div>
                <!-- each service -->
                <div class="container">
                    <div class="row">
                      @foreach($hotel_rooms as $service)
                        <div class="col-md-4 mb-4" style="margin-top: 20px">
                          <div class="card h-100" style="height: 400px;">
                            <!-- Hotel Room Image -->
                            <div class="card-body">
                              <!-- Hotel Room Description -->
                              <p class="card-text">{{$service->description}}</p>
                              <!-- Hotel Room Price -->
                              <h6 class="" style="margin-top: 200px">${{$service->price}} per night</h6><br>
                              <label for="">Rooms</label>
                              <input type="number" id="quantity" name="quantity" min="1" max="10" step="1" value="1">
                              <br>
                              <!-- Checkout Button -->
                              <a href="{{route('hotel.booking', $service->id)}}" class="btn btn-primary" style="background-color: #FF731D; margin-top: 10px;">Checkout</a>
                              {{-- <a href="javascript:void(0)" onclick="addToCart({{$service->id}})"><span
                                class="lnr lnr-cart cart_pad"></span>Add to Cart</a> --}}
                            </div>
                            </div>
                        </div>

                        @if($loop->iteration % 3 == 0)
                          <div class="w-100"></div><!-- Add a new row after every 3rd element -->
                        @endif
                        
                      @endforeach
                    </div>
                </div>
                  
                  
                
                <!-- Services card -->
                <div class="row">
                    <div class="col-sm-12">
                        
                    </div>
                </div>
                <div class="row" style="margin-top: 50px">
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
                                    <h2 class="bold padding-bottom-7">{{$hotel->rate}} <small>/ 5</small></h2>
                                    {!! $hotel->getRatingView() !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h4>@lang('front.rating_breakdown')</h4>
                                <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">5 <span><i
                                                    class="fa-solid fa-star fa"></i></span></div>
                                    </div>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                aria-valuenow="5" aria-valuemin="0" aria-valuemax="5"
                                                style="width: 1000%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right" style="margin-left:10px;">1</div>
                                </div>
                                <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">4 <span><i
                                                    class="fa-solid fa-star fa"></i></span></div>
                                    </div>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                            <div class="progress-bar progress-bar-primary" role="progressbar"
                                                aria-valuenow="4" aria-valuemin="0" aria-valuemax="5"
                                                style="width: 80%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right" style="margin-left:10px;">1</div>
                                </div>
                                <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">3 <span><i
                                                    class="fa-solid fa-star fa"></i></span></div>
                                    </div>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                            <div class="progress-bar progress-bar-info" role="progressbar"
                                                aria-valuenow="3" aria-valuemin="0" aria-valuemax="5"
                                                style="width: 60%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right" style="margin-left:10px;">0</div>
                                </div>
                                <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">2 <span><i
                                                    class="fa-solid fa-star fa"></i></span></div>
                                    </div>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                aria-valuenow="2" aria-valuemin="0" aria-valuemax="5"
                                                style="width: 40%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right" style="margin-left:10px;">0</div>
                                </div>
                                <div class="pull-left">
                                    <div class="pull-left" style="width:35px; line-height:1;">
                                        <div style="height:9px; margin:5px 0;">1 <span><i
                                                    class="fa-solid fa-star fa"></i></span></div>
                                    </div>
                                    <div class="pull-left" style="width:180px;">
                                        <div class="progress" style="height:9px; margin:8px 0;">
                                            <div class="progress-bar progress-bar-danger" role="progressbar"
                                                aria-valuenow="1" aria-valuemin="0" aria-valuemax="5"
                                                style="width: 20%">
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
                                            <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image"
                                                class="img-rounded">
                                            <div class="review-block-name"><a href="#">nktailor</a></div>
                                            <div class="review-block-date">January 29, 2016<br />1 day ago</div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="review-block-rate">
                                                <button type="button" class="btn btn-warning btn-xs"
                                                    aria-label="Left Align">
                                                    <span><i class="fa-solid fa-star fa"></i></span>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-xs"
                                                    aria-label="Left Align">
                                                    <span><i class="fa-solid fa-star fa"></i></span>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-xs"
                                                    aria-label="Left Align">
                                                    <span><i class="fa-solid fa-star fa"></i></span>
                                                </button>
                                                <button type="button" class="btn btn-default btn-grey btn-xs"
                                                    aria-label="Left Align">
                                                    <span><i class="fa-solid fa-star fa"></i></span>
                                                </button>
                                                <button type="button" class="btn btn-default btn-grey btn-xs"
                                                    aria-label="Left Align">
                                                    <span><i class="fa-solid fa-star fa"></i></span>
                                                </button>
                                            </div>
                                            <div class="review-block-title">this was nice in buy</div>
                                            <div class="review-block-description">this was nice in buy. this was nice in
                                                buy. this was nice in buy. this was nice in buy this was nice in buy
                                                this was nice in buy this was nice in buy this was nice in buy</div>
                                        </div>
                                    </div>
                                    <hr />
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
                            {{$hotel->phone_number ?? ""}}
                        </div>
                        <div class="col-sm-4" style="padding-top:15px;">
                            <a href="tel:{{$hotel->phone_number ?? ""}}"
                                style="border: 1px solid #ccc; border-radius:5px; padding:8px 20px;">call</a>
                        </div>
                    </div>
                    <h4 style="padding-top: 16px">@lang('front.availablity')</h4>

                    @isset($hotel->availabilityHours)
                    @foreach($hotel->availabilityHours as $availabilityHours)
                    <div class="row" style="padding-bottom: 5px; padding-top:16px;">
                        <div class="col-sm-6">
                            {{ Str::ucfirst($availabilityHours->day) ?? "" }}
                        </div>
                        <div class="col-sm-6 bold-font">
                            @if($availabilityHours->start_at && $availabilityHours->end_at)
                            {{$availabilityHours->start_at}} - {{$availabilityHours->end_at}}
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @endisset

                    

                    <div class="row" style="margin-top: 10px;">
                        <p style="border-left: 2px solid gray; padding: 10px;">
                            {!! $hotel->description ?? "" !!}
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 border-top"
                            style="border-bottom: 1px solid #CCCCCC; padding-bottom: 10px;">
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
                                                <label class="custom-control-label" for="defaultUnchecked">Default
                                                    unchecked</label>
                                            </div>

                                            <!-- Default checked -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="defaultChecked"
                                                    name="defaultExampleRadios" checked>
                                                <label class="custom-control-label" for="defaultChecked">Default
                                                    checked</label>
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
</div>
{{-- <div id="snackbar">@lang('front.added_item_to_wishlist')</div> --}}
{{-- <div id="snackbarCart">@lang('front.added_item_to_cart')</div> --}}
{{-- <div id="mustlogin">@lang('front.please_login_to_add_to_cart')</div> --}}
@endsection


@section('js_custom')
<script>
	function addToCart(id){
		@if(Auth::check())
			$.post('{{ route('home.hotelstorecart') }}',{_token:'{{ csrf_token() }}', id:id}, function(results){
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