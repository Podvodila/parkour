<template>
	<div class="profile-content">
		<div class="profile-info">
			<div class="avatar-wrap">
				<div class="avatar-container">
					<img :src="avatar" alt="avatar" id="avatar" ref="avatar">
				</div>
			</div>
			<div class="profile-contacts">
				<p class="contacts-name">{{ fullName }}</p>
				<div class="contacts-social">
					<div class="contacts-facebook" v-if="user.facebook">
						<a :href="user.facebook" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
							     width="44" height="44"
							     viewBox="0 0 64 64"
							     style="fill:#000000;"
							     id="facebook-svg">
							     <g id="facebook-svg-color">
							     	<path fill="#6E91CE" d="M 13 7 L 51 7 C 54.3125 7 57 9.6875 57 13 L 57 51 C 57 54.3125 54.3125 57 51 57 L 13 57 C 9.6875 57 7 54.3125 7 51 L 7 13 C 7 9.6875 9.6875 7 13 7 Z "></path>
							     	<path fill="#FAEFDE" d="M 46 35 L 39 35 L 39 31.058594 L 41 28 L 47 29 L 47 21 L 38 22 L 32 27 L 32 35 L 25 35 L 25 42 L 32 42 L 32 57 L 39 57 L 39 42 L 46 42 Z "></path>
							     	<path fill="#80A6DD" d="M 11 7 L 53 7 C 55.210938 7 57 8.789063 57 11 C 57 12.65625 55.65625 14 54 14 L 10 14 C 8.34375 14 7 12.65625 7 11 C 7 8.789063 8.789063 7 11 7 Z "></path>
							     </g>
							     <g id="facebook-svg-comon"
							     	<path class="svg-basic" d="M 51 6 L 13 6 C 9.132813 6 6 9.132813 6 13 L 6 51 C 6 54.867188 9.132813 58 13 58 L 51 58 C 54.867188 58 58 54.867188 58 51 L 58 13 C 58 9.132813 54.867188 6 51 6 Z M 33 56 L 33 41 L 26 41 L 26 36 L 33 36 L 33 31.289063 C 33 25.46875 36.210938 22 41.601563 22 C 43.175781 22 44.753906 22.089844 46.320313 22.269531 L 46.320313 27.660156 L 42.628906 27.660156 C 38.390625 27.660156 37.898438 30.371094 37.898438 32.410156 L 37.898438 36 L 45.769531 36 L 45 41 L 37.898438 41 L 37.898438 56 Z M 56 51 C 56 53.761719 53.761719 56 51 56 L 39.898438 56 L 39.898438 43 L 45.808594 43 C 46.304688 43.007813 46.730469 42.648438 46.808594 42.160156 L 47.949219 35.160156 C 47.996094 34.867188 47.914063 34.570313 47.71875 34.347656 C 47.527344 34.125 47.246094 33.996094 46.949219 34 L 39.949219 34 L 39.949219 32.398438 C 39.949219 30.5 40.339844 29.648438 42.679688 29.648438 L 47.328125 29.648438 C 47.882813 29.648438 48.328125 29.203125 48.328125 28.648438 L 48.328125 21.410156 C 48.332031 20.894531 47.941406 20.460938 47.429688 20.410156 C 45.941406 20.261719 42.988281 19.988281 41.609375 19.988281 C 35.121094 20 31 24.429688 31 31.289063 L 31 34 L 25 34 C 24.449219 34 24 34.449219 24 35 L 24 42 C 24 42.550781 24.449219 43 25 43 L 31 43 L 31 56 L 13 56 C 10.238281 56 8 53.761719 8 51 L 8 13 C 8 10.238281 10.238281 8 13 8 L 51 8 C 53.761719 8 56 10.238281 56 13 Z "></path><path class="svg-basic" d="M 17 12 C 16.449219 12 16 12.449219 16 13 L 16 15 C 16 15.550781 16.449219 16 17 16 C 17.550781 16 18 15.550781 18 15 L 18 13 C 18 12.449219 17.550781 12 17 12 Z "></path><path class="svg-basic" d="M 12 12 C 11.449219 12 11 12.449219 11 13 L 11 15 C 11 15.550781 11.449219 16 12 16 C 12.550781 16 13 15.550781 13 15 L 13 13 C 13 12.449219 12.550781 12 12 12 Z "></path><path class="svg-basic" d="M 32 12 C 31.449219 12 31 12.449219 31 13 L 31 15 C 31 15.550781 31.449219 16 32 16 C 32.550781 16 33 15.550781 33 15 L 33 13 C 33 12.449219 32.550781 12 32 12 Z "></path><path class="svg-basic" d="M 37 12 C 36.449219 12 36 12.449219 36 13 L 36 15 C 36 15.550781 36.449219 16 37 16 C 37.550781 16 38 15.550781 38 15 L 38 13 C 38 12.449219 37.550781 12 37 12 Z "></path><path class="svg-basic" d="M 42 12 C 41.449219 12 41 12.449219 41 13 L 41 15 C 41 15.550781 41.449219 16 42 16 C 42.550781 16 43 15.550781 43 15 L 43 13 C 43 12.449219 42.550781 12 42 12 Z "></path><path class="svg-basic" d="M 47 12 C 46.449219 12 46 12.449219 46 13 L 46 15 C 46 15.550781 46.449219 16 47 16 C 47.550781 16 48 15.550781 48 15 L 48 13 C 48 12.449219 47.550781 12 47 12 Z "></path><path class="svg-basic" d="M 52 12 C 51.449219 12 51 12.449219 51 13 L 51 15 C 51 15.550781 51.449219 16 52 16 C 52.550781 16 53 15.550781 53 15 L 53 13 C 53 12.449219 52.550781 12 52 12 Z "></path><path class="svg-basic" d="M 22 12 C 21.449219 12 21 12.449219 21 13 L 21 15 C 21 15.550781 21.449219 16 22 16 C 22.550781 16 23 15.550781 23 15 L 23 13 C 23 12.449219 22.550781 12 22 12 Z "></path><path class="svg-basic" d="M 27 12 C 26.449219 12 26 12.449219 26 13 L 26 15 C 26 15.550781 26.449219 16 27 16 C 27.550781 16 28 15.550781 28 15 L 28 13 C 28 12.449219 27.550781 12 27 12 Z "></path>
							     </g>
							 </svg>
						</a>
					</div>
					<div class="contacts-instagram" v-if="user.instagram">
						<a :href="user.instagram" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
							     width="44" height="44"
							     viewBox="0 0 64 64"
							     style="fill:#000000;"
							     id="svg-instagram">
							     <g id="svg-instagram-color">
							     	<path fill="#ED7899" d="M 51 57 L 13 57 C 9.6875 57 7 54.3125 7 51 L 7 13 C 7 9.6875 9.6875 7 13 7 L 51 7 C 54.3125 7 57 9.6875 57 13 L 57 51 C 57 54.3125 54.3125 57 51 57 Z "></path>
							     	<path fill="#3A69ED" d="M 13 7 L 51 7 C 54.3125 7 57 9.6875 57 13 L 57 51 C 57 54.3125 54.3125 57 51 57 L 13 57 C 9.6875 57 7 54.3125 7 51 L 7 13 C 7 9.6875 9.6875 7 13 7 Z "></path>
							     	<path fill="#8F34BF" d="M 57 51 L 57 19.339844 C 53.335938 14.523438 48.890625 10.351563 43.851563 7 L 13 7 C 9.6875 7 7 9.6875 7 13 L 7 51 C 7 54.3125 9.6875 57 13 57 L 51 57 C 54.3125 57 57 54.3125 57 51 Z "></path>
							     	<path fill="#BB52CE" d="M 57 51 L 57 28.488281 C 51.742188 18.902344 43.4375 11.339844 33.398438 7 L 13 7 C 9.6875 7 7 9.6875 7 13 L 7 51 C 7 54.3125 9.6875 57 13 57 L 51 57 C 54.3125 57 57 54.3125 57 51 Z "></path>
							     	<path fill="#E0678F" d="M 57 51 L 57 42.671875 C 52.609375 22.433594 34.707031 8 14 8 C 12.445313 8.003906 10.894531 8.085938 9.351563 8.25 C 7.871094 9.382813 7.003906 11.136719 7 13 L 7 51 C 7 54.3125 9.6875 57 13 57 L 51 57 C 54.3125 57 57 54.3125 57 51 Z "></path>
							     	<path fill="#FF9800" d="M 14 14 C 11.652344 14 9.308594 14.21875 7 14.648438 L 7 51 C 7 54.3125 9.6875 57 13 57 L 51 57 C 51.222656 57.011719 51.445313 57.011719 51.671875 57 C 51.890625 55.34375 52 53.671875 52 52 C 52 31.011719 34.988281 14 14 14 Z "></path>
							     	<path fill="#F4B998" d="M 14 20 C 11.644531 20.003906 9.296875 20.265625 7 20.78125 L 7 51 C 7 54.3125 9.6875 57 13 57 L 45.609375 57 C 45.871094 55.347656 46 53.675781 46 52 C 46 34.328125 31.671875 20 14 20 Z "></path>
							     	<path fill="#F6D397" d="M 14 26 C 11.632813 26.011719 9.277344 26.347656 7 27 L 7 51 C 7 54.3125 9.6875 57 13 57 L 39.511719 57 C 41.003906 49.375 39.007813 41.480469 34.070313 35.480469 C 29.132813 29.480469 21.769531 26 14 26 Z "></path>
							     	<path fill="#F9E3AE" d="M 14 32 C 11.609375 32.003906 9.238281 32.4375 7 33.28125 L 7 51 C 7 54.3125 9.6875 57 13 57 L 33.339844 57 C 34.914063 51.011719 33.617188 44.632813 29.828125 39.734375 C 26.039063 34.839844 20.191406 31.980469 14 32 Z "></path>
							     	<path fill="#FAEFDE" d="M 14 38 C 11.539063 38 9.125 38.652344 7 39.890625 L 7 51 C 7 54.3125 9.6875 57 13 57 L 27.058594 57 C 28.703125 52.699219 28.128906 47.863281 25.519531 44.070313 C 22.914063 40.273438 18.605469 38.003906 14 38 Z "></path>
							     	<path fill="#F9E3AE" d="M 45 32 C 45 39.179688 39.179688 45 32 45 C 24.820313 45 19 39.179688 19 32 C 19 24.820313 24.820313 19 32 19 C 39.179688 19 45 24.820313 45 32 Z "></path>
							     	<path fill="#BBDEF9" d="M 41 32 C 41 36.96875 36.96875 41 32 41 C 27.03125 41 23 36.96875 23 32 C 23 27.03125 27.03125 23 32 23 C 36.96875 23 41 27.03125 41 32 Z "></path>
							     	<path fill="#D2EDFF" d="M 37 32 C 37 34.761719 34.761719 37 32 37 C 29.238281 37 27 34.761719 27 32 C 27 29.238281 29.238281 27 32 27 C 34.761719 27 37 29.238281 37 32 Z "></path>
							     	<path fill="#F3F3F3" d="M 33 30 C 33 31.65625 31.65625 33 30 33 C 28.34375 33 27 31.65625 27 30 C 27 28.34375 28.34375 27 30 27 C 31.65625 27 33 28.34375 33 30 Z "></path>
							     	<path fill="#F3F3F3" d="M 37 35.5 C 37 36.328125 36.328125 37 35.5 37 C 34.671875 37 34 36.328125 34 35.5 C 34 34.671875 34.671875 34 35.5 34 C 36.328125 34 37 34.671875 37 35.5 Z "></path>
							     	<path fill="#85CBF8" d="M 50 16 C 50 17.105469 49.105469 18 48 18 C 46.894531 18 46 17.105469 46 16 C 46 14.894531 46.894531 14 48 14 C 49.105469 14 50 14.894531 50 16 Z "></path>
							     	<path fill="#F9E3AE" d="M 48 13 C 46.34375 13 45 14.34375 45 16 C 45 17.65625 46.34375 19 48 19 C 49.65625 19 51 17.65625 51 16 C 51 14.34375 49.65625 13 48 13 Z M 48 17.46875 C 47.1875 17.46875 46.53125 16.8125 46.53125 16 C 46.53125 15.1875 47.1875 14.53125 48 14.53125 C 48.8125 14.53125 49.46875 15.1875 49.46875 16 C 49.46875 16.8125 48.8125 17.46875 48 17.46875 Z "></path>
							     </g>
							     <g id="svg-instagram-common">
							     	<path fill="#8D6C9F" d="M 32 46 C 39.730469 46 46 39.730469 46 32 C 46 24.269531 39.730469 18 32 18 C 24.269531 18 18 24.269531 18 32 C 18 39.730469 24.269531 46 32 46 Z M 32 20 C 38.628906 20 44 25.371094 44 32 C 44 38.628906 38.628906 44 32 44 C 25.371094 44 20 38.628906 20 32 C 20 25.371094 25.371094 20 32 20 Z "></path>
							     	<path fill="#8D6C9F" d="M 32 42 C 37.523438 42 42 37.523438 42 32 C 42 26.476563 37.523438 22 32 22 C 26.476563 22 22 26.476563 22 32 C 22 37.523438 26.476563 42 32 42 Z M 32 24 C 36.417969 24 40 27.582031 40 32 C 40 36.417969 36.417969 40 32 40 C 27.582031 40 24 36.417969 24 32 C 24 27.582031 27.582031 24 32 24 Z "></path>
							     	<path fill="#8D6C9F" d="M 51 6 L 13 6 C 9.132813 6 6 9.132813 6 13 L 6 51 C 6 54.867188 9.132813 58 13 58 L 51 58 C 54.867188 58 58 54.867188 58 51 L 58 13 C 58 9.132813 54.867188 6 51 6 Z M 56 51 C 56 53.761719 53.761719 56 51 56 L 13 56 C 10.238281 56 8 53.761719 8 51 L 8 13 C 8 10.238281 10.238281 8 13 8 L 51 8 C 53.761719 8 56 10.238281 56 13 Z "></path>
							     	<path fill="#8D6C9F" d="M 17 49 C 16.449219 49 16 49.449219 16 50 L 16 52 C 16 52.550781 16.449219 53 17 53 C 17.550781 53 18 52.550781 18 52 L 18 50 C 18 49.449219 17.550781 49 17 49 Z "></path>
							     	<path fill="#8D6C9F" d="M 12 49 C 11.449219 49 11 49.449219 11 50 L 11 52 C 11 52.550781 11.449219 53 12 53 C 12.550781 53 13 52.550781 13 52 L 13 50 C 13 49.449219 12.550781 49 12 49 Z "></path>
							     	<path fill="#8D6C9F" d="M 32 49 C 31.449219 49 31 49.449219 31 50 L 31 52 C 31 52.550781 31.449219 53 32 53 C 32.550781 53 33 52.550781 33 52 L 33 50 C 33 49.449219 32.550781 49 32 49 Z "></path>
							     	<path fill="#8D6C9F" d="M 37 49 C 36.449219 49 36 49.449219 36 50 L 36 52 C 36 52.550781 36.449219 53 37 53 C 37.550781 53 38 52.550781 38 52 L 38 50 C 38 49.449219 37.550781 49 37 49 Z "></path>
							     	<path fill="#8D6C9F" d="M 42 49 C 41.449219 49 41 49.449219 41 50 L 41 52 C 41 52.550781 41.449219 53 42 53 C 42.550781 53 43 52.550781 43 52 L 43 50 C 43 49.449219 42.550781 49 42 49 Z "></path>
							     	<path fill="#8D6C9F" d="M 47 49 C 46.449219 49 46 49.449219 46 50 L 46 52 C 46 52.550781 46.449219 53 47 53 C 47.550781 53 48 52.550781 48 52 L 48 50 C 48 49.449219 47.550781 49 47 49 Z "></path>
							     	<path fill="#8D6C9F" d="M 52 49 C 51.449219 49 51 49.449219 51 50 L 51 52 C 51 52.550781 51.449219 53 52 53 C 52.550781 53 53 52.550781 53 52 L 53 50 C 53 49.449219 52.550781 49 52 49 Z "></path>
							     	<path fill="#8D6C9F" d="M 22 49 C 21.449219 49 21 49.449219 21 50 L 21 52 C 21 52.550781 21.449219 53 22 53 C 22.550781 53 23 52.550781 23 52 L 23 50 C 23 49.449219 22.550781 49 22 49 Z "></path>
							     	<path fill="#8D6C9F" d="M 27 49 C 26.449219 49 26 49.449219 26 50 L 26 52 C 26 52.550781 26.449219 53 27 53 C 27.550781 53 28 52.550781 28 52 L 28 50 C 28 49.449219 27.550781 49 27 49 Z "></path>
							     </g>
							 </svg>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div>
			<h3>Move list</h3>
			<template v-for="(trick, key) in tricks">
				<h5>{{ trick.name }}</h5>
				<template v-for="(video, nkey) in currentVideo(trick.id)">
		        	<h6>Video of your move</h6>
		            <video :src="video.path" controls width="300px"></video>
		        </template>
			</template>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['user', 'tricks', 'videos', 'avatar', 'routes'],
		data() {
			return {
				
			}
		},
		created() {
			this.avatarClass();
			this.marginAvatar();
		},
		computed: {
			fullName() {
				return this.user.first_name + ' ' + this.user.last_name;
			},
		},
		methods: {
			currentVideo(trick_id) {
				return this.videos.filter(function(video) {
					return video.trick_id == trick_id;
				});
			},
			avatarClass() {
				var self = this;
				$(function() {
					var customClass;
					if(self.$refs.avatar.width > self.$refs.avatar.height) {
						customClass = 'wide';
					} else {
						customClass = 'high';
					}
					self.$refs.avatar.classList.add(customClass);
				});
			},
			marginAvatar() {
				var self = this;
				$(function () { 
					var avatar = self.$refs.avatar;
					var width = avatar.width;
					var height = avatar.height;
					console.log(self.$refs);
					if(width > height) {
						var result = '-' + width/2 + 'px';
						avatar.style.left = result;
					} else {
						var result = '-' + height/2 + 'px';
						avatar.style.top = result;
					}
					
				});
			},

			/*getUserInfo() {
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: this.routes.getUser,
    			  dataType: "json",
    			  data: {
    			     user_id: this.user_id,
    			     _token : $('meta[name="csrf-token"]').attr('content'),
    			  },
    			  success: function(user) { 
    			  	self.user.firstName = user.first_name;
    			  	self.user.lastName = user.last_name;
    			  },
                  error: function(data) {
                    console.log(data);
                  }
				});
			},
			getUserTricks() {
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: this.routes.getUserTricks,
    			  dataType: "json",
    			  data: {
    			     user_id: this.user_id,
    			     _token : $('meta[name="csrf-token"]').attr('content'),
    			  },
    			  success: function(tricks) { 
    			  	tricks.forEach(function(trick) {
    			  		self.tricks.push(trick);
    			  	});
    			  },
                  error: function(data) {
                    console.log(data);
                  }
				});
			},
			getUserVideos() {
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: this.routes.getUserVideos,
    			  dataType: "json",
    			  data: {
    			     user_id: this.user_id,
    			     _token : $('meta[name="csrf-token"]').attr('content'),
    			  },
    			  success: function(videos) { 
    			  	videos.forEach(function(video) {
    			  		self.videos.push(video);
    			  	});
    			  },
                  error: function(data) {
                    console.log(data);
                  }
				});
			},
			getAvatar() {
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: this.routes.getAvatar,
    			  headers: {
    			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			  },
    			  dataType: "json",
    			  data: {
    			     user_id: this.user_id,
    			     _token : $('meta[name="csrf-token"]').attr('content'),
    			  },
    			  success: function(avatar) { 
    			  	self.user.avatar = avatar;
    			  	console.log(self.user.avatar);
    			  },
                  error: function(data) {
                    console.log(data);
                  }
				});
			},*/
		}
	}
