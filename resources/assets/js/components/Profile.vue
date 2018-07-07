<template>
	<div class="profile-content">
		<div class="profile-info">
			<div class="avatar-wrap">
				<div class="avatar-container" id="avatar-container">
					<template v-if="avatar.exist">
						<img :src="avatar.url" alt="avatar" id="avatar" ref="avatar" @click="switchAvatar">
						<svg @click="switchAvatar" class="downsize-btn" v-if="avatarOpened" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" width="64px" height="64px">
							<path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
						</svg>
					</template>
					<template v-else>
						<svg class="default-avatar" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px">
							<path d="M75.89,97.66a.5.5,0,0,1-.5-.5V84.24H77.5V78.87a24.55,24.55,0,0,0-11.86-21.1,22.78,22.78,0,0,0-5.86-2.89.5.5,0,1,1,.31-1,23.28,23.28,0,0,1,6.11,3A25.51,25.51,0,0,1,78.5,78.87v6.37H76.39V97.16A.5.5,0,0,1,75.89,97.66Z"/>
							<path d="M29,97.66a.5.5,0,0,1-.5-.5V85.24H27.1V78.87A25.78,25.78,0,0,1,35.33,60l1-.88a.5.5,0,0,1,.68.73l-1,.88A24.78,24.78,0,0,0,28.1,78.87v5.37h1.41V97.16A.5.5,0,0,1,29,97.66Z"/>
							<path d="M40.16,60.37a6.07,6.07,0,0,1-.89-.07,5.94,5.94,0,0,1-4.34-3l-3.82-6.78a4.68,4.68,0,0,1-.58-1.83L28.48,29a15.39,15.39,0,0,1,1.2-6,.5.5,0,0,1,.92.39,14.36,14.36,0,0,0-1.13,5.61l2,19.68A3.69,3.69,0,0,0,32,50l3.82,6.78A5,5,0,0,0,43.6,58l.16-.1,5.41-2.22a7.05,7.05,0,0,0,4-4.33.5.5,0,0,1,.95.31,8.05,8.05,0,0,1-4.6,4.95l-5.33,2.18A5.94,5.94,0,0,1,40.16,60.37Z"/>
							<path d="M40.2,45.1l-3,0a2.87,2.87,0,0,1-.51-5.69L38.67,34,38,32.08a.5.5,0,1,1,.95-.32L39.72,34l-2.28,6.28-.32,0a1.87,1.87,0,0,0,.12,3.73l2.47,0a1.54,1.54,0,0,1,1-.46A1.51,1.51,0,0,1,42,44.2l.07.08a.5.5,0,1,1-.77.64l-.07-.08a.58.58,0,0,0-.45-.2.55.55,0,0,0-.43.24Z"/>
							<path d="M38.2,53.79a.5.5,0,0,1-.4-.8,3,3,0,0,1,1-.79,2.31,2.31,0,0,1,2.51.31.5.5,0,1,1-.6.8,1.31,1.31,0,0,0-1.47-.21,2,2,0,0,0-.62.5A.5.5,0,0,1,38.2,53.79Z"/>
							<path d="M47.68,49.88a.5.5,0,0,1-.47-.67,1.42,1.42,0,0,0-.91-1.91.5.5,0,0,1,.34-.94,2.4,2.4,0,0,1,1.52,3.18A.5.5,0,0,1,47.68,49.88Z"/>
							<path d="M57.76,46.24a3,3,0,0,1-.56-.05.5.5,0,1,1,.18-1,3.17,3.17,0,0,0,2.85-1.37,9.77,9.77,0,0,0,2-4.56,9.76,9.76,0,0,0-.27-5A3.17,3.17,0,0,0,59.83,32,3.18,3.18,0,0,0,57,33.36a.5.5,0,0,1-.76-.65A3.66,3.66,0,0,1,62.95,34a10.76,10.76,0,0,1,.31,5.51,10.77,10.77,0,0,1-2.26,5A4.4,4.4,0,0,1,57.76,46.24Z"/>
							<path d="M67.32,15.6l-2.51.85-1.14-4.86L62.8,14.9,48.41,4.78l1.21,3.67L42.7,6.07l1,2-13.15,3.2,2.57.84L25.8,20.23,28,19.88l-.84,4.78h0a32.56,32.56,0,0,1,11.63-4.11q1.43-.21,2.88-.3L40.58,22l.44-.21a12.67,12.67,0,0,1,7.42-1.2l3.74.58-2.74,1.75,2.17.8-.59,1,1.65-.38,1.66,4.64L53,35.13l2.77,0L58,32c.32-.54-.7.61-.23.2a2.43,2.43,0,0,1,2.15-.69A3.16,3.16,0,0,1,62,33.14l4.64-10.73-.33-1.68,2.13-.27-2.86-2.28Z"/>
							<path d="M47.86,64.63a7.81,7.81,0,0,1-5.42-2.18c-.27-.21-.77-.87-.81-2.94a.5.5,0,0,1,.49-.51h0a.5.5,0,0,1,.5.49c0,1.78.43,2.18.43,2.18a6.88,6.88,0,0,0,9.73-.12c4.8-4.94,5.69-6.15,5.84-6.43a42,42,0,0,1-.33-5.66v-.69l.52-3.45a.5.5,0,0,1,.57-.42.5.5,0,0,1,.42.57l-.51,3.37v.62a40.79,40.79,0,0,0,.34,5.63c.05.36.1.74-6.13,7.16A7.85,7.85,0,0,1,47.86,64.63Z"/>
							<path d="M35.59,50.37a.5.5,0,0,1,0-1l6,0a6.55,6.55,0,0,0,3.34-.94.5.5,0,1,1,.52.86,7.55,7.55,0,0,1-3.85,1.09l-6,0Z"/>
							<path d="M54.79,48.11H54.7a.5.5,0,0,1-.4-.58l.34-1.87a.5.5,0,1,1,1,.18l-.34,1.87A.5.5,0,0,1,54.79,48.11Z"/>
							<path d="M58,42.71a1.84,1.84,0,0,1-.49-.07.5.5,0,0,1,.26-1,.83.83,0,0,0,1-1l-.38-1.61a.5.5,0,0,1,.24-.55L60,37.75a.83.83,0,0,0,.35-1l-.64-1.53a.51.51,0,0,0-.85-.14l-1.27,1.4a.5.5,0,1,1-.74-.67l1.27-1.41a1.51,1.51,0,0,1,2.51.43l.64,1.53a1.83,1.83,0,0,1-.78,2.3l-1,.59.3,1.25A1.83,1.83,0,0,1,58,42.71Z"/>
							<path d="M40,28.05,47.82,28,52,31.21l-4.43-1.4-6.31.48A1.41,1.41,0,0,1,40,28.09Z"/>
							<path d="M29,30.37l1.12-.56,4.86.4A1.41,1.41,0,0,0,36.24,28h0l-6,0-1.23.7"/>
							<path d="M46.92,60.91a.5.5,0,0,1-.39-.19l-.71-.9a1.45,1.45,0,0,1-.19-1.47l.5-1.28a.5.5,0,0,1,.93.37l-.51,1.29a.46.46,0,0,0,.06.47l.71.9a.5.5,0,0,1-.39.81Z"/>
							<path d="M32.43,97.66a.5.5,0,0,1-.5-.5V80.65a24.18,24.18,0,0,1,1.3-7.91.5.5,0,1,1,.95.33,23.17,23.17,0,0,0-1.25,7.58V97.16A.5.5,0,0,1,32.43,97.66Z"/>
							<path d="M68.64,97.66a.5.5,0,0,1-.5-.5V80.65a23.33,23.33,0,0,0-1.45-8.15.5.5,0,0,1,.94-.35,24.35,24.35,0,0,1,1.52,8.5V97.16A.5.5,0,0,1,68.64,97.66Z"/>
							<path d="M78,85.24H68.64a.5.5,0,0,1,0-1H78a.5.5,0,0,1,0,1Z"/>
							<path d="M32.08,85.24H27.6a.5.5,0,1,1,0-1h4.48a.5.5,0,0,1,0,1Z"/>
							<rect x="43" y="32" width="3" height="4.5" rx="1.5" ry="1.5"/>
							<rect x="31" y="32" width="3" height="4.5" rx="1.5" ry="1.5"/>
						</svg>
					</template>
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
							     <g id="facebook-svg-comon">
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
		<div class="tricks-container">
			<transition :name="animeName" mode="out-in">
				<div class="tricks-container" v-if="fullVideoList.show == false" key="1">
					<div  v-for="(trick, key) in tricksToShow" :key="key" class="trick-container card">
						<h3 class="card-header custom-card-header" :class="currentVideos(trick.id).length > 1 ? '' : 'custom-card-header-mute'" @click="currentVideos(trick.id).length > 1 ? showAllVideos(trick.id) : ''">
							<span>{{trick.name}}</span>
							<span v-if="currentVideos(trick.id).length > 1" class="video-numbers"
								@mouseover="tip.msg=local['number of videos']; tip.show=true;"
								@mouseout="tip.show=false"
							>{{currentVideos(trick.id).length}}</span>
						</h3>
						<div class="card-body custom-card-body">
							<template v-if="currentVideos(trick.id).length > 0">
								<app-video :video="currentVideos(trick.id)[0]"></app-video>
							</template>
						</div>
					</div>
				</div>
				<div class="tricks-container" v-if="fullVideoList.show" key="2">
					<div v-for="(video, key) in currentVideos(fullVideoList.trick_id)" :key="key" class="trick-container card">
						<h3 class="card-header custom-card-header custom-card-header-full-videos custom-card-header-mute">
							<span>{{getDate(video.created_at, 'year')}}</span>
							<span 
								@mouseover="tip.msg=local['day and month']; tip.show=true;"
								@mouseout="tip.show=false"
							>{{getDate(video.created_at, 'dm')}}</span>
						</h3>
						<div class="card-body custom-card-body">
							<app-video :video="video"></app-video>
						</div>
						<div class="card-footer text-muted custom-card-footer"
							@mouseover="tip.msg=local['element name']; tip.show=true;"
							@mouseout="tip.show=false"
						>{{fullVideoListTrickName}}</div>
					</div>
				</div>
			</transition>
			<div 
				v-if="fullVideoList.show" 
				class="back-to-tricks" 
				@click="backToTricks"
				@mouseover="tip.msg=local['back to moves']; tip.show=true;"
				@mouseout="tip.show=false"
			>
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><path d="M93,43.7H26.3l19.3-19.3c2.5-2.5,2.5-6.5,0-8.9c-1.2-1.2-2.8-1.8-4.5-1.8c-1.7,0-3.3,0.7-4.5,1.9l-30,30.1  c-2.5,2.5-2.5,6.5,0,8.9l30,30.1c1.2,1.2,2.8,1.8,4.5,1.8c1.7,0,3.3-0.6,4.5-1.8c1.2-1.2,1.9-2.8,1.9-4.5c0-1.7-0.7-3.3-1.8-4.5  L26.3,56.3H93c3.5,0,6.3-2.8,6.3-6.3C99.3,46.5,96.5,43.7,93,43.7z"/></svg>
			</div>
		</div>
		<tip :msg="tip.msg" v-if="tip.show"></tip>
	</div>
</template>

<script>
	import appVideo from './Video.vue';
	import Tip from './Tip.vue';

	export default {
		props: ['user', 'tricks', 'videos', 'avatar', 'routes', 'src_local'],
		data() {
			return {
				avatarOpened: false,
				fullVideoList: {
					show: false,
					trick_id: null,
				},
				tip: {
					show: false,
					msg: '',
				},
				local: this.src_local,
			}
		},
		created() {
		},
		mounted() {
			eventBus.$on('changeLocale', (data) => {this.local = data});
		},
		computed: {
			fullName() {
				return this.user.first_name + ' ' + this.user.last_name;
			},
			tricksWithVideo() {
				var pushedTricks = [];
				var tricksAfterSort = [];
				for(var i = 0; i < this.videos.length; i++) {
					if(pushedTricks.includes(this.videos[i].trick_id)) continue;
					pushedTricks.push(this.videos[i].trick_id);
					this.tricks.forEach((trick) => {
						if(trick.id == this.videos[i].trick_id) {
							tricksAfterSort.push(trick);
						}
					});
				}
				return tricksAfterSort;
			},
			tricksWithoutVideo() {
				return this.tricks.filter((trick) => {
					var result = true;
					this.videos.forEach((video) => {
						if(video.trick_id == trick.id) {
							result = false;
						}
					});
					return result;
				});
			},
			tricksToShow() {
				return this.tricksWithVideo.concat(this.tricksWithoutVideo);
			},
			fullVideoListTrickName() {
				var self = this;
				return this.tricks.filter(function(trick) {
					return trick.id == self.fullVideoList.trick_id;
				})[0].name;
			},
			animeName() {
				return this.fullVideoList.show ? 'trick-list' : 'video-list';
			}
		},
		methods: {
			currentVideos(trick_id) {
				return this.videos.filter(function(video) {
					return video.trick_id == trick_id;
				});
			},
			switchAvatar(e) {
				if(!this.avatarOpened) {
					this.avatarOpened = true;
					e.target.classList.add('full-size-avatar');
					// e.target.style.left = (document.documentElement.clientWidth - this.$refs.avatar.width)/2 + 'px';
					e.target.parentNode.classList.add('full-size-avatar-container');
				} else {
					this.avatarOpened = false;
					this.$refs.avatar.classList.remove('full-size-avatar');
					this.$refs.avatar.parentNode.classList.remove('full-size-avatar-container');
				}
			},
			showAllVideos(trick_id) {
				this.fullVideoList.trick_id = trick_id;
				this.fullVideoList.show = true;
			},
			getDate(date, type) {
				var arr = date.split(' ')[0].split('-');
				if(type == 'year') {
					return arr[0];
				} else if(type == 'dm') {
					return arr[2] + '-' + arr[1];
				}
			},
			backToTricks() {
				this.fullVideoList.show = false;
			},
		},
		components: {
			appVideo,
			Tip,
		},
		watch: {
			'fullVideoList.show': function(val) {
				this.tip.show = false;
			}
		},
	}
