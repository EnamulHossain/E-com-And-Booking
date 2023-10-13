@extends('front.layouts.base')
@section('content')
<!-- header and search -->
<section style="background-image: url({{asset('front_assets/img/about/2.jpg')}}); min-height: 50%">
    <div class="text-center all-header">
        <div class="service-header-title">
            <h3 class="custom-fonts bro-clr">@lang('front.browse_all_services')</h3>
            <p class="bro-clr">@lang('front.get_your_suitable_service')</p>
        </div>
        <form action="#" method="post" class="search-container">
            <div class="search-area">
                <input type="text" name="search" id="">
                <button type="submit">@lang('front.search')</button>
            </div>
        </form>
    </div>
</section>
<!-- saloon -->
<div class="pt-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 rmv-next-prev">
                <div class="section-title section-title-4">
                    <h2>Saloons</h2>
                </div>
                <div class="row">
                    <div class="">
                        @php
                            $saloonCount = count($allsaloon);
                            $itemsPerRow = 3;
                        @endphp

                        @for ($i = 0; $i < $saloonCount; $i += $itemsPerRow)
                            <div class="row">
                                @foreach ($allsaloon->slice($i, $itemsPerRow) as $sln)
                                    <div class="col-lg-4 card-container"> <!-- Adjust column width as needed -->
                                        <div class="card">
                                            <a href="{!! route('saloon.show', $sln->id) !!}">
                                                @if(isset($sln) && $sln->hasMedia('image'))
                                                    <img src="{!! url($sln->getFirstMediaUrl('image')) !!}" alt="" />
                                                @endif
                                            </a>
                                            <div class="card-body">
                                                <a href="{!! route('saloon.show', $sln->id) !!}" class="">
                                                    <h4 class="card-title">{{$sln->name}}</h4>
                                                </a>
                                                <div class="card-description">
                                                    <p>{{$sln->description}}</p>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="service-level">{{$sln->salonLevel->name ?? ""}}</div>
                                                    <div class="service-rating">
                                                        {!! $sln->getRatingView() !!}
                                                    </div>
                                                    <div>
                                                        <a href="{!! route('saloon.show', $sln->id) !!}">@lang('front.details')</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
