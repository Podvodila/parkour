@extends('main')

@section('content')
@php
	$routes = ['getUser' => route('ajax.getUser'), 'getUserTricks' => route('ajax.getUserTricks'), 'getUserVideos' => route('ajax.getUserVideos'), 'getAvatar' => route('ajax.getAvatar')];
	$routesHeader = ['login' => route('login'), 'logout' => route('logout'), 'profile' => route('site.profileEdit'), 'find' => route('site.mapFind')];
@endphp
	<div id="app">
		<HeaderApp :routes="{{json_encode($routesHeader)}}" auth="{{auth()->guard()->check()}}"></HeaderApp>
		<Profile 
		:routes="{{json_encode($routes)}}"
		:user="{{$user}}"
		:tricks="{{$tricks}}"
		:videos="{{$videos}}"
		:avatar="{{json_encode($avatar)}}"
		></Profile>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
@endsection