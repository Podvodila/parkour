<template>
	<div class="content-container">
		<div class="main-spot-content">
			<div class="spot-page-section map-wrap">
				<div id="map"></div>
				<div class="custom-label-wrap">
					<h1 class="custom-label">{{local['location of spot']}}</h1>
				</div>
			</div>
			<div class="spot-page-section description-wrap">
				<h1 class="custom-label">{{local['description']}}</h1>
				<textarea class="form-control description-field" rows="3" v-model="description"></textarea>
			</div>
			<div class="spot-page-section tricks-wrap">
				<h1 class="custom-label">{{local['moves']}}</h1>
				<div class="selected-tricks">
					<h3 class="selected-tricks-title">{{local['selected moves']}}:</h3>
					<transition-group tag="ul" name="selected-tricks" class="list-group selected-tricks-list">
	  					<li class="list-group-item" 
	  					v-for="(trick, index) in selectedTricks" 
	  					:key="trick.id"
	  					@click="toUnselected(trick, index)">{{trick.name}}</li>
	  				</transition-group>
				</div>
				<div class="unselected-tricks">
					<input class="form-control search-tricks" type="search" :placeholder="local['search']" v-model="search">
					<transition-group tag="ul" name="unselected-tricks" class="list-group unselected-tricks-list">
	  					<li class="list-group-item" 
	  						v-for="(trick, index) in unselectedTricks" 
	  						v-if="isSearched(trick.name)" 
	  						:key="trick.id"
	  						@click="toSelected(trick, index)">{{trick.name}}</li>
	  				</transition-group>
  				</div>
			</div>
			<button class="btn btn-success custom-submit" :class="{disabled: !canSubmit}" @click="spotAdd">{{local['create spot']}}</button>
		</div>
		<aside class="aside-content"">
			<div class="spot-page-section images-wrap">
				<h1 class="custom-label">{{local['images']}}</h1>
				<div id="images-container" class="dropzone">
			 		<div class="dz-message" data-dz-message><span class="upload-img-title">{{local['drop files']}}</span></div>
				</div>
			</div>
		</aside>
		<transition-group name="alerts" tag="div" class="custom-alert-container">
			<template v-for="(response, key) in responses">
					<Alert :msg="response.msg" :error="response.error" v-if="response.show" :key="response.key"></Alert>
			</template>
		</transition-group>
	</div>
</template>

