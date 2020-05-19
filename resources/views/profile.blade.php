@extends('main')

@section('title')
{{$user->first_name}} {{$user->last_name}}
@endsection

@section('description')
@lang('profile.pageDescription', ['tracer' => $user->first_name . ' ' . $user->last_name])
@endsection

@section('content')
@php
	$routes = ['getUser' => route('ajax.getUser'), 'getUserTricks' => route('ajax.getUserTricks'), 'getUserVideos' => route('ajax.getUserVideos'), 'getAvatar' => route('ajax.getAvatar')];
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
		<Profile 
		:routes="{{json_encode($routes)}}"
		:user="{{$user}}"
		:tricks="{{$tricks}}"
		:videos="{{$videos}}"
		:avatar="{{json_encode($avatar)}}"
		:src_local="{{ json_encode(__('profile')) }}"
		></Profile>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
@endsection