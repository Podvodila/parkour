@if (count(Storage::disk('local')->files('spots/' . $spot->id . '/images/')) > 0)
	<div>
		@foreach (Storage::disk('local')->files('spots/' . $spot->id . '/images/') as $image)
			<img src="{{ Storage::disk('local')->url($image) }}" alt="" class="pic">
		@endforeach
	</div>
@endif

<div>
	<h4>Местонахождение локации</h4>
	<div id="map"></div>
</div>

<div>
	<h4>Описание локации</h4>
	<div>{{ $spot->description }}</div>
</div>

<div>
	<h4>Элементы, которые можно выполнять на этой локации</h4>
	@foreach ($spot->tricks as $trick)
		<h5>{{$trick->name}}</h5>
	@endforeach
</div>

<script>
	function initMap() {
		var map = new google.maps.Map(document.querySelector("#map"), {
			zoom: 12,
			center: {lat: {{$spot->lat}}, lng: {{$spot->lng}} }
		});

		var marker = new google.maps.Marker({
		  position: {lat: {{$spot->lat}}, lng: {{$spot->lng}} },
		  map: map,
		});
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