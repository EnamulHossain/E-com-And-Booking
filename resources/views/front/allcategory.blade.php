@extends('front.layouts.base')
@section('content')
<!-- Under Construction -->
<!-- all category -->
<section>
   <!-- <div class="text-center all-header row" style="background-image: url('{{asset('front_assets/img/bg/contuct.webp')}}'); object-fit: cover;"> -->
   <div class="text-center all-header row"
      style="background: rgba(0, 0, 0, 0) url('{{asset('front_assets/img/bg/contuct.webp')}}') no-repeat scroll center center / cover ;">
      <div class="col-12">
         <h3 class="color-wh">{{__('front.browse_all_categories')}}</h3>
         <p class="color-wh">{{__('front.get_your_suitable_service')}}</p>
      </div>
   </div>
   <div class="container">
      @php
      $j=1;
      @endphp
      <div class="row category-row">
         @foreach ($allCategories as $cat )
         <div
            class="col-sm-6 col-lg-3 all-cat-row @if ($j%4 == 0) cat-row-last @endif @if ($j%5 == 0) cat-row-first @endif @if ($j == 1) cat-row-first @endif">
            <div class="service-blog-card">
               <div class="all-cat-body">
                  <div class="all-cat-img">
                     <a href="{!! route('home.allservices', $cat->id) !!}">
                        @if(isset($cat) && $cat->hasMedia('image'))
                        <img src="{!! url($cat->getFirstMediaUrl('image')) !!}" alt="" />
                        @endif
                        {{-- TODO:get image from category --}}
                        {{-- <img src="{{asset('front_assets/img/product/1.jpg')}}" class="first_img" alt="" /> --}}
                     </a>
                  </div>
                  <a href="{!! route('home.allservices', $cat->id) !!}">
                     <h4 class="all-cat-heading">{{$cat->name}}</h4>
                  </a>
                  <div class="sub-cat">
                     <ul>
                        @php
                        $i=0;
                        @endphp
                        @foreach ($cat->subCategories as $sub)
                        @if ($i<2) <li class="all-cat-sub">
                           <a href="{!! route('home.allservices', $sub->id) !!}">
                              <h4 class="sub-cat-heading">{{$sub->name}}</h4>
                           </a>
                           @php
                           $taglessBody = strip_tags($sub->description)
                           @endphp
                           <p class="sub-cat-desc card-text-ellipsis">{{$taglessBody}}</p>
                           </li>
                           @endif
                           @php
                           $i++;
                           @endphp
                           @endforeach
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         @php
         $j++;
         @endphp
         @endforeach
      </div>
   </div>
</section>
@endsection
