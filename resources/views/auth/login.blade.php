@extends('main')

@section('content')
@php
    $routes = ['login' => route('login'), 'forgot' => route('password.request'), 'register' => route('register')];
    $routesHeader = ['login' => route('login'), 'logout' => route('logout'), 'profile' => route('site.profileEdit'), 'find' => route('site.mapFind')];
@endphp
<div id="app">
	<HeaderApp :routes="{{json_encode($routesHeader)}}" auth="{{auth()->guard()->check()}}"></HeaderApp>
    <Login 
        localization="{{ json_encode(__('login')) }}"
        routes="{{ json_encode($routes) }}"
        ></Login>
</div>


@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
@endsection