<script>
	import Alert from './Alert.vue';

	export default {
		props: ['routes', 'tricks', 'src_local'],
		data() {
			return {
				location: null,
				unselectedTricks: this.tricks,
				selectedTricks: [],
				search: '',
				description: '',
				canSubmit: true,
				mapMarker: null,
				local: this.src_local,
				responses: [],
				customKey: 10,
			}
		},
		computed: {
			selectedTricksId() {
				var arr = [];
				for(var i = 0; i < this.selectedTricks.length; i++) {
					arr.push(this.selectedTricks[i].id);
				}
				return arr;
			},
		},
		mounted() {
			this.initDropzone();
			if(window.mapLoaded === undefined) {
				var heh = document.querySelector('#googleMap');
				heh.addEventListener('load', this.initMap);
			} else {
				this.initMap();
			}

			eventBus.$on('changeLocale', (data) => {this.local = data});
		},
		methods: {
			initDropzone() {
				Dropzone.autoDiscover = false;
				window.myDropzone = new Dropzone(document.querySelector("#images-container"), {
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
			},
			initMap() {
				var self = this;

				var mymap = L.map('map', {zoomControl: false}).setView([45.33707006, 34.53894877], 4);
				L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				    attribution: '',
				    minZoom: 2,
				}).addTo(mymap);

				L.control.zoom({
			    	position:'topright'
				}).addTo(mymap);

				mymap.on('click', function(e) {
		          self.placeMarker(e.latlng, mymap);
		        });
			},
			placeMarker(latLng, map) {
				
				if(this.mapMarker != null) {
					map.removeLayer(this.mapMarker);
				}
				this.mapMarker = new L.marker(latLng);
				map.addLayer(this.mapMarker);
				this.location = `${latLng.lat} ${latLng.lng}`;
			},
			isSearched(name) {
				return name.toLowerCase().includes(this.search.toLowerCase());
			},
			toSelected(item, index) {
				if(this.selectedTricks.indexOf(item) == -1) {
					this.selectedTricks.push(item);
					this.unselectedTricks.splice(index, 1);
				}
			},
			toUnselected(item, index) {
				if(this.unselectedTricks.indexOf(item) == -1) {
					this.unselectedTricks.push(item);
					this.selectedTricks.splice(index, 1);
				}
			},
			spotAdd() {
				var self = this;
				self.canSubmit = false;
				var form = new FormData();
				if(self.location !== null) form.append('location', self.location);
				form.append('description', self.description);
				form.append('_token', $('meta[name="csrf-token"]').attr('content'));
				for(var i = 0; i < self.selectedTricksId.length; i++) {
					form.append('move[]', self.selectedTricksId[i]);
				}

				for(var i = 0; i < window.myDropzone.files.length; i++) {
					form.append('image[]', window.myDropzone.files[i], window.myDropzone.files[i].name);
				}
				
				$.ajax({
    			  method: "post",
    			  url: self.routes.spotAdd,
        		  contentType: false,  
        		  processData:false, 
    			  headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  },
    			  data: form,
    			  success: function(data) {
    			  	window.location.href = data;
    			  },
                  error: function(data, b, c) {
                  	for(var key in data.responseJSON.errors) {
                  		var response = {};
	                    response.msg = data.responseJSON.errors[key][0];
	    			  	response.error = true;
	    			  	response.show = true;
	    			  	response.key = self.customKey++;
	    			  	self.responses.push(response);
	    			  	setTimeout(()=> {
	                        self.responses.shift();
	                    }, 5000);
                  	}
                  	self.canSubmit = true;
                  }
				});
			},
		},
		components: {
			Alert,
		},
	}
</script>

