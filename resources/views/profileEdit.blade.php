@extends('main')

@section('content')
@php
	$routes = ['updateAvatar' => route('profile.uploadImg'), 'removeAvatar' => route('profile.removeImg'), 'getUserVideos' => route('ajax.getUserVideos'), 'getAvatar' => route('ajax.getAvatar'), 'setSocial' => route('ajax.setSocial'), 'addMove' => route('profile.addMove'), 'removeMove' => route('profile.removeMove'), 'addVideo' => route('profile.addMoveVideo'), 'removeVideo' => route('profile.removeMoveVideo'), 'addSpotToVideo' => route('profile.addSpotToVideo'), 
	'removeSpotFromVideo' => route('profile.removeSpotFromVideo')];
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
		<ProfileEdit 
		:routes="{{json_encode($routes)}}"
		:user="{{$user}}"
		:all_tricks="{{$allTricks}}"
		:user_tricks="{{$tricks}}"
		:prop_videos="{{$videos}}"
		:spots="{{$spots}}"
		:avatar="{{json_encode($avatar)}}"
		:src_local="{{ json_encode(__('profileEdit')) }}"
		></ProfileEdit>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
	<link defer rel="stylesheet" href="{{ asset('css/leaflet.css') }}"/>
  <script defer src="{{ asset('js/leaflet.js') }}"></script>
  <link defer rel="stylesheet" href="{{ asset('css/MarkerCluster.css') }}"/>
  <link defer rel="stylesheet" href="{{ asset('css/MarkerCluster.Default.css') }}"/>
  <script defer src="{{ asset('js/leaflet.markercluster.js') }}"></script>
  <script defer src="{{ asset('js/leaflet-geosearch.min.js') }}"></script>
@endsection