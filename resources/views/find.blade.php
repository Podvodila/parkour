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
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac"></script>
@endsection