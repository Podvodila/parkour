@extends('main')

@php
    $routes = ['find' => route('site.mapFind')];
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
@lang('home.pageTitle')
@endsection

@section('description')
@lang('home.pageDescription')
@endsection

@section('content')
<div id="app">
	<HeaderApp :routes="{{json_encode($routesHeader)}}" auth="{{auth()->guard()->check()}}" :src_local="{{ json_encode(__('header')) }}"></HeaderApp>
    <Home images_path="{{asset('images')}}/"
          :routes="{{json_encode($routes)}}"
          :src_local="{{ json_encode(__('home')) }}"></Home>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/homestyle.css') }}"> -->
@endsection
