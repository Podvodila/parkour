<template>
	<div id="map"></div>
</template>

<script>
  	var comp = {
		props: ['spots', 'redirect'],
		data() {
			return {

			}
		},
		mounted() {
			this.initMap();
		},
		methods: {
			initMap() {
				var self = this;
			    var map = new google.maps.Map(document.getElementById('map'), {
			      zoom: 3,
			      center: {lat: 45.33707006, lng: 34.53894877}
			    });

			    var locations = [
			      ];

			    for(var i = 0; i < this.spots.length; i++) {
			    	locations.push({
			    		lat: this.spots[i].lat,
			    		lng: this.spots[i].lng,
			    		url: "/spot/" + this.spots[i].id,
			    		spot_id: this.spots[i].id,
			    	});
			    }

			    var markers = locations.map(function(location, i) {
			      return new google.maps.Marker({
			        position: location,
			        url: location.url,
			        spot_id: location.spot_id,
			      });
			    });

			    var markerCluster = new MarkerClusterer(map, markers,
			        {imagePath: "/images/m"});

			    for ( i = 0; i < markers.length; i++ ) {
				    google.maps.event.addListener(markers[i], 'click', function() {
				      if(self.redirect) {
					      window.location.href = this.url;
					  } else {
					  	self.$emit('marker-clicked', this.spot_id);
					  }

				    });
				}
			},
		}
	};

	export default comp;
</script>

<!-- <script async defer src="/js/markerclusterer.js"></script> -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac"></script> -->

<style>
	#map {
		height: 100%;
		width: 100%;
	}

	.pic {
		max-width: 300px;
	}
</style>