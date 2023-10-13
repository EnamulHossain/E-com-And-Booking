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
                        {!! $saloon->getMediaindicators("my-pics") !!}
                    </ol>
                    <!-- Content -->
                    <div class="carousel-inner" role="listbox">
                        {!! $saloon->getMediaListBox() !!}
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
                        <h1>{{$saloon->name ?? ""}}</h1>
                        <p class="text-gray">@lang('front.address'): {{$saloon->address->address ?? ""}}</p>
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
                <!-- Services card -->
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="collapsible service-button text-left bold"
                            style="width: 100%; font-size: large; display: flex; justify-content: space-between; margin: 20px 0px;">@lang('front.popular_services')<span><i
                                    class="fa-light fa-chevron-right fa"></i></span></button>
                        <div class="row content">
                            <!-- each service -->
                            @isset($saloon->eServices)
                            @foreach($saloon->eServices as $key => $service)
                            <div class="border-bottom" style="padding: 10px; margin-bottom: 10px;">
                                <div class="row">
                                    <div class="col-sm-6 text-lg">
                                        <span>{!! $service->name !!}</span>
                                        <p class="service-p">{!! $service->description !!}</p>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <div class="col-sm-10">
                                            <div class="bold">{!! getPriceColumn($service) !!}</div>
                                            <div class="text-gray"> {{ $service->duration }} </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <a class="btn btn-primary" href="{{route('saloon.booking', $service->id)}}">
                                                @lang('front.book') </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
                <!-- image galary -->
                {{-- <div class="row">
                    <h3 style="padding-bottom: 10px; padding-left:14px;">@lang('front.see_our_work')</h3>
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="{{asset('front_assets/img/single-saloon/gallray.jpg')}}" target="_blank">
                        </div>
                    </div>
                </div> --}}
                <!-- comment card -->
                <!-- comment card -->
                <div class="row">
                    @foreach ($salonreview as $sr )
                    
                    <div class="container" style="margin: 10px 0px 0px 0px;">
                        <div class="row">
                            <div class="col-sm-10">
                                <hr />
                                <div class="review-block">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image"
                                                class="img-rounded">
                                            <div class="review-block-name"><a href="#">{{$sr->name}}</a></div>
                                            <div class="review-block-date">{{$sr->created_at}}<br />1 day ago</div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="review-block-rate">
                                            @php
                                                // Calculate the number of filled stars based on the rate value
                                                $filledStars = min(5, max(0, floor($sr->rate)));
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
                                            <div class="review-block-description">{{$sr->review}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    @endforeach
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
                            {{$saloon->phone_number ?? ""}}
                        </div>
                        <div class="col-sm-4" style="padding-top:15px;">
                            <a href="tel:{{$saloon->phone_number ?? ""}}"
                                style="border: 1px solid #ccc; border-radius:5px; padding:8px 20px;">call</a>
                        </div>
                    </div>
                    <h4 style="padding-top: 16px">@lang('front.availablity')</h4>

                    @isset($saloon->availabilityHours)
                    @foreach($saloon->availabilityHours as $availabilityHours)
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

                    {{-- <div class="row" style="padding-bottom: 5px; padding-top:16px;">


                        <div class="col-sm-6">
                            {{ $saloon->availabilityHours }}Sunday
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
                    </div> --}}

                    <div class="row" style="margin-top: 10px;">
                        <p style="border-left: 2px solid gray; padding: 10px;">
                            {!! $saloon->description ?? "" !!}
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
@endsection
