<template>
	<div class="custom-map-wrap">
		<div id="map"></div>
		<div class="map-search-container">
			<input type="text" class="map-search-field" id="map-search-field" placeholder="Search for a location..." @keyup.enter="enterSearch">
			<svg class="map-search-placeholder" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" version="1.1" x="0px" y="0px">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<path d="M56.363961,56.863961 C46.4055916,66.8223305 30.2598846,66.8223305 20.3015152,56.863961 C10.3431458,46.9055916 10.3431458,30.7598846 20.3015152,20.8015152 C30.2598846,10.8431458 46.4055916,10.8431458 56.363961,20.8015152 C66.3223305,30.7598846 66.3223305,46.9055916 56.363961,56.863961 Z M54.2426407,54.7426407 C63.0294373,45.9558441 63.0294373,31.7096321 54.2426407,22.9228355 C45.4558441,14.136039 31.2096321,14.136039 22.4228355,22.9228355 C13.636039,31.7096321 13.636039,45.9558441 22.4228355,54.7426407 C31.2096321,63.5294373 45.4558441,63.5294373 54.2426407,54.7426407 Z" fill="#000000" fill-rule="nonzero"/>
					<path d="M52.4748737,52.9748737 C44.6643879,60.7853596 32.0010883,60.7853596 24.1906025,52.9748737 C16.3801167,45.1643879 16.3801167,32.5010883 24.1906025,24.6906025 C32.0010883,16.8801167 44.6643879,16.8801167 52.4748737,24.6906025 C60.2853596,32.5010883 60.2853596,45.1643879 52.4748737,52.9748737 Z M51.0606602,51.5606602 C58.0900974,44.5312229 58.0900974,33.1342533 51.0606602,26.104816 C44.0312229,19.0753788 32.6342533,19.0753788 25.604816,26.104816 C18.5753788,33.1342533 18.5753788,44.5312229 25.604816,51.5606602 C32.6342533,58.5900974 44.0312229,58.5900974 51.0606602,51.5606602 Z" fill="#000000" fill-rule="nonzero"/>
					<path d="M42.0972262,24.3105009 C42.6319627,24.4486143 42.9534892,24.994067 42.8153757,25.5288035 C42.6772623,26.06354 42.1318096,26.3850665 41.5970731,26.246953 C37.1688671,25.1032218 32.4337141,26.3469858 29.14035,29.64035 C28.7498257,30.0308742 28.1166607,30.0308742 27.7261364,29.64035 C27.3356121,29.2498257 27.3356121,28.6166607 27.7261364,28.2261364 C31.5253562,24.4269166 36.9902879,22.9914645 42.0972262,24.3105009 Z" fill="#000000" fill-rule="nonzero"/>
					<path d="M48.9393398,28.2261364 C49.3298641,28.6166607 49.3298641,29.2498257 48.9393398,29.64035 C48.5488155,30.0308742 47.9156506,30.0308742 47.5251263,29.64035 C46.833966,28.9491897 46.077059,28.3445909 45.265625,27.8320849 C44.7986799,27.5371599 44.65923,26.9195422 44.954155,26.4525972 C45.2490799,25.9856521 45.8666976,25.8462022 46.3336427,26.1411272 C47.2701613,26.7326372 48.143213,27.4300096 48.9393398,28.2261364 Z" fill="#000000" fill-rule="nonzero"/>
					<path d="M59.8994949,61.1066017 C58.9231842,62.0829124 58.9231842,63.6658249 59.8994949,64.6421356 L74.0416306,78.7842712 C75.0179413,79.760582 76.6008537,79.760582 77.5771645,78.7842712 L78.2842712,78.0771645 C79.260582,77.1008537 79.260582,75.5179413 78.2842712,74.5416306 L64.1421356,60.3994949 C63.1658249,59.4231842 61.5829124,59.4231842 60.6066017,60.3994949 L59.8994949,61.1066017 Z M57.7781746,58.9852814 L58.4852814,58.2781746 C60.633165,56.130291 64.1155724,56.130291 66.263456,58.2781746 L80.4055916,72.4203102 C82.5534752,74.5681938 82.5534752,78.0506012 80.4055916,80.1984848 L79.6984848,80.9055916 C77.5506012,83.0534752 74.0681938,83.0534752 71.9203102,80.9055916 L57.7781746,66.763456 C55.630291,64.6155724 55.630291,61.133165 57.7781746,58.9852814 Z" fill="#000000" fill-rule="nonzero"/>
					<polygon fill="#000000" fill-rule="nonzero" points="53.5355339 56.1568542 55.6568542 54.0355339 61.3313422 59.7100219 59.2100219 61.8313422"/>
					<path d="M60.2305412,60.062352 C60.2156974,59.1476719 60.5572516,58.2282823 61.2552038,57.5303301 L61.9623106,58.2374369 C60.9859999,59.2137476 60.9859999,60.79666 61.9623106,61.7729708 L76.5983496,76.4090097 C77.5746603,77.3853205 79.1575727,77.3853205 80.1338835,76.4090097 L80.8409903,77.1161165 C79.7727482,78.1843586 78.1857792,78.4177222 76.8908994,77.8162074 L74.5,80.2071068 L73.7928932,79.5 L76.0380588,77.2548344 C75.9881251,77.2102751 75.9391621,77.1640358 75.8912428,77.1161165 L75.2411165,76.4659903 L72.5,79.2071068 L71.7928932,78.5 L74.5340097,75.7588835 L73.7411165,74.9659903 L70.5,78.2071068 L69.7928932,77.5 L73.0340097,74.2588835 L72.2411165,73.4659903 L68.9723074,76.7347994 L68.2652006,76.0276926 L71.5340097,72.7588835 L70.7411165,71.9659903 L67.5,75.2071068 L66.7928932,74.5 L70.0340097,71.2588835 L69.2411165,70.4659903 L65.9723074,73.7347994 L65.2652006,73.0276926 L68.5340097,69.7588835 L67.7411165,68.9659903 L64.5,72.2071068 L63.7928932,71.5 L67.0340097,68.2588835 L66.2411165,67.4659903 L63.5,70.2071068 L62.7928932,69.5 L65.5340097,66.7588835 L64.7411165,65.9659903 L61.5,69.2071068 L60.7928932,68.5 L64.0340097,65.2588835 L63.2411165,64.4659903 L60.5,67.2071068 L59.7928932,66.5 L62.5340097,63.7588835 L61.7411165,62.9659903 L58.9504902,65.7566165 L58.2433835,65.0495098 L61.0437599,62.2491333 C60.7882443,61.9439563 60.5929071,61.6054676 60.4577485,61.2493583 L57.9504902,63.7566165 L57.2433835,63.0495098 L60.2305412,60.062352 Z" fill="#000000" fill-rule="nonzero"/>
				</g>
			</svg>
		</div>
	</div>
	
