<template>
	<div class="custom-video-container">
		<video :src="src" class="custom-video" ref="video"></video>
		<div class="video-play-button" ref="play" :class="{removed: videoPlaying}">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" @click="playVideo">
				<path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path>
			</svg>
		</div>
		<div class="bot-menu" ref="menu">
			<svg version="1.1" viewBox="0 0 36 36" class="svg" @click="switchVideo">
				<path v-if="videoPlaying" class="ytp-svg-fill" d="M 12,26 16,26 16,10 12,10 z M 21,26 25,26 25,10 21,10 z">
					<animate ref="anime" class="but-play" attributeName="d" attributeType="XML" dur=".2s" begin="none" fill="freeze" from="M 12,26 18.5,22 18.5,14 12,10 z M 18.5,22 25,18 25,18 18.5,14 z" to="M 12,26 16,26 16,10 12,10 z M 21,26 25,26 25,10 21,10 z" />
				</path>
				<path v-else class="ytp-svg-fill" d="M 12,26 18.5,22 18.5,14 12,10 z M 18.5,22 25,18 25,18 18.5,14 z">
					<animate ref="anime" class="but-play" attributeName="d" attributeType="XML" dur=".2s" begin="none" fill="freeze" from="M 12,26 16,26 16,10 12,10 z M 21,26 25,26 25,10 21,10 z" to="M 12,26 18.5,22 18.5,14 12,10 z M 18.5,22 25,18 25,18 18.5,14 z" />
				</path>
			</svg>
			<div class="bot-menu-icon-wrap">

				
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve" class="svg svg-map">
					<path d="M60.6,30c0-5.5-4.5-10-10.1-10c-5.6,0-10.1,4.5-10.1,10s4.5,10,10.1,10C56.1,40,60.6,35.5,60.6,30z M44.4,30  c0-3.3,2.7-6,6.1-6s6.1,2.7,6.1,6s-2.7,6-6.1,6S44.4,33.3,44.4,30z M50,64.8l1.4-1.4C67.9,47.1,69.2,35.2,69.2,32v-2  c0-10.5-8.6-19-19.2-19s-19.2,8.5-19.2,19v2c0,3.2,1.3,15.1,17.8,31.4L50,64.8z M34.8,30c0-8.3,6.8-15,15.2-15  c8.4,0,15.2,6.7,15.2,15v2c0,2-0.8,12.3-15.2,27.1C35.6,44.3,34.8,33.9,34.8,32V30z M94.8,75.7L72.7,89l-22.4-7.4  c-0.2-0.1-0.4-0.2-0.5-0.3c-0.2,0.1-0.3,0.2-0.5,0.3L26.9,89L4.8,75.7l11.9-42.9L29,40.2c1,0.6,1.3,1.8,0.7,2.7  c-0.6,0.9-1.8,1.2-2.8,0.7L19.2,39L9.5,73.8L26,83.8l3.8-33c0.1-1.1,1.1-1.9,2.2-1.8c1.1,0.1,1.9,1.1,1.8,2.2l-3.8,32.5L48,77.8  c0,0,0,0,0,0v-6.9c0-1.1,0.9-2,2-2c1.1,0,2,0.9,2,2v7c0,0,0,0,0,0L70,83.9l-3.8-32.7c-0.1-1.1,0.7-2.1,1.8-2.2  c1.1-0.1,2.1,0.7,2.2,1.8L74,83.5l16.1-9.7L80.4,39l-7.7,4.6c-1,0.6-2.2,0.3-2.8-0.7c-0.6-0.9-0.3-2.2,0.7-2.7l12.3-7.4L94.8,75.7z"/>
				</svg>
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
</template>

<script>
	export default {
		props: ['src'],
		data() {
			return {
				videoPlaying: false,
			}
		},
		created() {
			this.videoOnEnd();
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
				} else {
					this.$refs.video.play();
					this.videoPlaying = true;
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
		},
		watch: {
			videoPlaying: function() {
				this.$refs.anime.beginElement();
			}
		}
	}
</script>

<style>
	.custom-video-container {
		width: 100%;
		position: relative;
		overflow: hidden;
	}

	.custom-video {
		width: 100%;
		max-height: 400px;
	}

	.video-play-button {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.video-play-button svg {
		width: 64px;
		fill: #fff;
		transition: .2s;
		opacity: 0;
		cursor: pointer;
	}

	.custom-video-container:hover .video-play-button svg {
		opacity: 1;
	}

	.removed {
		display: none;
	}

	.bot-menu {
		position: absolute;
		bottom: 1%;
		left: 0;
		width: 100%;
		height: 36px;
		background-color: rgba(0, 0, 0, 0.5);
		box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.5);
		display: flex;
		justify-content: space-between;
	}

	.svg {
		height: 100%;
		fill: #fff;
		cursor: pointer;
		transition: .2s;
	}

	.bot-menu-icon-wrap {
		/*width: 100%;*/
		height: 100%;
		display: flex;
		align-items: center;
	}

	.bot-menu-icon-wrap svg {
		margin-left: 10px;
	}

	.svg-map {
		height: 28px;
	}
</style>