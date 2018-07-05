@extends('main')

@php
    $routes = ['find' => route('site.mapFind')];
    $routesHeader = ['login' => route('login'), 'logout' => route('logout'), 'profile' => route('site.profileEdit'), 'find' => route('site.mapFind')];
@endphp

@section('content')
<div id="app">
	<HeaderApp :routes="{{json_encode($routesHeader)}}" auth="{{auth()->guard()->check()}}"></HeaderApp>
    <Home images_path="{{asset('images')}}/"
          :routes="{{json_encode($routes)}}"></Home>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/homestyle.css') }}"> -->
@endsection
