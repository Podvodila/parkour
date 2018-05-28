@extends('main')

@section('content')
@php
    $routes = ['register' => route('register')];
@endphp
<div id="app">
    <Register 
        localization="{{ json_encode(__('register')) }}"
        routes="{{ json_encode($routes) }}"
        ></Register>
</div>


@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
@endsection