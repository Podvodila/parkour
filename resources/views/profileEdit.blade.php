@extends('main')

@section('content')
@php
	$routes = ['updateAvatar' => route('profile.uploadImg'), 'removeAvatar' => route('profile.removeImg'), 'getUserVideos' => route('ajax.getUserVideos'), 'getAvatar' => route('ajax.getAvatar'), 'setSocial' => route('ajax.setSocial'), 'addMove' => route('profile.addMove'), 'removeMove' => route('profile.removeMove'), 'addVideo' => route('profile.addMoveVideo'), 'removeVideo' => route('profile.removeMoveVideo'), 'addSpotToVideo' => route('profile.addSpotToVideo'), 
	'removeSpotFromVideo' => route('profile.removeSpotFromVideo')];
@endphp
	<div id="app">
		<ProfileEdit 
		:routes="{{json_encode($routes)}}"
		:user="{{$user}}"
		:all_tricks="{{$allTricks}}"
		:user_tricks="{{$tricks}}"
		:prop_videos="{{$videos}}"
		:spots="{{$spots}}"
		:avatar="{{json_encode($avatar)}}"
		></ProfileEdit>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script async defer src="/js/markerclusterer.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac&libraries=places"></script>
@endsection