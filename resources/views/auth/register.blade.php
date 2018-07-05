@extends('main')

@section('content')
@php
    $routes = ['register' => route('register')];
    $routesHeader = ['login' => route('login'), 'logout' => route('logout'), 'profile' => route('site.profileEdit'), 'find' => route('site.mapFind')];
@endphp
<div id="app">
	<HeaderApp :routes="{{json_encode($routesHeader)}}" auth="{{auth()->guard()->check()}}"></HeaderApp>
    <Register 
        localization="{{ json_encode(__('register')) }}"
        routes="{{ json_encode($routes) }}"
        ></Register>
</div>


@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
@endsection