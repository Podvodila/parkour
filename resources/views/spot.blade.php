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
		'addComment' => route('spot.addComment', $id = $spot->id),
		'removeComment' => route('spot.removeComment', $id = $spot->id),
	];
	$local = __('spot');
	$routesHeader = [
			'login' => route('login'), 
			'logout' => route('logout'), 
			'profile' => route('site.profileEdit'), 
			'find' => route('site.mapFind'),
			'changeLocale' => route('site.changeLocale'),
			'spotAdd' => route('site.spotAdd'),
			'home' => route('site.index'),
		];
@endphp
	<div id="app">
		<HeaderApp :routes="{{json_encode($routesHeader)}}" auth="{{auth()->guard()->check()}}" :src_local="{{ json_encode(__('header')) }}"></HeaderApp>
		<Spot 
		:routes="{{json_encode($routes)}}"
		:src_images="{{json_encode($images)}}"
		:src_spot="{{$spot}}"
		:tricks_src="{{$spot->tricks}}"
		:src_videos="{{$videos}}"
		:user="{{$user}}"
		:src_new_tricks="{{json_encode($new_tricks)}}"
		:src_comments="{{$comments}}"
		:src_local="{{ json_encode($local) }}"
		></Spot>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
  	<link async defer rel="stylesheet" href="{{ asset('css/leaflet.css') }}"/>
  <script async defer id="googleMap" onload="window.mapLoaded = true;" src="{{ asset('js/leaflet.js') }}"></script>
@endsection