<template>
	<div class="main-wrap">
		<div class="first-block">
			<img :src="images_path + 'parkour_1.jpg'" class="first-block-bg-img">
			<div class="first-block-content-container">
				<div class="first-block-content">
					<h1 class="first-block-title">{{local['main title']}}</h1>
					<a :href="routes.find" class="btn btn-outline-info custom-btn-find-spot">{{local['find a spot']}}</a>
				</div>
			</div>
		</div>
		<div class="second-block">
			<div class="second-block-content">
				<div class="second-block-img-wrap">
					<img :src="images_path + 'map.jpg'" class="second-block-img second-block-first-img" 
					 :class="{'active-animation' : (focusImg == 1)}"
					 @mouseover="changeFocusImg(1)">
					<img :src="images_path + 'video_example.jpg'" class="second-block-img second-block-second-img" 
					 :class="{'active-animation' : (focusImg == 2)}"
					 @mouseover="changeFocusImg(2)">
				</div>
				<div class="second-block-title-container">
					<h3 class="second-block-title" :class="{'active-title' : (focusImg == 1)}">
						{{local['find a spot title']}}
					</h3>
					<h3 class="second-block-title" :class="{'active-title' : (focusImg == 2)}">
						{{local['share videos']}}
					</h3>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['images_path', 'routes', 'src_local'],
		data() {
			return {
				focusImg: 2,
				changeFocusImgTimeout: null,
				local: this.src_local,
			}
		},
		mounted() {
			this.classOptimize();
			eventBus.$on('changeLocale', (data) => {this.local = data});
		},
		methods: {
			classOptimize() {
				document.querySelector('.main-content').classList.remove('main-content');
			},
			changeFocusImg(img) {
				if(this.changeFocusImgTimeout || this.focusImg == img) return;
				this.focusImg = img
				this.changeFocusImgTimeout = setTimeout(() => this.changeFocusImgTimeout = null, 800);
			},
		}
	}
</script>

<style>
	body {
		background-color: #fff;
	}

	.main-wrap {
		width: 100%;
		height: 100%;
	}

	.first-block,
	.second-block {
		width: 100%;
		height: 100vh;
		position: relative;
	}

	.first-block-bg-img {
		position: absolute;
		top: 0;
		left: 0;
		z-index: -1;
		width: 100%;
		height: 100%;
		object-fit: cover;
	    filter: brightness(90%);
		/*filter: blur(1px);*/
		/*margin: -5px -10px -10px -5px;*/
	}

	.first-block-title {
		font-family: 'Nunito', 'Arial';
		font-weight: bold;
		font-size: 62px;
		color: #fff;
	    width: 80vw;
    	text-align: center;
	}

	.first-block-content {
		display: flex;
		flex-direction: column;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.second-block-content {
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		height: 100%;
	}

	.first-block-content-container {
		/*background-color: rgba(255, 255, 255, 0.5);*/
		width: 100%;
		height: 100%;
	}

	.custom-btn-find-spot {
	    margin: 20px auto 0px;
	    font-size: 24px;
	    cursor: pointer;
	    font-family: 'Nunito', 'Arial';
	    background-color: rgba(0, 0, 0, 0.15);
	}

	.custom-btn-find-spot:hover, 
	.custom-btn-find-spot:focus, 
	.custom-btn-find-spot:active {
		 background-color: #17a2b8; 
	     border-color: #17a2b8; 
	     color: #fff;
	}

	.second-block-img {
		box-shadow: 0px 85px 109px 0px rgba(0,0,0,0.15);
		position: relative;
		z-index: 10;
		filter: blur(2px);
		border-radius: 5px;
		/*animation-fill-mode: forwards;
		animation-play-state: paused;*/
		/*transition: .5s;*/
	}

	.second-block-img-wrap {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.second-block-first-img {
		transform: translate3d(-30px, 30px, 0);
	}

	.second-block-first-img.active-animation {
		animation: firstImgShow .8s forwards ease;
	}

	.second-block-second-img {
		transform: translate3d(30px, -30px, 0);
	}

	.second-block-second-img.active-animation {
		animation: secondImgShow .8s forwards ease;
	}

	@keyframes firstImgShow{
		from {
			transform: translate3d(-30px, 30px, 0);
			z-index: 9;
		}
		49% {
			z-index: 9;
		}
		50% {
			transform: translate3d(-30px, -30px, 0);
			z-index: 11;
			filter: blur(0px);
		}
		to {
			transform: translate3d(-30px, 30px, 0);
			z-index: 11;
			filter: blur(0px);
		}
	}

	@keyframes secondImgShow{
		from {
			transform: translate3d(30px, -30px, 0);
			z-index: 9;
		}
		49% {
			z-index: 9;
		}
		50% {
			transform: translate3d(30px, 30px, 0);
			z-index: 10;
			filter: blur(0px);
		}
		to {
			transform: translate3d(30px, -30px, 0);
			z-index: 11;
			filter: blur(0px);
		}
	}

	.second-block-title-container {
		display: flex;
		flex-direction: column;
		justify-content: center;
	    margin-left: 50px;
	    align-items: flex-end;
	    height: 100%;
	}

	.second-block-title {
		font-family: 'Nunito', 'Arial';
		font-size: 34px;
		color: #777;
		transition: 1s;
		text-align: right;
		max-width: 400px;
	}

	.second-block-title:nth-child(1) {
		margin-bottom: 150px;
	}

	.second-block-title.active-title {
		color: #444;
		/*font-weight: bold;*/
		transform: scale(1.1);
	}
</style>