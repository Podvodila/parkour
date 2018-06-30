@extends('main')

@section('content')
@php
	$routes = [
		'user' => route('site.profile', $id = 0),
	];
@endphp
	<div id="app">
		<SpotAdd 
		:routes="{{json_encode($routes)}}"
		></SpotAdd>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
  	<script id="googleMap" onload="window.mapLoaded = true;" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac"></script>
  	<script src="{{ asset('js/dropzone.js') }}"></script>
  	<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection

<!-- <script>
	function initMap() {
		var map = new google.maps.Map(document.querySelector("#map"), {
			zoom: 3,
			center: {lat: 33.13798974, lng: 18.63074565 }
		});

		var marker = new google.maps.Marker({
		  position: { lat: 33.13798974, lng: 18.63074565 },
		});

		map.addListener('click', function(e) {
          placeMarker(e.latLng, map, marker);
        });
    }

	function placeMarker(latLng, map, marker) {
		marker.position = latLng;
		marker.setMap(map);
		var location = document.querySelector("#location");
		location.value = `${latLng.lat()} ${latLng.lng()}`;
	}
</script> -->