<template>
	<div class="custom-video-container">
		<video :src="src" class="custom-video" ref="video"></video>
		<div class="video-play-button" ref="play" :class="{removed: videoStopped}">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" @click="playVideo">
				<path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path>
			</svg>
		</div>
		<div class="bot-menu" ref="menu" :class="{removed: videoStopped == false}">
			<div class="svg-container" @click="switchVideo">
				<svg version="1.1" viewBox="0 0 36 36" class="svg">
					<path v-if="videoPlaying" class="ytp-svg-fill" d="M 12,26 16,26 16,10 12,10 z M 21,26 25,26 25,10 21,10 z">
						<animate ref="anime" class="but-play" attributeName="d" attributeType="XML" dur=".2s" begin="none" fill="freeze" from="M 12,26 18.5,22 18.5,14 12,10 z M 18.5,22 25,18 25,18 18.5,14 z" to="M 12,26 16,26 16,10 12,10 z M 21,26 25,26 25,10 21,10 z" />
					</path>
					<path v-else class="ytp-svg-fill" d="M 12,26 18.5,22 18.5,14 12,10 z M 18.5,22 25,18 25,18 18.5,14 z">
						<animate ref="anime" class="but-play" attributeName="d" attributeType="XML" dur=".2s" begin="none" fill="freeze" from="M 12,26 16,26 16,10 12,10 z M 21,26 25,26 25,10 21,10 z" to="M 12,26 18.5,22 18.5,14 12,10 z M 18.5,22 25,18 25,18 18.5,14 z" />
					</path>
				</svg>
			</div>
			<div class="bot-menu-icon-wrap">
				<div 
					class="svg-container" 
					v-if="spot_page"
					@mouseover="tip.msg='Tracer'; tip.show=true;"
					@mouseout="tip.show=false"
					>
					<a :href="'/profile/' + video.user_id" target="_blank" class="svg-wrapper">
						<svg class="svg svg-tracer" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><g><path d="M70.1,66.1c-3,3.6-7,6.8-12.2,8.7c-2.5,0.9-5.2,1.4-7.9,1.4c-2.7,0-5.3-0.4-7.8-1.3c-5.2-1.8-9.3-5-12.3-8.7   c-4.3,2.3-11.8,6.5-19.6,12.2C19.2,90.6,33.7,98.6,50,98.6c16.3,0,30.8-8,39.7-20.3C81.9,72.6,74.4,68.4,70.1,66.1L70.1,66.1z"/><path d="M24.5,44.9c0.6,2,1.6,5.8,4,8c1.8,6.6,7,14.3,15.4,17.3c2,0.7,4.1,1.1,6.3,1.1c2.1,0,4.2-0.4,6.2-1.1   c8.4-3,13.6-10.6,15.4-17.3c2.4-2.2,3.4-6,4-8c0.9-3.2,1.8-7.7-0.6-10.9c-0.1-0.1-0.2-0.2-0.3-0.4c0.2-1.1,0.3-2.2,0.4-3.2   c2.8-18.8-7.6-20-8.8-20c-0.1,0-0.1-0.1-0.2-0.1c-1.2-4.9-8.2-10-14.8-8.7C45,3,31.4,1.4,31.4,1.4c-0.2,2.9,2.3,4.9,2.3,4.9   c-11.5,7-9.4,22-8.3,27.3c-0.1,0.1-0.2,0.2-0.3,0.4C22.7,37.2,23.6,41.7,24.5,44.9z M30.5,36.1c0.1,0,0.2,0,0.3,0c0,0,0-0.1,0-0.1   c-0.3-1-1.7-6.7,3.2-10.1c4,0.9,10,1.1,18.2-2.4C68,16.7,69.4,36.1,69.4,36.1v0c0.1,0,0.2,0,0.3,0c1.6,0,3.3,1.3,1.5,7.5   c-1.4,4.9-2.7,6.3-3.6,6.3c-0.9,5.8-5.4,13.2-12.8,15.8c-1.5,0.5-3.1,0.8-4.7,0.8c-1.6,0-3.2-0.3-4.7-0.8   c-7.3-2.6-11.9-10-12.8-15.8c-1-0.1-2.3-1.4-3.6-6.3C27.2,37.3,28.9,36.1,30.5,36.1z"/></g></svg>
					</a>
				</div>
				<div 
					class="svg-container" 
					v-else-if="video.spot_id"
					@mouseover="tip.msg='View on map'; tip.show=true;"
					@mouseout="tip.show=false"
					>
					<a :href="'/spot/' + video.spot_id" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" 
						style="enable-background:new 0 0 100 100;" xml:space="preserve" class="svg svg-map">
							<path d="M60.6,30c0-5.5-4.5-10-10.1-10c-5.6,0-10.1,4.5-10.1,10s4.5,10,10.1,10C56.1,40,60.6,35.5,60.6,30z M44.4,30  c0-3.3,2.7-6,6.1-6s6.1,2.7,6.1,6s-2.7,6-6.1,6S44.4,33.3,44.4,30z M50,64.8l1.4-1.4C67.9,47.1,69.2,35.2,69.2,32v-2  c0-10.5-8.6-19-19.2-19s-19.2,8.5-19.2,19v2c0,3.2,1.3,15.1,17.8,31.4L50,64.8z M34.8,30c0-8.3,6.8-15,15.2-15  c8.4,0,15.2,6.7,15.2,15v2c0,2-0.8,12.3-15.2,27.1C35.6,44.3,34.8,33.9,34.8,32V30z M94.8,75.7L72.7,89l-22.4-7.4  c-0.2-0.1-0.4-0.2-0.5-0.3c-0.2,0.1-0.3,0.2-0.5,0.3L26.9,89L4.8,75.7l11.9-42.9L29,40.2c1,0.6,1.3,1.8,0.7,2.7  c-0.6,0.9-1.8,1.2-2.8,0.7L19.2,39L9.5,73.8L26,83.8l3.8-33c0.1-1.1,1.1-1.9,2.2-1.8c1.1,0.1,1.9,1.1,1.8,2.2l-3.8,32.5L48,77.8  c0,0,0,0,0,0v-6.9c0-1.1,0.9-2,2-2c1.1,0,2,0.9,2,2v7c0,0,0,0,0,0L70,83.9l-3.8-32.7c-0.1-1.1,0.7-2.1,1.8-2.2  c1.1-0.1,2.1,0.7,2.2,1.8L74,83.5l16.1-9.7L80.4,39l-7.7,4.6c-1,0.6-2.2,0.3-2.8-0.7c-0.6-0.9-0.3-2.2,0.7-2.7l12.3-7.4L94.8,75.7z"/>
						</svg>
					</a>
				</div>
				<div class="svg-container" @click="switchFullscreen">
					<svg version="1.1" viewBox="0 0 36 36" class="svg svg-expand">
						<g class="ytp-fullscreen-button-corner-0">
							<path class="ytp-svg-fill" d="m 10,16 2,0 0,-4 4,0 0,-2 L 10,10 l 0,6 0,0 z" id="ytp-id-23"></path>
						</g>
						<g class="ytp-fullscreen-button-corner-1">
							<path class="ytp-svg-fill" d="m 20,10 0,2 4,0 0,4 2,0 L 26,10 l -6,0 0,0 z" id="ytp-id-24"></path>
						</g>
						<g class="ytp-fullscreen-button-corner-2">
							<path class="ytp-svg-fill" d="m 24,24 -4,0 0,2 L 26,26 l 0,-6 -2,0 0,4 0,0 z" id="ytp-id-25"></path>
						</g>
						<g class="ytp-fullscreen-button-corner-3">
							<path class="ytp-svg-fill" d="M 12,20 10,20 10,26 l 6,0 0,-2 -4,0 0,-4 0,0 z" id="ytp-id-26"></path>
						</g>
					</svg>
				</div>
			</div>
		</div>
		<tip :msg="tip.msg" v-if="showTip"></tip>
	</div>
