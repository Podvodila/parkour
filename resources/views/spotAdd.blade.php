@extends('main')

@section('content')
@php
	$routes = [
		'spotAdd' => route('site.spotAddPost'),
	];
@endphp
	<div id="app">
		<SpotAdd 
		:routes="{{json_encode($routes)}}"
		:tricks="{{$tricks}}"
		></SpotAdd>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
  	<script id="googleMap" onload="window.mapLoaded = true;" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac"></script>
  	<script src="{{ asset('js/dropzone.js') }}"></script>
  	<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection