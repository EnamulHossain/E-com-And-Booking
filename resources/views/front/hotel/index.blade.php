@extends('front.layouts.base')
@section('content')
<!-- header and search -->
<section style="background-image: url({{asset('front_assets/img/about/2.jpg')}}); min-height: 50%">
    <div class="text-center all-header">
        <div class="service-header-title">
            <h3 class="custom-fonts bro-clr">Search Available Hotel</h3>
            {{-- <p class="bro-clr">@lang('front.get_your_suitable_service')</p> --}}
        </div>
        <form action="#" method="post" class="search-container">
            <div class="d-flex">
                <div class="flex form-group mr-2">
                  <input type="text" class="form-control" placeholder="Where to go?" name="location">
                </div>
                <div class="form-group mr-2">
                  <input type="date" class="form-control" placeholder="Start Date" name="start_date">
                </div>
                <div class="form-group mr-2">
                  <input type="date" class="form-control" placeholder="End Date" name="end_date">
                </div>
            
                <div class="form-group mr-2">
                <input type="number" class="form-" placeholder="Number of Adults" name="adults">
                  <input type="number" class="form-" placeholder="Number of Children" name="child">
                  <input type="number" class="form-" placeholder="Number of Rooms" name="room">
                </div>
                <div class="form-group">
                  {{-- <button type="submit" class="btn btn-primary">Search</button> --}}
                </div>
              </div>
        </form>
        <a class="link-a" href="{!! route('hotel.all') !!}">Search</a>
    </div>
</section>
<!-- recommended hotel -->
<div class="new-product-area hot-deal-area dotted-5 new-product-4 pt-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 rmv-next-prev">
                <div class="section-title section-title-4">
                    <h2>@lang('front.recommended_hotels')</h2>
                    <a class="link-a" href="{!! route('hotel.all') !!}">@lang('front.view_all')</a>
                </div>
                <div class="row">
                    <div class="new-product-home-4-active">
                        @foreach ($hotels as $sln)
                        <div class="col-lg-12 card-container">
                            <div class="card" style="width: 400px;>
                                <a href="{!! route('hotel.show', $sln->id) !!}">
                                    @if(isset($sln) && $sln->hasMedia('image'))
                                    <img src="{!! url($sln->getFirstMediaUrl('image')) !!}" alt=""/>
                                    @endif
                                </a>
                                <div class="card-body">
                                    <a href="{!! route('hotel.show', $sln->id) !!}" class="">
                                        <h4 class="card-title">{{$sln->name}}</h4>
                                    </a>
                                    <div class="card-footer">
                                        <div class="service-level">{{$sln->hotelLevel->name ?? ""}}</div>
                                        <div class="service-rating" >
                                            {{$sln->getRatingView()}}
                                        </div>
                                        <div>
                                            <a href="{!! route('hotel.show', $sln->id) !!}">@lang('front.details')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- recommended services -->
