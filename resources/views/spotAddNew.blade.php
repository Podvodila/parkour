
<form action="{{ route('site.spotAddPost') }}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div>
		<h4>Местонахождение локации</h4>
		<div id="map"></div>
		<input type="hidden" name="location" id="location">
	</div>

	<div id="images-container" class="dropzone">
 		<div class="dz-message" data-dz-message><span>Your Custom Message</span></div>
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
<script src="{{ asset('js/dropzone.js') }}"></script>

<script>
	Dropzone.autoDiscover = false;
	var myDropzone = new Dropzone(document.querySelector("#images-container"), {
		previewTemplate: `<div class="dz-preview dz-file-preview">
							<div class="dz-image">
							    <img data-dz-thumbnail />
						  	</div>
						  	<svg data-dz-remove class="remove-image" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
								<path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
							</svg>
							</div>`,
		uploadMultiple: true,
		paramName: 'image',
		autoProcessQueue: false,
		url: 'random',
	});

	setInterval(() => {
		console.log(myDropzone.files);
	}, 5000);
</script>

<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">

<style>
	#map {
		height: 500px;
		width: 100%;
	}

	.remove-image {
		width: 100%;
		height: 100%;
		fill: #a00;
		position: absolute;
		top: 0;
		left: 0;
		z-index: 10;
		opacity: 0;
		transition: .5s;
		cursor: pointer !important;
	}

	.remove-image * {
		cursor: pointer !important;
	}

	.remove-image:hover {
		opacity: 1;
	}

	/*#images-container {
		height: 300px;
		border: 1px solid #aaa;
	}*/
</style>