</script>

<style>
	.profile-content {
		padding: 60px 20px 0;
		width: 1100px;
    	margin: 64px auto 0px;
	}

	.profile-info {
		display: flex;
		margin-bottom: 44px;
	}

	.avatar-container {
		width: 200px;
		height: 200px;
		border-radius: 50%;
		overflow: hidden;
		margin: 0 auto;
	}

	.avatar-container img:hover {
		cursor: pointer;
		/*transform: scale(1.05);*/
	}

	.avatar-container img {
		position: relative;
		width: 100%;
		height: 100%;
		object-fit: cover;
		/*transition: .2s;*/
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
		font-family: 'Nunito', 'Arial';
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

	.avatar-container .full-size-avatar {
		position: fixed;
		z-index: 90;
		top: 10% !important;
		cursor: pointer;
		max-width: 90vw;
		max-height: 80vh;
		width: auto;
		height: auto;
		object-fit: contain;
	}

	.avatar-container.full-size-avatar-container {
		position: fixed;
		z-index: 1002;
		width: 100vw;
		height: 100vh;
		left: 0px;
		top: 0px;
		border-radius: 0;
		background-color: rgba(0, 0, 0, 0.5);
		cursor: default;
		animation: avatarUp .2s;
		display: flex;
	    justify-content: center;
	    align-items: center;
	}

	.avatar-container.full-size-avatar-container .full-size-avatar:hover {
		transform: none;
	}

	.downsize-btn {
		top: 15px;
		right: 30px;
		position: absolute;
		fill: #f1f1f1;
		cursor: pointer;
		transition: .2s;
	}

	.downsize-btn:hover {
		transform: scale(1.2) rotate(90deg);
		fill: #c54646;
	}

	.downsize-btn:active {
		transform: scale(0.9) rotate(90deg);
	}

	@keyframes avatarUp {
		from {
			opacity: 0;
		}
		to {
			opacity: 1;
		}
	}

	.tricks-container {
		width: 100%;
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		align-items: flex-start;
	}

	.trick-container {
		width: 500px;
		margin-bottom: 48px;
	}

	.custom-card-header {
		font-size: 24px;
		font-family: 'Nunito', 'Arial';
		font-weight: normal;
		background-color: #f2f2f4;
		cursor: pointer;
		display: flex;
		justify-content: space-between;
		position: relative;
	}

	.custom-card-header:hover {
		background-color: #eaeaec;
	}

	.custom-card-body {
		background-color: #efefef;
		background-image: url('/images/noiseImg.png');
	}

	.full-video-list {
		position: fixed;
		width: 100vw;
		height: 100vh;
		top: 0;
		left: 0;
		background-color: rgba(0, 0, 0, 0.3);
	}

	.full-video-list-wrap {
		height: 100%;
		overflow-y: scroll;
	}

	.over-hidden {
		overflow: hidden;
	}

	.full-video-list-container {
		max-width: 1100px;
		display: flex;
	    flex-wrap: wrap;
	    justify-content: space-between;
	    align-items: flex-start;
	    margin: 0 auto;
	}

	.custom-card {
		width: 300px;
	}

	.custom-card-footer {
		background-color: #e8e8e8;
		cursor: default;
	    font-family: 'Nunito', 'Arial';
    	font-weight: normal;
    	font-size: 14px;
	}

	.custom-card-header-full-videos {
		font-size: 20px;
	}

	.back-to-tricks {
		position: fixed;
		top: 60px;
		right: 37px;
	}

	.back-to-tricks svg {
		width: 60px;
		fill: rgb(91, 157, 232);
		cursor: pointer;
		transition: .2s;
	}

	.back-to-tricks:hover svg {
		fill: rgb(11, 157, 255);
		transform: scale(1.1);
	}

	.back-to-tricks:active svg {
		transform: scale(1);
	}

	.trick-list-enter-active {
        animation: trickShow .5s;
    }

    .trick-list-leave-active {
        animation: trickHide .5s;
    }

    .video-list-enter-active {
        animation: videoShow .5s;
    }

    .video-list-leave-active {
        animation: videoHide .5s;
    }

    @keyframes trickShow {
    	from {
			transform: translateX(120%);
    	}

    	to {
			transform: translateX(0%);
    	}
    }

    @keyframes trickHide {
    	from {
			transform: translateX(0%);
    	}

    	to {
			transform: translateX(-120%);
    	}
    }

    @keyframes videoShow {
    	from {
			transform: translateX(-120%);
    	}

    	to {
			transform: translateX(0%);
    	}
    }

    @keyframes videoHide {
    	from {
			transform: translateX(0%);
    	}

    	to {
			transform: translateX(120%);
    	}
    }

    .custom-card-header-mute:hover {
    	cursor: default;
    	background-color: #f2f2f4;
    }

    .default-avatar {
    	transform: scale(-1, 1);
    }

    .video-numbers {
    	position: absolute;
	    right: 0;
	    height: 100%;
	    display: flex;
	    justify-content: center;
	    width: 45px;
	    align-items: center;
	    top: 0;
	    border-left: 1px solid #aaa;
	    transition: .2s;
	    background-color: rgba(0, 0, 0, 0.05);
    }
</style>