<div class="new-product-area hot-deal-area dotted-5 new-product-4 pt-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 rmv-next-prev">
                <div class="section-title section-title-4">
                    <h2>Recommended Hotels</h2>
                    <a class="link-a" href="{!! route('hotel.all') !!}">@lang('front.view_all')</a>
                </div>
                <div class="row">
                    <div class="new-product-home-4-active">
                        @foreach ($hotels as $svc)
                        <div class="col-lg-12 card-container">
                            <div class="card" style="width: 400px;>
                                <a href="{!! route('hotel.show', $svc->id) !!}">
                                    @if(isset($svc) && $svc->hasMedia('image'))
                                    <img src="{!! url($svc->getFirstMediaUrl('image')) !!}" alt="" />
                                    @endif
                                </a>
                                <div class="card-body">
                                    <a href="{!! route('hotel.show', $svc->id) !!}" class="">
                                        <h4 class="card-title">{{$svc->name}}</h4>
                                    </a>
                                    <div class="card-footer">
                                        <div class="service-level">{{$svc->hotelLevel->name ?? ""}}</div> 
                                        
                                        <div>
                                            <a
                                                href="{!! route('hotel.show', $svc->id) !!}">@lang('front.details')</a>
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
                                    <img src="{{asset('front_assets/img/static/12.jpg')}}" alt="" />
                                </a>
                                <div class="single-static-text single-static-text-4">
                                    <h3>Hotel</h3>
                                    <span>Hotel Details</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <section id="welcome">
    <div class="container pt-80 pb-80">
        <div class="section-content">
            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="p-60 pt-40 pb-40 open-hours-sec"
                        style="background-image: url({{asset('front_assets/img/about/2.jpg')}});">
                        <h3 class="text-theme-colored text-uppercase letter-space-1">Opening Hours! <br><span
                                class="text-white">Check Our Class Here</span></h3>
                        <div class="item-html divider">
                            <ul class="list-unstyled text-uppercase text-white mb-20">
                                <li class="opening-day"> <span class="opening-time"> Monday - Friday</span> <span
                                        class="font-weight-800">9.00 - 20.00 </span>
                                </li>
                                <li class="opening-day"> <span class="opening-time"> Monday - Friday</span> <span
                                        class="font-weight-800">9.00 - 20.00 </span>
                                </li>
                                <li class="opening-day"> <span class="opening-time"> Monday - Friday</span> <span
                                        class="font-weight-800">9.00 - 20.00 </span>
                                </li>
                            </ul>
                            <p class="text-white opening-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Ullam velit, a reiciendis deleniti, blanditiis aliquam quam, iste voluptate saepe
                                provident quasi numquam, inventore. Sunt, facilis!.</p>
                            <a href="#" class="btn btn-theme-colored btn-flat btn-xl mt-10 text-white">Online
                                Reservation</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 mt-md-60">
                    <i class="flaticon-scissors font-60"></i>
                    <h5 class="letter-space-8 text-uppercase text-theme-colored1">Welcome to the hotelZone</h5>
                    <h3 class="text-uppercase theme-colored-title">obcaecati ad tempora vitae quidem Dolores.</h3>
                    <p class="theme-colored-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente ex
                        quasi, pariatur harum! Tempora esse quae in ea reprehenderit veritatis molestiae atque, incidunt
                        aut explicabo voluptatum, quibusdam temporibus! Quasi, culpa.</p>
                    <ul class="list-inline mt-20">
                        <li class="list-inline-item"><a href="#"><img class="rounded-circle"
                                    src="{{asset('front_assets/img/hair-style/1.jpg')}}" alt=""></a></li>
                        <li class="list-inline-item"><a href="#"><img class="rounded-circle"
                                    src="{{asset('front_assets/img/hair-style/2.jpg')}}" alt=""></a></li>
                        <li class="list-inline-item"><a href="#"><img class="rounded-circle"
                                    src="{{asset('front_assets/img/hair-style/3.jpg')}}" alt=""></a></li>
                        <li class="list-inline-item"><a href="#"><img class="rounded-circle"
                                    src="{{asset('front_assets/img/hair-style/4.jpg')}}" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- gallery -->
{{-- <section>
    <div class="container-fluid pt-80 pb-80">
        <div class="section-title text-center">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-uppercase text-theme-colored1">Our <span
                            class="text-black font-weight-300">Gallery</span></h2>
                    <p class="text-uppercase letter-space-4">Best Hair Care Theme on Themeforest.</p>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 gallery-images">
                    <img src="{{asset('front_assets/img/gallery/1.jpg')}}" class="gallery-img" alt="" />
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 gallery-images">
                    <img src="{{asset('front_assets/img/gallery/2.jpg')}}" class="gallery-img" alt="" />
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 gallery-images">
                    <img src="{{asset('front_assets/img/gallery/3.jpg')}}" class="gallery-img" alt="" />
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 gallery-images">
                    <img src="{{asset('front_assets/img/gallery/4.jpg')}}" class="gallery-img" alt="" />
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 gallery-images">
                    <img src="{{asset('front_assets/img/gallery/5.jpg')}}" class="gallery-img" alt="" />
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 gallery-images">
                    <img src="{{asset('front_assets/img/gallery/6.jpg')}}" class="gallery-img" alt="" />
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 gallery-images">
                    <img src="{{asset('front_assets/img/gallery/7.jpg')}}" class="gallery-img" alt="" />
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 gallery-images">
                    <img src="{{asset('front_assets/img/gallery/8.jpg')}}" class="gallery-img" alt="" />
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Section: Services-->
{{-- <section id="services">
    <div class="container pt-70 pb-40 pb-sm-70">
        <div class="section-title text-center">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-uppercase text-theme-colored1">Our <span
                            class="text-black font-weight-300">Services</span></h2>
                    <p class="text-uppercase letter-space-4">Best Hair Care Theme on Themeforest.</p>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="icon-box text-center pl-0 pr-0 mb-20">
                        <a href="#" class="icon icon-xl">
                            <img src="{{asset('front_assets/img/service/barbershop.png')}}" class="service-img"
                                alt="" />
                        </a>
                        <h4 class="icon-box-title letter-space-4 text-uppercase">Make Up</h4>
                        <p class="icon-box-desc">Eleifend lobortis bibendum volutpat est senectus duis convallis augue
                            hendrerit senectus duis</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="icon-box text-center pl-0 pr-0 mb-20">
                        <a href="#" class="icon icon-xl">
                            <img src="{{asset('front_assets/img/service/beauty-treatment.png')}}" class="first_img"
                                alt="" />
                        </a>
                        <h4 class="icon-box-title letter-space-4 text-uppercase">Nails Design</h4>
                        <p class="icon-box-desc">Eleifend lobortis bibendum volutpat est senectus duis convallis augue
                            hendrerit senectus duis</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="icon-box text-center pl-0 pr-0 mb-20">
                        <a href="#" class="icon icon-xl">
                            <img src="{{asset('front_assets/img/service/hair-dye-brush.png')}}" class="first_img"
                                alt="" />
                        </a>
                        <h4 class="icon-box-title letter-space-4 text-uppercase">Beauty services </h4>
                        <p class="icon-box-desc">Eleifend lobortis bibendum volutpat est senectus duis convallis augue
                            hendrerit senectus duis</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="icon-box text-center pl-0 pr-0 mb-20">
                        <a href="#" class="icon icon-xl">
                            <img src="{{asset('front_assets/img/service/hair-hotel.png')}}" class="first_img" alt="" />
                        </a>
                        <h4 class="icon-box-title letter-space-4 text-uppercase">Moustache Trim</h4>
                        <p class="icon-box-desc">Eleifend lobortis bibendum volutpat est senectus duis convallis augue
                            hendrerit senectus duis</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="icon-box text-center mb-sm-20">
                        <a href="#" class="icon icon-xl">
                            <img src="{{asset('front_assets/img/service/hairstyle.png')}}" class="first_img" alt="" />
                        </a>
                        <h4 class="icon-box-title letter-space-4 text-uppercase">Moustache Trim</h4>
                        <p class="icon-box-desc">Eleifend lobortis bibendum volutpat est senectus duis convallis augue
                            hendrerit senectus duis</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="icon-box text-center mb-sm-20">
                        <a href="#" class="icon icon-xl">
                            <img src="{{asset('front_assets/img/service/nail-polish.png')}}" class="first_img" alt="" />
                        </a>
                        <h4 class="icon-box-title letter-space-4 text-uppercase">Moustache Trim</h4>
                        <p class="icon-box-desc">Eleifend lobortis bibendum volutpat est senectus duis convallis augue
                            hendrerit senectus duis</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="icon-box text-center mb-sm-0">
                        <a href="#" class="icon icon-xl">
                            <img src="{{asset('front_assets/img/service/hair-cut.png')}}" class="first_img" alt="" />
                        </a>
                        <h4 class="icon-box-title letter-space-4 text-uppercase">Moustache Trim</h4>
                        <p class="icon-box-desc">Eleifend lobortis bibendum volutpat est senectus duis convallis augue
                            hendrerit senectus duis</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="icon-box text-center mb-sm-0">
                        <a href="#" class="icon icon-xl">
                            <img src="{{asset('front_assets/img/service/scissors.png')}}" class="first_img" alt="" />
                        </a>
                        <h4 class="icon-box-title letter-space-4 text-uppercase">Moustache Trim</h4>
                        <p class="icon-box-desc">Eleifend lobortis bibendum volutpat est senectus duis convallis augue
                            hendrerit senectus duis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection
