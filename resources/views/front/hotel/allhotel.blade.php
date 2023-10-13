@extends('front.layouts.base')
@section('content')

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
            @csrf
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
            @php
            $count = 1;
            @endphp
            @foreach ($hotels as $sln)
            <div class="col-md-4">
                <div class="card-container">
                    <div class="card" style="width: 400px;>
                        <a href="{!! route('hotel.show', $sln->id) !!}">
                            @if(isset($sln) && $sln->hasMedia('image'))
                            <img src="{!! url($sln->getFirstMediaUrl('image')) !!}" alt="" />
                            @endif
                        </a>
                        <div class="card-body">
                            <a href="{!! route('hotel.show', $sln->id) !!}" class="">
                                <h4 class="card-title">{{$sln->name}}</h4>
                            </a>
                            <div class="card-description">
                                <p>{{$sln->description}}</p>
                            </div>
                            <div class="card-footer">
                                <div class="service-level">{{$sln->hotelLevel->name ?? ""}}</div>
                                
                                <div class="service-rating">
                                        {!! $sln->getRatingView() !!}  
                                </div>
                                
                                <div>
                                    <a href="{!! route('hotel.show', $sln->id) !!}">@lang('front.details')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
            $count++;
            if ($count > 3) {
                $count = 1;
                echo '</div><div class="row">';
            }
            @endphp
            @endforeach
        </div>
    </div>
</div>
@endsection