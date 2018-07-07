@extends('main')

@section('content')
@php
	$routes = [
		'spotAdd' => route('site.spotAddPost'),
	];
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
		<SpotAdd 
		:routes="{{json_encode($routes)}}"
		:tricks="{{$tricks}}"
		:src_local="{{ json_encode(__('spotAdd')) }}"
		></SpotAdd>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
  	<link defer rel="stylesheet" href="{{ asset('css/leaflet.css') }}"/>
  <script defer id="googleMap" onload="window.mapLoaded = true;" src="{{ asset('js/leaflet.js') }}"></script>
  	<script src="{{ asset('js/dropzone.js') }}"></script>
  	<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection