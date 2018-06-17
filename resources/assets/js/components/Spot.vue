<template>
	<div class="content-container">
		<div class="main-spot-content">
			<div class="spot-page-section">
				<div id="map">
		
				</div>
				<div class="spot-description">
					<h4 class="spot-description-title">Description</h4>
					<p>{{spot.description}}</p>
				</div>
				<div class="spot-videos">
					<transition-group class="tricks-container" tag="div" name="videos" mode="out-in">
						<div v-for="video in currentVideos(currentTrick)" :key="video.id" class="trick-container card">
							<h3 class="card-header custom-card-header custom-card-header-full-videos custom-card-header-mute">
								<span>{{getDate(video.created_at, 'year')}}</span>
								<span>{{getDate(video.created_at, 'dm')}}</span>
							</h3>
							<div class="card-body custom-card-body">
								<app-video :video="video"></app-video>
							</div>
						</div>
					</transition-group>
				</div>
				<div class="spot-comments">
					
				</div>
			</div>
		</div>
		<aside class="aside-content">
			<div class="images-container spot-page-section">
				
			</div>
			<div class="spot-elements spot-page-section">
				<h3 class="spot-elements-title">List of elements</h3>
				<ul class="spot-elements-list">
					<li v-for="trick in tricks" 
						@click="currentVideos(trick.id).length > 0 ? currentTrick = trick.id : ''" 
						class="spot-elements-list-item" 
						:class="{'spot-elements-list-item-active' : currentTrick == trick.id, 'with-video' : currentVideos(trick.id).length > 0}">
						<span>{{trick.name}}</span>
						
						<template v-if="currentVideos(trick.id).length > 0">
							<svg v-if="currentTrick != trick.id" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
								<path d="M80.478,41.123c-3.61-0.95-8,4.17-10.83,4.38c-0.41-4.94,0.16-3.6-2.01-6.05c2.31-3.72,4.28-7.73,3.42-12.26  c-3.02-15.91-20.46-11.99-25.19-6.87c-1.89,2.05-1.71,3.61-2.95,5.3c-0.61-0.23-8.08-7.71-15.19-0.59  c-6.96,6.97,0.57,12.19,1.47,15.6l-3.97,0.11c-1.24,2.62-0.14,4.57-0.89,7.24c-2.57,0.73-3.3-0.45-5.47,1.49  c-0.26,1.55-0.46,6.2-0.08,7.64c0.77,2.91,3.78,1.76,6.04,2.4c1.25,4.42-0.79,5.86,6.26,6.17c3.42,0.15,8.96-0.43,12.03,0.19  c-0.2,2.82-9.91,14.44-6.66,18.29c3.69,0.27,7.03-10.76,9.64-13.72c2.9,2.5,4.43,14.12,9.94,12.23c1.33-4.05-6.89-11.47-6.76-16.2  c3.12-2.27,14.41,0.24,18.88-0.5c2.13-1.69,1.39-1.93,1.89-4.37c3.08,0.19,7.16,4.92,10.53,1.89c0.56-3.36,0.11-8.18,0.19-11.74  C80.838,48.643,82.378,43.753,80.478,41.123z M21.948,55.933l-0.23-4.37l2.56-0.72l0.28,4.6  C22.958,56.323,23.488,56.443,21.948,55.933z M45.068,38.603l2.58,1.95l-4.34,0.19L45.068,38.603z M28.108,31.883  c0-3.12,2.94-6.06,6.06-6.34c2.68-0.24,6.24,2.31,8.15,4.06c0.91,5.26,1.31,8.57-5.46,9.55  C32.868,39.733,28.108,35.413,28.108,31.883z M65.568,61.403c-3.45,0.97-32.48,0.54-36.17-0.5c-0.03-0.11-1.79-16.09-1.79-16.1  l0.21-1.7c1.03-0.25,37.28-0.12,37.75,0.01C65.608,43.223,65.598,61.303,65.568,61.403z M48.938,37.393  c-1.23-1.98-2.94-5.7-2.94-7.99c0-13.78,21.18-15.38,21.39-0.5C67.568,41.983,51.528,41.563,48.938,37.393z M76.998,59.913  c-1.46,0-6.05-2.95-7.35-3.98l-0.83-5.93c1.43-1.45,7.56-5.28,9.18-5.4C78.598,46.733,77.658,57.573,76.998,59.913z"/>
								<path d="M33.878,48.083c-1.29,2.47-0.92,7.67,0.29,10.04c2.26,1.15,13.23,0.38,16.1-0.1c2.46-2.08,2.79-6.97,1.79-9.84  C49.348,45.893,36.858,46.523,33.878,48.083z M48.578,55.343c-1.99,0.69-10.17,0.68-12.22,0.1l-0.61-4.77  c2.2-0.7,10.76-0.72,12.93-0.1C49.158,52.273,49.168,53.643,48.578,55.343z"/>
								<path d="M58.118,24.633c-0.34,3.25,3.14,5.16,0.1,8.54c-2.62,0.44-5.44-0.18-4.58-3.55c0.53-2.06,2.7-3.53,3.09-5.49  c-5.58-3.97-12.5,11.17-0.52,12.92C66.798,38.603,64.738,18.683,58.118,24.633z"/>
								<path d="M38.938,31.683c-1.82,0.71-0.88,1.32-2.08,2.98l-1.91-0.06c-2.73-3.61,1.19-3.3,2.5-5.3c-1.91-4.1-9.69,0.12-6.46,5.66  C34.298,40.653,43.238,35.273,38.938,31.683z"/>
								<path d="M56.528,48.883c0.93,4.92,6.04,1.27,3.78-1C58.488,46.953,57.568,47.043,56.528,48.883z"/>
								<path d="M56.428,53.753c-0.66,2.05,0.22,2.82,2.29,2.78l1.24-1.6C58.888,53.073,58.268,52.883,56.428,53.753z"/>
							</svg>
							<svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" x="0px" y="0px">
								<g data-name="video, play, movie, cinema, film">
									<path class="svg-circle" d="M50,6A44,44,0,1,0,94,50,44.05,44.05,0,0,0,50,6Zm0,84A40,40,0,1,1,90,50,40,40,0,0,1,50,90Z"/>
									<path d="M78,50A28,28,0,1,0,50,78,28,28,0,0,0,78,50ZM26,50A24,24,0,1,1,50,74,24,24,0,0,1,26,50Z"/>
									<path d="M41.37,31.9V68.1L68.61,50Zm4,7.46L61.39,50l-16,10.64Z"/>
									<path class="svg-line" d="M50,18V14A36,36,0,0,0,14,50h4A32,32,0,0,1,50,18Z"/>
									<path class="svg-line" d="M82,50A32,32,0,0,1,50,82v4A36,36,0,0,0,86,50Z"/></g>
							</svg>
						</template>
						
					</li>
				</ul>
			</div>
		</aside>
	</div>
</template>

<script>
	import appVideo from './Video.vue';

	export default {
		props: ['routes', 'images', 'spot', 'tricks_src', 'videos'],
		data() {
			return {
				currentTrick: null,
				tricks: null,
			}
		},
		computed: {
		},
		created() {
			console.log(this.images);
			this.tricks = this.sortTricks();
			this.currentTrick = this.tricks[0].id;
		},
		mounted() {
			if(window.mapLoaded === undefined) {
				var heh = document.querySelector('#googleMap');
				heh.addEventListener('load', this.initMap);
			} else {
				this.initMap();
			}
		},
		methods: {
			initMap() {
				var self = this;
				var map = new google.maps.Map(document.querySelector("#map"), {
					zoom: 12,
					center: {lat: self.spot.lat, lng: self.spot.lng }
				});

				var marker = new google.maps.Marker({
				  position: {lat: self.spot.lat, lng: self.spot.lng },
				  map: map,
				});
			},
			getUserRoute(id) {
				return this.routes.user.replace('0', id);
			},
			currentVideos(trick_id) {
				return this.videos.filter(function(video) {
					return video.trick_id == trick_id;
				});
			},
			getDate(date, type) {
				var arr = date.split(' ')[0].split('-');
				if(type == 'year') {
					return arr[0];
				} else if(type == 'dm') {
					return arr[2] + '-' + arr[1];
				}
			},
			sortTricks() {
				var self = this;
				return this.tricks_src.sort(function(a, b) {
					if(self.currentVideos(a.id) > self.currentVideos(b.id)) {
						return -1;
					} else if(self.currentVideos(a.id) < self.currentVideos(b.id)) {
						return 1;
					}
					return 0;
				});
			},
		},
		components: {
			appVideo,
		},
	}
</script>

<style>
	#app {
		overflow: visible;
	}

	#map {
		height: 332px;
	}

	.content-container {
		width: 100%;
		display: flex;
		margin-top: 40px;
		color: #515669;
		font-family: 'Nunito';
	    font-weight: normal;
	}

	.main-spot-content {
		width: 850px;
		padding: 0 10px;
	}

	.aside-content {
		width: 350px;
		padding: 0 10px;
	}

	.spot-page-section {
		border-radius: 3px;
		box-shadow: 0 1px 2px rgba(0,0,0,.1);
		background-color: #fff;
	}

	.images-container {
		height: 312px;
		margin-bottom: 20px;
		width: 100%;
	}

	.spot-elements {
		position: sticky;
		top: 10px;
		padding: 20px;
	}

	.spot-elements-title {
		font-size: 22px;
		margin-bottom: 20px;
	}

	.spot-elements-list {
		display: flex;
		flex-direction: column;
		align-items: flex-end;
		font-size: 18px;
	}

	.spot-elements-list li {
		cursor: pointer;
		margin-bottom: 10px;
	}

	.spot-description {
		padding: 30px;
	}

	.spot-description p {
		font-size: 20px;
	}

	.spot-description-title {
	    color: #82889c;
	    font-size: 16px;
	    margin-bottom: 10px;
	}

	.spot-videos {
		padding: 30px;
		border-top: 1px solid #efefef;
	}

	.tricks-container {
		width: 100%;
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		align-items: flex-start;
	}

	.trick-container {
        width: 370px;
    	margin-bottom: 30px;
	}

	.custom-video {
		max-height: 250px !important;
	}

	.custom-card-header {
		font-size: 16px;
		font-family: 'Nunito';
		font-weight: normal;
		background-color: #f2f2f4;
		display: flex;
		justify-content: space-between;
		position: relative;
	}

	.custom-card-body {
	    background-color: #efefef;
	    background-image: url(/images/noiseImg.png);
	}

	.videos-enter-active {
        animation: videosShow .5s;
    }

    .videos-leave-active {
        animation: videosHide .5s;
    }

    @keyframes videosShow {
    	from {opacity: 0;}
    	to {opacity: 1;}
    }

    @keyframes videosHide {
    	from {opacity: 1; position: absolute;}
    	to {opacity: 0; position: absolute;}
    }

    .spot-elements-list-item {
    	display: flex;
    	transition: .5s;
    }

    .spot-elements-list-item:not(.with-video) {
    	cursor: default;
    }

    .spot-elements-list-item span {
    	transition: .5s;
    }

    .spot-elements-list-item-active span {
    	transform: translateX(-30px);
    	pointer-events: none;
    	font-weight: bold;
    }

    .spot-elements-list-item span {
    	align-self: center;
    }

    .spot-elements-list-item:hover span.with-video {
    	font-weight: bold;
    }

    .spot-elements-list-item svg {
    	width: 30px;
    	height: 30px;
    	transition: .5s;
    }

    .spot-elements-list-item:hover svg {
    	transform: scale(-1, 1);
    }

    .spot-elements-list-item-active:hover svg {
    	transform: none;
    }

    .spot-elements-list .spot-elements-list-item-active {
    	cursor: default;
    }

    .svg-line {
    	transition: .5s;
    	transform: rotate(0deg);
    	transform-origin: center center;
    }

    .svg-circle {
    	transition: .5s;
    	transform: scale(1, 1);
    	transform-origin: center center;
    }

    .spot-elements-list-item-active svg:hover .svg-line {
    	transform: rotate(180deg);
    }

    .spot-elements-list-item-active svg:hover .svg-circle {
    	transform: scale(-1, 1);
    }
</style>