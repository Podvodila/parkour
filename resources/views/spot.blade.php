
	<form action="{{ route('site.spotAddPost') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div>
			<h4>Местонахождение локации</h4>
			<div id="map"></div>
			<input type="hidden" name="location" id="location">
		</div>

		<div>
			<h4>Добавить изображения локации</h4>
			<input type="file" name="image[]" multiple>
		</div>

		<div>
			<h4>Описание локации</h4>
			<textarea name="description" cols="30" rows="10"></textarea>
		</div>
		
		<div>
			<h4>Элементы, которые можно выполнять на этой локации</h4>
			<select name="move[]" id="move" multiple>
	            @foreach ($tricks as $trick)
	                <option value="{{ $trick->id }}">{{ $trick->name }}</option>
	            @endforeach
        	</select>
		</div>
		


		<input type="submit" value="Send">
	</form>

	@if ($errors)
        @foreach ($errors->all() as $message)
            <p>{{ $message }}</p>
        @endforeach
    @endif


<script>
	function initMap() {
		var map = new google.maps.Map(document.querySelector("#map"), {
			zoom: 3,
			center: {lat: 33.13798974, lng: 18.63074565 }
		});

		var marker = new google.maps.Marker({
		  position: { lat: 33.13798974, lng: 18.63074565 },
		});

		map.addListener('click', function(e) {
          placeMarker(e.latLng, map, marker);
        });
    }

	function placeMarker(latLng, map, marker) {
		marker.position = latLng;
		marker.setMap(map);
		var location = document.querySelector("#location");
		location.value = `${latLng.lat()} ${latLng.lng()}`;
	}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM7zVJIpwF35JDbkg0oS4awX4pBzZoMac&callback=initMap"></script>

<style>
	#map {
		height: 500px;
		width: 100%;
	}
</style>