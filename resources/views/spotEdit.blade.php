@if (count(Storage::disk('local')->files('spots/' . $spot->id . '/images/')) > 0)
	@foreach (Storage::disk('local')->files('spots/' . $spot->id . '/images/') as $image)
		<form action="{{ route('spot.removeImage', ['id' => $spot->id]) }}" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="path" value="{{ Storage::disk('local')->url($image) }}">
			<img src="{{ Storage::disk('local')->url($image) }}" alt="" class="pic">
			<input type="submit" value="remove image">
		</form>
	@endforeach
@endif

<form action="{{ route('spot.addImages', ['id' => $spot->id]) }}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="file" name="image[]" multiple>
	<input type="submit" value="Add images">
</form>

<form action="{{ route('spot.editLocation', ['id' => $spot->id]) }}" method="POST">
	{{ csrf_field() }}
	<h4>Местонахождение локации</h4>
	<div id="map"></div>
	<input type="hidden" name="location" id="location">
	<input type="submit" value="Change location">
</form>

<form action="{{ route('spot.editDescription', ['id' => $spot->id]) }}" method="POST">
	{{ csrf_field() }}
	<h4>Описание локации</h4>
	<textarea name="description" cols="30" rows="10">{{ $spot->description }}</textarea>
	<input type="submit" value="Change description">
</form>


@foreach ($spot->tricks as $trick)
	<form action="{{ route('spot.removeMove', ['id' => $spot->id]) }}" method="POST">
	{{ csrf_field() }}
		<h4>{{$trick->name}}</h4>
		<input type="hidden" value="{{$trick->id}}" name="move">
		<input type="submit" value="Remove move">
	</form>
@endforeach

<form action="{{ route('spot.addMove', ['id' => $spot->id]) }}" method="POST">
	{{ csrf_field() }}
	<h4>Элементы, которые можно выполнять на этой локации</h4>
	<select name="move[]" id="move" multiple>
        @foreach ($tricks as $trick)
        	@if (!$spot->tricks->contains($trick->id))
            	<option value="{{ $trick->id }}">{{ $trick->name }}</option>
            @endif
        @endforeach
	</select>
	<input type="submit" value="Add moves">
</form>

<form action="{{ route('spot.remove', ['id' => $spot->id]) }}" method="POST">
	{{ csrf_field() }}
	<input type="submit" value="remove spot">
</form>

@if ($errors)
    @foreach ($errors->all() as $message)
        <p>{{ $message }}</p>
    @endforeach
@endif


<script>
	function initMap() {
		var map = new google.maps.Map(document.querySelector("#map"), {
			zoom: 5,
			center: {lat: {{$spot->lat}}, lng: {{$spot->lng}} }
		});

		var marker = new google.maps.Marker({
		  position: {lat: {{$spot->lat}}, lng: {{$spot->lng}} },
		  map: map,
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

	.pic {
		max-width: 300px;
	}
</style>