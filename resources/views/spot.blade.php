@extends('main')

@section('content')
@php
	$routes = [
		'user' => route('site.profile', $id = 0), 
		'addImages' => route('spot.addImages', $id = $spot->id), 
		'removeImage' => route('spot.removeImage', $id = $spot->id),
		'editDescription' => route('spot.editDescription', $id = $spot->id),
		'removeMove' => route('spot.removeMove', $id = $spot->id),
		'addMove' => route('spot.addMove', $id = $spot->id),
		'removeSpotFromVideo' => route('spot.removeSpotFromVideo', $id = $spot->id),
	];
@endphp
	<div id="app">
		<Spot 
		:routes="{{json_encode($routes)}}"
		:src_images="{{json_encode($images)}}"
		:src_spot="{{$spot}}"
		:tricks_src="{{$spot->tricks}}"
		:src_videos="{{$videos}}"
		:user="{{$user}}"
		:src_new_tricks="{{json_encode($new_tricks)}}"
		></Spot>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
  	<script id="googleMap" onload="window.mapLoaded = true;" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac"></script>
@endsection