</script>

<style>
	.profile-content {
		padding: 60px 20px 0;
	}

	.profile-info {
		display: flex;
	}

	.avatar-container {
		width: 200px;
		height: 200px;
		border-radius: 50%;
		overflow: hidden;
		margin: 0 auto;
		transition: .2s;
	}

	.avatar-container:hover {
		cursor: pointer;
		transform: scale(1.05);
	}

	.avatar-container img {
		position: relative;
	}

	.high {
		width: 100%;
		margin: 50% 0 0 0;
	}

	.wide {
		height: 100%;
		margin: 0 0 0 50%;
	}

	.avatar-wrap {
		width: 400px;
		margin-right: 30px;
	}

	.contacts-name {
		font-size: 32px;
		font-family: 'Nunito';
		font-weight: normal;
	}

	.contacts-social {
		display: flex;
	}

	#facebook-svg path {
		transition: .2s;
	}

	.svg-basic {
		fill: #555;
	}

	#facebook-svg-color {
		opacity: 0;
	}

	#facebook-svg:hover #facebook-svg-color {
		opacity: 1;
	}

	#facebook-svg:hover .svg-basic {
		fill: rgb(141, 108, 159);
	}

	#svg-instagram-color path {
		opacity: 0;
	}

	#svg-instagram path {
		transition: .2s;
	}

	#svg-instagram:hover #svg-instagram-color path {
		opacity: 1;
	}

	#svg-instagram-common path {
		fill: #555;
	}

	#svg-instagram:hover #svg-instagram-common path {
		fill: #8D6C9F;
	}
</style>