</template>

<script>
	import Tip from './Tip.vue';

	export default {
		props: ['video', 'spot_page'],
		data() {
			return {
				videoPlaying: false,
				videoOnPause: false,
				src: this.video.path,
				tip: {
					show: false,
					msg: '',
				},
			}
		},
		created() {
			this.videoOnEnd();
		},
		computed: {
			videoStopped() {
				return this.videoPlaying || this.videoOnPause || (document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen);
			},
			showTip() {
				return this.tip.show && !(document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen);
			},
		},
		methods: {
			playVideo() {
				var self = this;
				$(function() {
					self.$refs.video.play();
					self.videoPlaying = true;
				});
			},
			switchVideo() {
				if(this.videoPlaying) {
					this.$refs.video.pause();
					this.videoPlaying = false;
					this.videoOnPause = true;
				} else {
					this.$refs.video.play();
					this.videoPlaying = true;
					this.videoOnPause = false;
				}
			},
			videoOnEnd() {
				var self = this;
				$(function() {
					self.$refs.video.onended = function() {
						self.videoPlaying = false;
					};
				});
			},
			switchFullscreen() {
				var elem = this.$refs.video;
				var isFullscreen = document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen;
				if(isFullscreen) {
					if (elem.exitFullScreen) {
					  elem.exitFullscreen();
					} else if (elem.webkitExitFullScreen) {
					  elem.webkitExitFullScreen();
					} else if (elem.mozExitFullScreen) {
					  elem.mozExitFullScreen();
					} else if (elem.oExitFullScreen) {
						elem.oExitFullScreen();
					} else if (elem.msExitFullScreen) {
						elem.msExitFullScreen();
					}
				} else {
					if (elem.requestFullscreen) {
					  elem.requestFullscreen();
					} else if (elem.mozRequestFullScreen) {
					  elem.mozRequestFullScreen();
					} else if (elem.webkitRequestFullscreen) {
					  elem.webkitRequestFullscreen();
					}
				}
			},
		},
		watch: {
			videoPlaying: function() {
				this.$refs.anime.beginElement();
			}
		},
		components: {
			Tip,
		}
	}