</template>

<script>
  	var comp = {
		props: ['spots', 'redirect'],
		data() {
			return {
				delayTimer: null,
				provider: null,
				mymap: null,
			}
		},
		mounted() {
			this.initMap();
			if(this.redirect) this.cssUpdate();
		},
		methods: {
			initMap() {
				var self = this;
				this.mymap = L.map('map').setView([45.33707006, 34.53894877], 4);
				L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				    attribution: '',
				    minZoom: 2,
				}).addTo(this.mymap);
			 	var markers = L.markerClusterGroup();
			    for(var i = 0; i < this.spots.length; i++) {
			    	var marker = new L.marker([this.spots[i].lat, this.spots[i].lng]);
			    	
			    	marker.url = "/spot/" + this.spots[i].id;
			    	marker.spot_id = this.spots[i].id;
			    	marker.on('click', function() {
			    		if(self.redirect) {
					      window.location.href = this.url;
					    } else {
						  self.$emit('marker-clicked', this.spot_id);
					    }
			    	});
			    	markers.addLayer(marker);
			    }
			    this.mymap.addLayer(markers);

			    this.provider = new GeoSearch.OpenStreetMapProvider();
			},
			enterSearch(e) {
				var self = this;
				var val = e.currentTarget.value;
		        self.provider
				  .search({ query: val })
				  .then(function(result) { 
				    if(result[0]) {
				    	self.mymap.fitBounds(result[0].bounds);
				    } else {
				    	var inputCont = document.querySelector(".map-search-container");
				    	inputCont.classList.add('not-found');
				    	setTimeout(() => {inputCont.classList.remove('not-found')}, 1000);
				    }
				  });
			},
			cssUpdate() {
				document.querySelector('.main-content').classList.add('fullsize-map-container');
				document.querySelector('.main-nav-container').classList.add('main-nav-container-update');
			}
		},
	};

	export default comp;
</script>

<style>
	.custom-map-wrap {
		height: 100%;
		width: 100%;
		position: relative;
	}

	.map-search-container {
		position: absolute;
		top: calc(10px + 64px);
		right: 10px;
		background-color: #fff;
		border: 1px solid #bbb;
    	border-radius: 3px;
	    box-shadow: 0 1px 3px 0 rgba(0,0,0,.25);
        z-index: 1000;
	}

	.not-found {
		animation: warning 0.3s;
	}

	.not-found .map-search-field {
		background-color: rgba(200, 0, 0, 0.1) !important;
	}

	@keyframes warning {
		from {transform: translateX(0px);}
		25% {transform: translateX(10px);}
		50% {transform: translateX(-10px);}
		75% {transform: translateX(10px);}
		to {transform: translateX(0px);}
	}

	.map-search-placeholder {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}

	.map-search-field {
		position: relative;
		width: 40px;
		height: 40px;
		padding: 6px 12px;
		border: none;
		outline: 0;
		opacity: 0;
	    transition: all .175s cubic-bezier(.4,0,.2,1);
		cursor: pointer;
		background-color: #fff;
		z-index: 16;
	}

	.map-search-field:focus + .map-search-placeholder {
		opacity: 0;
	}

	.map-search-field:focus {
		width: 250px;
		opacity: 1;
		cursor: text;
	}

	#map {
		height: 100%;
		width: 100%;
	}

	.pic {
		max-width: 300px;
	}

	.fullsize-map-container {
		padding: 0 !important;
	}

	.main-nav-container-update {
		border: 0;
		box-shadow: 0px 13px 26px 0px rgba(0,0,0,0.09);
	}

	.leaflet-top {
		top: 64px !important;
	}
</style>