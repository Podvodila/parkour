@extends('main')

@section('title')
@lang('register.pageTitle')
@endsection

@section('description')
@lang('register.pageDescription')
@endsection

@section('content')
@php
    $routes = ['register' => route('register')];
    $routesHeader = [
			'login' => route('login'), 
			'logout' => route('logout'), 
			'profile' => route('site.profileEdit'), 
			'find' => route('site.mapFind'),
			'changeLocale' => route('site.changeLocale'),
			'home' => route('site.index'),
		];
@endphp
<div id="app">
	<HeaderApp :routes="{{json_encode($routesHeader)}}" auth="{{auth()->guard()->check()}}" :src_local="{{ json_encode(__('header')) }}"></HeaderApp>
    <Register 
        routes="{{ json_encode($routes) }}"
        :src_local="{{ json_encode(__('register')) }}"
        ></Register>
</div>


@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
@endsection