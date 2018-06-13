<div id="map"></div>

<script>

  function initMap() {

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 3,
      center: {lat: 45.33707006, lng: 34.53894877}
    });

    var locations = [
      ];

    @foreach ($spots as $spot)
    	locations.push({
    		lat: {{$spot->lat}},
    		lng: {{$spot->lng}},
    		url: "{{route('site.spot', ['id' => $spot->id])}}"
    	});
    @endforeach

    var markers = locations.map(function(location, i) {
      return new google.maps.Marker({
        position: location,
        url: location.url,
      });
    });

    var markerCluster = new MarkerClusterer(map, markers,
        {imagePath: "{{asset('images/m')}}"});

    for ( i = 0; i < markers.length; i++ ) {
	    google.maps.event.addListener(markers[i], 'click', function() {
	      window.location.href = this.url;  
	    });
	}

    
  }
</script>

<script src="{{asset('js/markerclusterer.js')}}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac&callback=initMap"></script>

<style>
	#map {
		height: 700px;
		width: 100%;
	}

	.pic {
		max-width: 300px;
	}
</style>