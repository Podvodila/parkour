@extends('main')

@php
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

@section('title')
@lang('find.pageTitle')
@endsection

@section('description')
@lang('find.pageDescription')
@endsection

@section('content')
  <div id="app">
    <HeaderApp :routes="{{json_encode($routesHeader)}}" auth="{{auth()->guard()->check()}}" :src_local="{{ json_encode(__('header')) }}"></HeaderApp>
    <MapAll 
      :spots="{{$spots}}"
      :redirect="true"
    ></MapAll>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" crossorigin=""/>
  <script src="{{ asset('js/leaflet.js') }}" crossorigin=""></script>
  <link rel="stylesheet" href="{{ asset('css/MarkerCluster.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/MarkerCluster.Default.css') }}"/>
  <script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
  <script src="{{ asset('js/leaflet-geosearch.min.js') }}" crossorigin=""></script>
  <style>
  	body {
  		height: 100vh;
  		display: flex;
  		flex-direction: column;
  	}

  	.main-content {
  		max-width: 100vw !important;
  		width: 100%;
  		height: 100%;
  		flex: 1;
	    min-height: 0;
	    display: flex;
  	}

  	#app {
  		height: 100%;
  		width: 100%;
  	}
  </style>
@endsection