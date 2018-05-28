@extends('main')

@section('content')
@php
    $routes = ['login' => route('login'), 'forgot' => route('password.request'), 'register' => route('register')];
@endphp
<div id="app">
    <Login 
        localization="{{ json_encode(__('login')) }}"
        routes="{{ json_encode($routes) }}"
        ></Login>
</div>


@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
@endsection