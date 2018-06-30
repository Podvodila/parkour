<template>
	<div>
		<div class="spot-page-section images-wrap">
			<h1 class="custom-label">Add spot images</h1>
			<div id="images-container" class="dropzone">
		 		<div class="dz-message" data-dz-message><span class="upload-img-title">Drop files here or click to upload</span></div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['routes'],
		data() {
			return {

			}
		},
		mounted() {
			this.initDropzone();
		},
		methods: {
			initDropzone() {
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
				//console.log(myDropzone.files);
			},
		}
	}
</script>

<style>
	#images-container {
		font-family: 'Nunito';
		border: 0;
	}

	.images-wrap {
		margin-top: 20px;
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
        font-family: 'Nunito';
	    font-size: 20px;
	    padding: 10px;
        box-shadow: 2px 3px 10px rgba(0,0,0,0.1);
        position: absolute;
        top: 0;
        left: 0;
	}

	.upload-img-title {
		font-weight: bold;
		font-size: 32px;
		color: #555;
	}

	.dropzone .dz-preview.dz-image-preview {
		background: transparent !important;
	}
</style>