<style>
	#images-container {
		font-family: 'Nunito', 'Arial';
		border: 0;
		padding-top: 30px;
	}

	#map {
		width: 100%;
		height: 332px;
	}

	.images-wrap {
		border: 2px dashed #0087F7;
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

	.spot-page-section {
		border-radius: 3px;
		box-shadow: 0 1px 2px rgba(0,0,0,.1);
		background-color: #fff;
		position: relative;
	}

	.custom-label {
		background-color: #565656;
  		color: transparent;
		text-shadow: 0px 2px 3px rgba(255,255,255,0.5);
		-webkit-background-clip: text;
     	-moz-background-clip: text;
        background-clip: text;
        font-family: 'Nunito', 'Arial';
	    font-size: 20px;
	    padding: 10px;
        box-shadow: 2px 3px 10px rgba(0,0,0,0.1);
        position: absolute;
        top: 0;
        left: 0;
	}

	.custom-label-wrap {
		position: absolute;
		top: 0;
		left: 0;
		background-color: #fff;
		z-index: 1000;
	}

	.custom-label-wrap .custom-label {
		position: static;
	}

	.upload-img-title {
		font-weight: bold;
		font-size: 32px;
		color: #555;
	}

	.dropzone .dz-preview.dz-image-preview {
		background: transparent !important;
	}

	.content-container {
		width: 100%;
		display: flex;
		margin-top: calc(40px + 64px);
		color: #515669;
		font-family: 'Nunito', 'Arial';
	    font-weight: normal;
	    position: relative;
	}

	.main-spot-content {
		width: 830px;
		padding: 0 10px;
	}

	.aside-content {
		width: 370px;
		padding: 0 10px;
	}

	.map-wrap {
		position: relative;
	}

	.description-wrap {
		position: relative;
		margin-top: 20px;
		min-height: 150px;
		overflow: hidden;
		padding: 20px;
	}

	.description-field {
	    margin-top: 40px;
	}

	.tricks-wrap {
		display: flex;
		justify-content: space-between;
		margin-top: 20px;
		overflow: hidden;
		padding: 20px;
	}

	.selected-tricks {
		margin-top: 40px;
	}

	.selected-tricks-list {
		margin-left: 20px;
	}

	.unselected-tricks-list .list-group-item {
		text-align: right;
	}

	.unselected-tricks {
		max-width: 300px;
	}

	.selected-tricks-title {
		color: #555;
		font-weight: bold;
		font-size: 20px;
		margin-bottom: 10px;
	}

	.search-tricks {
		margin-bottom: 20px;
	}

	.unselected-tricks-list {
		align-items: flex-end;
	}

	.selected-tricks-list {
		align-items: flex-start;
	}

	.unselected-tricks-list .list-group-item,
	.selected-tricks-list .list-group-item {
	  transition: opacity .5s, transform .5s, color .1s, background-color .1s;
	  display: inline-block;
	  cursor: pointer;
	  width: 200px;
	}

	.unselected-tricks-list .list-group-item:hover {
		color: #155724;
    	background-color: #c3e6cb;
    	/*transform: translateX(-10px);*/
	}

	.selected-tricks-list .list-group-item:hover {
		color: #721c24;
    	background-color: #f5c6cb;
    	/*transform: translateX(10px);*/
	}

	.unselected-tricks-enter, .unselected-tricks-leave-to,
	.selected-tricks-enter, .selected-tricks-leave-to {
	  opacity: 0;
	  transform: translateY(-30px);
	}

	.unselected-tricks-leave-active,
	.selected-tricks-leave-active {
	  position: absolute;
	}

	.custom-submit {
		margin-top: 15px;
		margin-bottom: 15px;
		cursor: pointer;
	}

	.disabled {
		pointer-events: none;
	}

	.custom-alert-container {
    	position: fixed;
    	top: 70px;
    	display: flex;
    	flex-direction: column;
    	z-index: 2000;
    	transition: .2s;
    }

    .custom-alert-container .alert {
		transition: .2s;
    }

    .alerts-enter, .alerts-leave-to {
	  opacity: 0;
	  transform: translateY(30px);
	}
	.alerts-leave-active {
	  position: absolute;
	}

	@media(max-width: 1267px) {
		.content-container {
			justify-content: center;
		}

		.main-spot-content {
			width: 630px;
		}

		.aside-content {
			width: 270px;
		}

		.upload-img-title {
			font-size: 23px;
		}
	}

	@media(max-width: 970px) {
		.main-spot-content {
			width: 500px;
		}

		.aside-content {
			width: 200px;
		}

		.images-wrap .custom-label {
			font-size: 15px;
		}

		.upload-img-title {
			font-size: 18px;
		}

		.selected-tricks-list {
			margin-left: 0px;
		}
	}

	@media(max-width: 970px) {
		.content-container {
			flex-direction: column;
			align-items: center;
		}

		.aside-content {
			order: 1;
			width: 500px;
			margin-bottom: 20px;
		}

		.main-spot-content {
			order: 2;
		}

		.upload-img-title {
			font-size: 26px;
		}

		.images-wrap .custom-label {
			font-size: 20px;
		}

		main.main-content {
			padding: 0px 10px;
		}
	}

	@media(max-width: 521px) {
		.aside-content,
		.main-spot-content {
			width: 390px;
		}

		.unselected-tricks-list .list-group-item,
		.selected-tricks-list .list-group-item {
			width: 140px;
			font-size: 14px;
		}

		.search-tricks {
			font-size: 12px;
		}
	}

	@media(max-width: 410px) {
		.aside-content,
		.main-spot-content {
			width: 340px;
		}

		.unselected-tricks-list .list-group-item,
		.selected-tricks-list .list-group-item {
		    width: 130px;
    		font-size: 13px;
		}
	}

	@media(max-width: 359px) {
		main.main-content {
			padding: 0px;
		}

		.aside-content,
		.main-spot-content {
		    width: 320px;
		}

		.unselected-tricks-list .list-group-item,
		.selected-tricks-list .list-group-item {
		    width: 120px;
    		font-size: 13px;
		}
	}
</style>