</script>

<style>
	.custom-video-container {
		width: 100%;
		position: relative;
		overflow: hidden;
		margin-bottom: -4px;
	}

	.custom-video {
		width: 100%;
		max-height: 400px;
		min-height: 250px;
	    object-fit: cover;
	}

	.custom-video:-webkit-full-screen {
		object-fit: contain;
	}

	.video-play-button {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 99%;
		display: flex;
		justify-content: center;
		align-items: center;
		background-color: rgba(0, 0, 0, 0.2);
		opacity: 0;
		transition: .2s;
	}

	.video-play-button svg {
		width: 64px;
		fill: #fff;
		transition: .2s;
		cursor: pointer;
	}

	.custom-video-container:hover .video-play-button {
		opacity: 1;
	}

	.bot-menu {
		position: absolute;
		bottom: 0%;
		left: 0;
		width: 100%;
		height: 36px;
		background-color: rgba(0, 0, 0, 0.5);
		box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.5);
		display: flex;
		justify-content: space-between;
		opacity: 0;
		transition: .2s;
		z-index: 2147483647;
	}

	.custom-video-container:hover .bot-menu {
		opacity: 1;
	}

	.svg {
		height: 100%;
		fill: #fff;
		transition: .2s;
	}

	.bot-menu-icon-wrap {
		height: 100%;
		display: flex;
		align-items: center;
	}

	.bot-menu-icon-wrap .svg-container {
		margin-left: 10px;
	}

	.svg-map {
		height: 28px;
	}

	.removed {
		display: none;
	}

	.svg-container {
		height: 100%;
		display: flex;
		align-items: center;
		cursor: pointer;
	}

	.svg-wrapper {
		display: flex;
	}

	.svg-tracer {
		width: 22px;
		height: 22px;
	}
</style>