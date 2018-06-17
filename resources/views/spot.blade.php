@extends('main')

@section('content')
@if (count(Storage::disk('local')->files('spots/' . $spot->id . '/images/')) > 0)
		@foreach (Storage::disk('local')->files('spots/' . $spot->id . '/images/') as $image)
			@php
				$images[] = Storage::disk('local')->url($image);
			@endphp
		@endforeach
@else
	@php
		$images = [];
	@endphp
@endif
@php
	$routes = ['user' => route('site.profile', $id = 0)];
@endphp
	<div id="app">
		<Spot 
		:routes="{{json_encode($routes)}}"
		:images="{{json_encode($images)}}"
		:spot="{{$spot}}"
		:tricks_src="{{$spot->tricks}}"
		:videos="{{$videos}}"
		></Spot>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
  	<script id="googleMap" onload="window.mapLoaded = true;" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac"></script>
@endsection