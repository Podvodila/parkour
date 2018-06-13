@extends('main')

@section('content')
@php
	$routes = ['getUser' => route('ajax.getUser'), 'getUserTricks' => route('ajax.getUserTricks'), 'getUserVideos' => route('ajax.getUserVideos'), 'getAvatar' => route('ajax.getAvatar')];
@endphp
	<div id="app">
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