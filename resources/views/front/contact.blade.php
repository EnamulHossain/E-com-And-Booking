@extends('front.layouts.base')
@section('content')
<!-- page-title-wrapper-start -->
<div class="page-title-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="page-title">
               <h3>@lang('front.contact_us')</h3>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- page-title-wrapper-end -->
<!-- google-map-area-start -->
<div class="google-map-area ptb-80">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="google-map" id="map">
            </div>
         </div>
      </div>
   </div>
</div>
<!-- google-map-area-end -->
<!-- contuct-form-area-start -->
<div class="contuct-form-area pb-80">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="contuct-form">
               <form>
                  <div class="form-group contuct_f">
                     <label for="exampleInputEmail1">@lang('front.name')<span>*</span></label>
                     <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name">
                  </div>
                  <div class="form-group contuct_f">
                     <label for="exampleInputPassword1">@lang('front.email')<span>*</span></label>
                     <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
                  </div>
                  <div class="form-group contuct_f">
                     <label for="exampleInputPassword1">@lang('front.phone_number')</label>
                     <input type="text" class="form-control" id="exampleInputPassword1"
                        placeholder="@lang('front.phone_number')">
                  </div>
                  <div class="form-group contuct_f">
                     <label for="exampleInputPassword1">@lang('front.what_is_on_your_mind') <span>*</span></label>
                     <textarea class="form-control" rows="3"></textarea>
                  </div>
                  <button type="submit" class="btn btn-default contact-btn">@lang('front.submit')</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- contuct-form-area-end -->
<!-- Google Map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDA0gvtDVpKHrPUAWQ6tT8DT12ny_TDSkk "></script>
<script>
   // When the window has finished loading create our google map below
   google.maps.event.addDomListener(window, 'load', init);
   
   function init() {
   	// Basic options for a simple Google Map
   	// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
   	var mapOptions = {
   		// How zoomed in you want the map to start at (always required)
   		zoom: 11,
   
   		scrollwheel: false,
   
   		// The latitude and longitude to center the map (always required)
   		center: new google.maps.LatLng(40.6700, -73.9400), // New York
   
   		// How you would like to style the map. 
   		// This is where you would paste any style found on Snazzy Maps.
   		styles: [
   {
   "featureType": "administrative",
   "elementType": "labels.text.fill",
   "stylers": [
   {
   	"color": "#444444"
   }
   ]
   },
   {
   "featureType": "landscape",
   "elementType": "all",
   "stylers": [
   {
   	"color": "#f2f2f2"
   }
   ]
   },
   {
   "featureType": "poi",
   "elementType": "all",
   "stylers": [
   {
   	"visibility": "off"
   }
   ]
   },
   {
   "featureType": "road",
   "elementType": "all",
   "stylers": [
   {
   	"saturation": -100
   },
   {
   	"lightness": 45
   }
   ]
   },
   {
   "featureType": "road.highway",
   "elementType": "all",
   "stylers": [
   {
   	"visibility": "simplified"
   }
   ]
   },
   {
   "featureType": "road.arterial",
   "elementType": "labels.icon",
   "stylers": [
   {
   	"visibility": "off"
   }
   ]
   },
   {
   "featureType": "transit",
   "elementType": "all",
   "stylers": [
   {
   	"visibility": "off"
   }
   ]
   },
   {
   "featureType": "water",
   "elementType": "all",
   "stylers": [
   {
   	"color": "#46bcec"
   },
   {
   	"visibility": "on"
   }
   ]
   }
   ]
   	};
   
   	// Get the HTML DOM element that will contain your map 
   	// We are using a div with id="map" seen below in the <body>
   	var mapElement = document.getElementById('map');
   
   	// Create the Google Map using our element and options defined above
   	var map = new google.maps.Map(mapElement, mapOptions);
   
   	// Let's also add a marker while we're at it
   	var marker = new google.maps.Marker({
   		position: new google.maps.LatLng(40.6700, -73.9400),
   		map: map,
   		title: 'Snazzy!'
   	});
   }
</script>
@endsection
