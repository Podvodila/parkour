@extends('main')

@section('content')
  <div id="app">
    <MapAll 
      :spots="{{$spots}}"
      :redirect="true"
    ></MapAll>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script async defer src="/js/markerclusterer.js"></script>
  <script id="googleMap" onload="window.mapLoaded = true;" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac&libraries=places"></script>
  <style>
  	body {
  		height: 100vh;
  		display: flex;
  		flex-direction: column;
  	}

  	.main-content {
  		max-width: 100vw !important;
  		width: 100%;
  		height: 100%;
  		flex: 1;
	    min-height: 0;
	    display: flex;
  	}

  	#app {
  		height: 100%;
  		width: 100%;
  	}
  </style>
@endsection