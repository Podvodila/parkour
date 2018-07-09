<template>
	<div class="profile-content">
		<div class="profile-info">
			<div class="avatar-wrap">
				<div v-if="!imageLoading" class="avatar-container" id="avatar-container">
					<template v-if="avatarSrc.exist">
						<img :src="avatarSrc.url" alt="avatar" id="avatar" ref="avatar">
						<div class="image-buttons">
							<div class="change-image">
								<form :action="routes.updateAvatar" method="POST" enctype="multipart/form-data" id="upload-img">
							        <input type="hidden" name="_token" :value="token">
							        <label>
							        	<input type="file" name="avatar" class="hidden" @change="updateImage" id="uploadAvatarInput">
							        	<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"><path d="M8 10h-5l9-10 9 10h-5v10h-8v-10zm8 12h-8v2h8v-2z"/></svg>
							        </label>
							    </form>
							</div>
							<div class="remove-image">
								<form :action="routes.removeAvatar" method="POST" id="remove-img" @submit.prevent="removeImage">
						            <input type="hidden" name="_token" :value="token">
						            <label>
						            	<input type="submit" value="remove it" class="hidden">
						            	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" width="64px" height="64px">
											<path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
											</path>
										</svg>
						            </label>
						        </form>
							</div>
						</div>
					</template>
					<template v-else>
						<form :action="routes.updateAvatar" method="POST" enctype="multipart/form-data" id="upload-img" class="add-image">
					        <input type="hidden" name="_token" :value="token">
					        <label>
					        	<input type="file" name="avatar" class="hidden" @change="updateImage" id="uploadAvatarInput">
					        	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/></svg>
					        </label>
					    </form>
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
				<div v-else class="avatar-container">
				    <svg class="image-load-placeholder" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
					    <defs>
					      <filter id="tail-0.a4db4fdd84ecd" x="-100%" y="-100%" width="300%" height="300%" color-interpolation-filters="sRGB">
					        <feGaussianBlur in="SourceGraphic" stdDeviation="3"></feGaussianBlur>
					        <feColorMatrix mode="matrix" values="1 0 0 0 0   0 1 0 0 0   0 0 1 0 0   0 0 0 60 -40" result="cm"></feColorMatrix>
					      </filter>
					    </defs>
					    <g filter="url(#tail-0.a4db4fdd84ecd)" transform="rotate(54 50 50)">
					      <animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="4s" begin="0s" repeatCount="indefinite"></animateTransform>
					      <g transform="rotate(333.474 50 50)">
					        <g transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="19" fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.13333333333333333 0 0.03333333333333333 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(331.178 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="18" fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1" keySplines="0.16666666666666669 0 0.06666666666666667 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(328.576 50.0001 50)">
					        <g transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="17" fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1" keySplines="0.2 0 0.1 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(325.612 50 50)">
					        <g transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="16" fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1" keySplines="0.23333333333333334 0 0.13333333333333333 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(322.212 50 50)">
					        <g transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="15" fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1" keySplines="0.26666666666666666 0 0.16666666666666666 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(318.287 50 50)">
					        <g transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="14" fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1" keySplines="0.30000000000000004 0 0.2 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(314.708 50 50)">
					        <g transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="13" fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1" keySplines="0.33333333333333337 0 0.23333333333333334 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(309.018 50 50)">
					        <g transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="12" fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1" keySplines="0.3666666666666667 0 0.26666666666666666 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(302.443 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="11"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.4 0 0.3 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(294.767 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="10"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.43333333333333335 0 0.3333333333333333 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(285.715 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="9"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.4666666666666667 0 0.36666666666666664 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(274.96 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="8"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.5 0 0.4 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(263.29 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="7"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.5333333333333333 0 0.43333333333333335 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(247.243 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="6"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.5666666666666667 0 0.4666666666666667 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(233.28 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="5"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.6 0 0.5 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(210.448 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="4"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.6333333333333333 0 0.5333333333333333 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(189.723 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="3"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.6666666666666666 0 0.5666666666666667 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(167.547 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="2"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.7 0 0.6 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(151.39 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="1"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.7333333333333333 0 0.6333333333333333 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					      <g transform="rotate(134.242 50 50)">
					        <g  transform="translate(50 19.6)">
					          <circle cx="0" cy="0" r="0"   fill="#ff7c81" transform="scale(0.48)"></circle>
					        </g>
					        <animateTransform attributeName="transform" calcMode="spline" type="rotate" values="0 50 50;360 50 50" keyTimes="0;1"  keySplines="0.7666666666666666 0 0.6666666666666666 1" repeatCount="indefinite" dur="1"></animateTransform>
					      </g>
					    </g>
					</svg>
				</div>
			</div>
			<div class="profile-contacts">
				<p class="contacts-name">{{ fullName }}</p>
				<div class="contacts-social">
					<div class="input-group social-item">
					  <span class="input-group-addon social-default" id="basic-facebook">facebook.com/</span>
					  <input type="text" class="form-control" id="facebook-url" aria-describedby="basic-facebook" v-model="social.facebook">
					  <span class="input-group-btn">
				        <button class="btn btn-secondary custom-btn" type="button" @click="saveSocial('facebook')">{{local['save']}}</button>
				      </span>
					</div>
					<div class="input-group social-item">
					  <span class="input-group-addon social-default" id="basic-instagram">instagram.com/</span>
					  <input type="text" class="form-control" id="instagram-url" aria-describedby="basic-instagram" v-model="social.instagram">
					  <span class="input-group-btn">
				        <button class="btn btn-secondary custom-btn" type="button" @click="saveSocial('instagram')">{{local['save']}}</button>
				      </span>
					</div>
					<transition-group name="alerts" tag="div" class="custom-alert-container">
						<template v-for="(response, key) in responses">
								<Alert :msg="response.msg" :error="response.error" v-if="response.show" :key="response.key"></Alert>
						</template>
					</transition-group>
				</div>
			</div>
		</div>
		<div class="tricks-wrap">
			<template v-if="fullVideoList.show == false">
				<button 
					class="btn custom-all-tricks-button" 
					:class="allTricksShow ? 'btn-danger' : 'btn-primary'" 
					@click="switchAllTricks"
					data-toggle="collapse" data-target="#collapseMove" aria-expanded="false" aria-controls="collapseMove">
					{{allTricksShow ? local['close'] : local['add moves']}}
				</button>
				<div class="all-tricks-container collapse" id="collapseMove">
					<transition-group tag="ul" class="list-group custom-list-group" name="new-tricks">
					  <li class="list-group-item custom-list-group-item" v-for="trick in notAddedTricks" :key="trick.id">
					  	<span>{{trick.name}}</span>
					  	<span class="add-element desktop-add-element" @click="addElement(trick.id)">{{local['add move']}}</span>
					  	<span class="mobile-add-element" @click="addElement(trick.id)">
						  	<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve">
								<path style="fill:#23A24D;" d="M37.059,16H26V4.941C26,2.224,23.718,0,21,0s-5,2.224-5,4.941V16H4.941C2.224,16,0,18.282,0,21
									s2.224,5,4.941,5H16v11.059C16,39.776,18.282,42,21,42s5-2.224,5-4.941V26h11.059C39.776,26,42,23.718,42,21S39.776,16,37.059,16z"
									/>
							</svg>
						</span>
					  </li>
					</transition-group>
				</div>
			</template>
			<template v-if="fullVideoList.show">
				<form :action="routes.addVideo" method="POST" enctype="multipart/form-data" id="add-video" class="custom-add-video-button" @submit.prevent>
					<input type="hidden" name="_token" :value="token">
					<label>
						<input v-if="!videoLoading" type="file" name="video" class="hidden" id="add-video-input" @change="addVideo">
						<span class="btn btn-primary custom-add-video-btn">
							<span>{{local['add video']}}</span>
							<svg v-if="videoLoading" @click.stop class="video-load-placeholder" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
							    <path fill="none" d="M24.3,30C11.4,30,5,43.3,5,50s6.4,20,19.3,20c19.3,0,32.1-40,51.4-40 C88.6,30,95,43.3,95,50s-6.4,20-19.3,20C56.4,70,43.6,30,24.3,30z" stroke="#ff7c81" stroke-width="7" stroke-dasharray="159.08513549804687 97.50379272460938">
							      <animate attributeName="stroke-dashoffset" calcMode="linear" values="0;256.58892822265625" keyTimes="0;1" dur="1" begin="0s" repeatCount="indefinite"></animate>
							    </path>
						  </svg>
						</span>
					</label>
				</form>
			</template>
			<transition :name="animeName" mode="out-in">
				<div class="tricks-container" v-if="fullVideoList.show == false" key="1">
					<div  v-for="(trick, key) in tricksToShow" :key="key" class="trick-container card">
						<h3 class="card-header custom-card-header" @click="showAllVideos(trick.id)">
							<span>{{trick.name}}</span>
							<span 
								@click.stop="removeElement(trick.id)" 
								class="remove-trick"
								@mouseover="tip.msg=local['remove move']; tip.show=true;"
								@mouseout="tip.show=false"
								>
								<svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" viewBox="0 0 26.458333 26.458333" version="1.1" x="0px" y="0px">
									<g>
										<circle cx="13.229166" cy="13.22916" r="9.260417" style="opacity: 0.959; vector-effect: none; fill: none; fill-opacity: 1; fill-rule: evenodd; stroke: rgb(0, 0, 0); stroke-width: 2; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 4; stroke-dasharray: none; stroke-dashoffset: 0; stroke-opacity: 1; paint-order: normal;"></circle>
										<path class="remove-trick-first-path" d="M 10.583333,10.58333 15.875,15.875" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-opacity="1" stroke-miterlimit="4" stroke-dasharray="none"></path>
										<path class="remove-trick-second-path" d="M 10.583333,15.875 15.875,10.58333" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-opacity="1" stroke-miterlimit="4" stroke-dasharray="none"></path>
									</g>
								</svg>
							</span>
						</h3>
						<div class="card-body custom-card-body">
							<template v-if="currentVideos(trick.id).length > 0">
								<app-video :video="currentVideos(trick.id)[0]"></app-video>
							</template>
						</div>
					</div>
				</div>
				<div class="tricks-container" v-if="fullVideoList.show" key="2">
					<div v-for="(video, key) in currentVideos(fullVideoList.trick_id)" :key="video.id" class="trick-container card">
						<h3 class="card-header custom-card-header custom-card-header-full-videos custom-card-header-mute">
							<span class="video-date">
								<span class="video-date-year">{{getDate(video.created_at, 'year')}}</span>
								<span 
									class="video-date-dm"
									@mouseover="tip.msg=local['day and month']; tip.show=true;"
									@mouseout="tip.show=false"
								>
									{{getDate(video.created_at, 'dm')}}
								</span>
							</span>
							<span class="video-edit-buttons">
								<svg 
									v-if="video.spot_id"
									@mouseover="tip.msg=local['detach from spot']; tip.show=true;"
									@mouseout="tip.show=false"
									@click="removeSpotFromVideo(video.id)"
									class="video-remove-spot" 
									xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 144.083 144.083" enable-background="new 0 0 144.083 144" xml:space="preserve">
									<path d="M64.759,44.479c-10.203,0-18.504,8.301-18.504,18.504c0,10.202,8.301,18.503,18.504,18.503  c10.203,0,18.503-8.301,18.503-18.503C83.262,52.78,74.961,44.479,64.759,44.479z M64.759,78.486  c-8.549,0-15.504-6.955-15.504-15.503c0-8.549,6.955-15.504,15.504-15.504c8.548,0,15.503,6.955,15.503,15.504  C80.262,71.532,73.307,78.486,64.759,78.486z"/>
									<path d="M95.856,78.513c2.975-5.458,4.941-10.823,4.941-15.518c0-19.872-16.166-36.039-36.039-36.039  c-19.872,0-36.039,16.167-36.039,36.039c0,19.51,33.595,50.587,35.024,51.901l1.015,0.932l1.015-0.932  c0.49-0.451,4.769-4.41,10.172-10.195c2.545,8.294,10.271,14.343,19.389,14.343c11.182,0,20.279-9.097,20.279-20.278  C115.614,87.76,106.795,78.793,95.856,78.513z M75.194,101.049c-4.623,5.053-8.631,8.964-10.435,10.682  C59.096,106.336,31.72,79.4,31.72,62.995c0-18.218,14.821-33.039,33.039-33.039c18.218,0,33.039,14.821,33.039,33.039  c0,4.644-2.199,10.134-5.477,15.74c-9.754,1.464-17.266,9.875-17.266,20.03C75.055,99.539,75.108,100.299,75.194,101.049z   M95.334,116.044c-9.527,0-17.279-7.751-17.279-17.278s7.752-17.279,17.279-17.279c9.529,0,17.279,7.752,17.279,17.279  S104.864,116.044,95.334,116.044z"/>
									<rect x="86.545" y="97.286" width="17.576" height="3"/>
								</svg>
								<svg 
									v-else
									@mouseover="tip.msg=local['attach to spot']; tip.show=true;"
									@mouseout="tip.show=false"
									class="video-add-spot" @click="showSpotAdding(video.id)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
									<path d="M50,24c-11,0-20,9-20,20c0,19.3,18.7,31.3,19.5,31.8c0.2,0.1,0.3,0.2,0.5,0.2s0.4-0.1,0.5-0.2C51.3,75.3,70,63.3,70,44  C70,33,61,24,50,24z M50,73.8C47,71.7,32,60.4,32,44c0-9.9,8.1-18,18-18s18,8.1,18,18C68,60.4,53,71.7,50,73.8z M56,43  c0,0.6-0.4,1-1,1h-4v4c0,0.6-0.4,1-1,1s-1-0.4-1-1v-4h-4c-0.6,0-1-0.4-1-1s0.4-1,1-1h4v-4c0-0.6,0.4-1,1-1s1,0.4,1,1v4h4  C55.6,42,56,42.4,56,43z M50,31c-6.6,0-12,5.4-12,12s5.4,12,12,12s12-5.4,12-12S56.6,31,50,31z M50,53c-5.5,0-10-4.5-10-10  s4.5-10,10-10s10,4.5,10,10S55.5,53,50,53z"/>
								</svg>

								<svg 
									@mouseover="tip.msg=local['delete video']; tip.show=true;"
									@mouseout="tip.show=false"
									class="remove-video" @click="removeVideo(video)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 24 24" x="0px" y="0px">
									<path d="M18,19C18,20.66 16.66,22 15,22H8C6.34,22 5,20.66 5,19V7H4V4H8.5L9.5,3H13.5L14.5,4H19V7H18V19M6,7V19C6,20.1 6.9,21 8,21H15C16.1,21 17,20.1 17,19V7H6M18,6V5H14L13,4H10L9,5H5V6H18M8,9H9V19H8V9M14,9H15V19H14V9Z"/>
								</svg>
							</span>
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
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve">
					<path d="M93,43.7H26.3l19.3-19.3c2.5-2.5,2.5-6.5,0-8.9c-1.2-1.2-2.8-1.8-4.5-1.8c-1.7,0-3.3,0.7-4.5,1.9l-30,30.1  c-2.5,2.5-2.5,6.5,0,8.9l30,30.1c1.2,1.2,2.8,1.8,4.5,1.8c1.7,0,3.3-0.6,4.5-1.8c1.2-1.2,1.9-2.8,1.9-4.5c0-1.7-0.7-3.3-1.8-4.5  L26.3,56.3H93c3.5,0,6.3-2.8,6.3-6.3C99.3,46.5,96.5,43.7,93,43.7z"/>
				</svg>
			</div>
		</div>
		<div class="map-container" v-if="map.show">
			<div class="map-wrap">
				<map-all :spots="spots" :redirect="false" v-on:marker-clicked="setSpotToVideo"></map-all>
			</div>
			<svg @click="map.show = false" class="close-map-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" width="64px" height="64px">
				<path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
			</svg>
		</div>
		<tip :msg="tip.msg" v-if="tip.show"></tip>
	</div>
</template>

<script>
	import appVideo from './Video.vue';
	import Alert from './Alert.vue';
	import MapAll from './MapAll.vue';
	import Tip from './Tip.vue';

	export default {
		props: ['user', 'user_tricks', 'prop_videos', 'avatar', 'routes', 'all_tricks', 'spots', 'src_local'],
		data() {
			return {
				videos: this.prop_videos,
				fullVideoList: {
					show: false,
					trick_id: null,
				},
				token: $('meta[name="csrf-token"]').attr('content'),
				avatarSrc: this.avatar,
				social: {
					facebook: this.user.facebook ? this.user.facebook.split('facebook.com/')[1] : '',
					instagram: this.user.instagram ? this.user.instagram.split('instagram.com/')[1] : '',
				},
				responses: [],
				tricks: this.user_tricks,
				allTricksShow: false,
				customKey: 10,
				map: {
					show: false,
					video: null,
				},
				tip: {
					show: false,
					msg: '',
				},
				local: this.src_local,
				videoLoading: false,
				imageLoading: false,
			}
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
			},
			notAddedTricks() {
				return this.all_tricks.filter((trick) => {
					var result = true;
					this.tricks.forEach((myTrick) => {
						if(myTrick.id == trick.id) {
							result = false;
						}
					});
					return result;
				});
			},
		},
		methods: {
			currentVideos(trick_id) {
				return this.videos.filter(function(video) {
					return video.trick_id == trick_id;
				});
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
			updateImage() {
				var self = this;
				var form = new FormData(document.querySelector("#upload-img"));
				self.imageLoading = true;
				$.ajax({
    			  method: "post",
    			  url: self.routes.updateAvatar,
    			  dataType: "json",
    			  contentType: false,
    			  processData: false,
    			  data: form,
    			  success: function(data) { 
    			  	if(self.avatarSrc.exist) {
    			  		self.avatarSrc.url = data.url + '?' + Date.now();
    			  	} else {
    			  		self.avatarSrc.url = data.url + '?' + Date.now();
    			  		self.avatarSrc.exist = true;
    			  	}
    			  },
                  error: function(data) {
                    var response = {};
                    response.msg = data.responseJSON.errors.avatar[0];
    			  	response.error = true;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
                  }
				}).always(function() {self.imageLoading = false;});
			},
			removeImage() {
				var self = this;
				var form = new FormData(document.querySelector("#remove-img"));
				self.imageLoading = true;
				$.ajax({
    			  method: "post",
    			  url: self.routes.removeAvatar,
    			  dataType: "json",
    			  contentType: false,
    			  processData: false,
    			  data: form,
    			  success: function(data) { 
    			  	self.avatarSrc.exist = false;
    			  },
                  error: function(data) {
                    console.log('error');
                  }
				}).always(function() {self.imageLoading = false;});
			},
			saveSocial(social) {
				var self = this;
				var value = social == 'facebook' ? this.social.facebook : this.social.instagram;
				var value = value == '' ? 'remove' : value;
				$.ajax({
    			  method: "post",
    			  url: this.routes.setSocial,
    			  dataType: "json",
    			  data: {
    			     [social]: value,
    			     _token : $('meta[name="csrf-token"]').attr('content'),
    			  },
    			  success: function(data) { 
    			  	var response = {};
    			  	response.msg = self.local['saved'];
    			  	response.error = false;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
    			  },
                  error: function(data) {
                  	var response = {};
                    response.msg = data;
    			  	response.error = true;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
                  }
				});
			},
			switchAllTricks() {
				this.allTricksShow = !this.allTricksShow;
			},
			addElement(id) {
				var self = this;
				
				$.ajax({
    			  method: "post",
    			  url: this.routes.addMove,
    			  dataType: "json",
    			  data: {
    			     move: id,
    			     _token : $('meta[name="csrf-token"]').attr('content'),
    			  },
    			  success: function(data) {
    			  	var element = self.all_tricks.filter((trick) => {
						return trick.id == id;
					})[0];
					self.tricks.push(element);
    			  },
                  error: function(data) {
                  	console.log('error');
                  }
				});
			},
			removeElement(id) {
				var self = this;
				
				$.ajax({
    			  method: "post",
    			  url: this.routes.removeMove,
    			  dataType: "json",
    			  data: {
    			     move: id,
    			     _token : $('meta[name="csrf-token"]').attr('content'),
    			  },
    			  success: function(data) {
    			  	self.tricks = data;
    			  	self.tip.show = false;
    			  },
                  error: function(data) {
                  	var response = {};
                    response.msg = data.responseJSON.errors.move[0];
                    if(response.msg == "First you need to delete the video confirmation.") response.msg = self.local['first delete video'];
    			  	response.error = true;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
                  }
				});
			},
			addVideo() {
				var self = this;
				var form = new FormData(document.querySelector("#add-video"));
				form.append('move', this.fullVideoList.trick_id);
				self.videoLoading = true;
				$.ajax({
    			  method: "post",
    			  url: self.routes.addVideo,
    			  dataType: "json",
    			  contentType: false,
    			  processData: false,
    			  data: form,
    			  success: function(data) { 
    			  	self.videos = data;
    			  },
                  error: function(data) {
                  	console.log('error');
                    var response = {};
                    response.msg = data.responseJSON.errors.video[0];
    			  	response.error = true;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
                  }
				}).always(function() {self.videoLoading = false;});
			},
			removeVideo(video) {
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: self.routes.removeVideo,
    			  dataType: "json",
    			  headers: {
				    'X-CSRF-TOKEN': self.token,
				  },
    			  data: {
    			  	video: JSON.stringify(video),
    			  	_token: self.token,
    			  },
    			  success: function(data) { 
    			  	self.videos = data;
    			  	self.tip.show = false;
    			  },
                  error: function(data) {
                    var response = {};
                    response.msg = data.responseJSON.errors.video[0];
    			  	response.error = true;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
                  }
				});
			},
			showSpotAdding(video_id) {
				this.map.show = true;
				this.map.video = video_id;
			},
			setSpotToVideo(spot_id) {
				var self = this;
				self.map.show = false;
				$.ajax({
    			  method: "post",
    			  url: self.routes.addSpotToVideo,
    			  dataType: "json",
    			  headers: {
				    'X-CSRF-TOKEN': self.token,
				  },
    			  data: {
    			  	video_id: self.map.video,
    			  	spot_id: spot_id,
    			  	_token: self.token,
    			  },
    			  success: function(data) { 
    			  	self.videos = data;
    			  	var response = {};
                    response.msg = self.local['video added to spot'];
    			  	response.error = false;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
    			  },
                  error: function(data) {
                    console.log('error');
                  }
				});
			},
			removeSpotFromVideo(video_id) {
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: self.routes.removeSpotFromVideo,
    			  dataType: "json",
    			  headers: {
				    'X-CSRF-TOKEN': self.token,
				  },
    			  data: {
    			  	video_id: video_id,
    			  	_token: self.token,
    			  },
    			  success: function(data) { 
    			  	self.videos = data;
    			  	var response = {};
                    response.msg = self.local['video removed from spot'];
    			  	response.error = false;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
    			  },
                  error: function(data) {
                    console.log('error');
                  }
				});
			},
		},
		components: {
			appVideo,
			Alert,
			MapAll,
			Tip,
		},
		watch: {
			'fullVideoList.show': function(val) {
				if(val == false) {
					this.tip.show = false;
				} else {
					this.allTricksShow = false;
				}
			}
		},
	}
</script>

<style>
	.avatar-container img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

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
		position: relative;
	}

	.avatar-container img:hover {
		cursor: pointer;
		/*transform: scale(1.05);*/
	}

	.avatar-container img {
		position: relative;
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
		flex-direction: column;
		font-family: 'Nunito', 'Arial';
		font-weight: normal;
		margin-top: 10px;
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
		animation: avatarUp .4s;
		max-width: 90vw;
		max-height: 80vh;
	}

	.avatar-container.full-size-avatar-container {
		position: fixed;
		z-index: 89;
		width: 100vw;
		height: 100vh;
		left: 0px;
		top: 0px;
		border-radius: 0;
		background-color: rgba(0, 0, 0, 0.3);
		cursor: default;
		animation: avatarUp .2s;
	}

	.avatar-container.full-size-avatar-container .full-size-avatar:hover {
		transform: none;
	}

	.close-map-btn {
		top: 15px;
		right: 30px;
		position: absolute;
		fill: #f1f1f1;
		cursor: pointer;
		transition: .2s;
	}

	.close-map-btn:hover {
		transform: scale(1.2) rotate(90deg);
		fill: #c54646;
	}

	.close-map-btn:active {
		transform: scale(0.9) rotate(90deg);
	}

	@keyframes avatarUp {
		from {
			transform: scale(0.1);
			opacity: 0;
		}
		to {
			transform: scale(1);
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
		align-items: center;
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
	    z-index: 100;
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

    .alerts-enter, .alerts-leave-to {
	  opacity: 0;
	  transform: translateY(30px);
	}
	.alerts-leave-active {
	  position: absolute;
	}

    .custom-card-header-mute:hover {
    	cursor: default;
    	background-color: #f2f2f4;
    }

    .image-buttons {
    	position: absolute;
    	top: 0;
    	left: 0;
    	display: flex;
    	flex-direction: column;
    	width: 100%;
    	height: 100%;
	    border-radius: 50%;
    }

    .change-image, .remove-image {
		display: flex;
		justify-content: center;
		align-items: center;
		flex: 1;
		background-color: rgba(0, 0, 0, 0.3);
		transition: .2s;
		opacity: 0;
		cursor: pointer;
    }

    .change-image svg, .remove-image svg {
		fill: rgba(255, 255, 255, 0.9);
		transition: .2s;
		cursor: pointer;
    }

    .change-image:hover svg {
    	fill: rgba(0, 204, 0, 0.7);
    }

    .remove-image:hover svg {
    	fill: rgba(204, 0, 0, 0.7);
    }

    .image-buttons:hover .change-image, .image-buttons:hover .remove-image {
		opacity: 1;
		transform: translateY(0);
    }

    .change-image {
		transform: translateY(-100%);
    }

    .remove-image {
		transform: translateY(100%);
    }

    .hidden {
    	display: none;
    }

    .default-avatar {
    	transform: scale(-1, 1);
    }

    .add-image {
    	position: absolute;
    	width: 100%;
    	height: 100%;
    	display: flex;
    	justify-content: center;
    	align-items: center;
    	cursor: pointer;
    	opacity: 0;
    	transition: .2s;
    	background-color: rgba(0, 0, 0, 0.3);
    	z-index: 100;
    }

    .add-image svg {
    	fill: rgba(0, 162, 0, 1);
    	width: 64px;
    	cursor: pointer;
    }

    .avatar-container:hover .add-image {
		opacity: 1;
    }

    .social-item {
    	margin-bottom: 10px;
    }

    .social-default {
    	font-size: 14px;
    }

    .custom-btn {
    	cursor: pointer;
    }

    .tricks-wrap {
    	display: flex;
    	flex-direction: column;
    }

    .custom-all-tricks-button, .custom-add-video-button {
		align-self: flex-end;
		cursor: pointer;
		margin-bottom: 20px;
		font-family: 'Nunito', 'Arial';
    	font-weight: normal;
    }

    .all-tricks-container {
    	font-family: 'Nunito', 'Arial';
    	font-weight: normal;
    }

    .custom-list-group {
		flex-direction: row;
		justify-content: space-between;
		flex-wrap: wrap;
    }

    .custom-list-group .custom-list-group-item {
		margin-bottom: 10px;
		width: 33%;
		display: flex;
		justify-content: space-between;
		transition: all .5s ease;
    }

    .new-tricks-enter, .new-tricks-leave-to {
	  opacity: 0;
	  transform: translateY(30px);
	}
	.new-tricks-leave-active {
	  position: absolute;
	}

    .add-element {
    	color: #5cb85c;
    	opacity: 0;
    	transition: .2s;
    	cursor: pointer;
    }

    .add-element:hover {
    	color: #449d44;
    }

    .custom-list-group-item:hover .add-element {
    	opacity: 1;
    }

    .remove-trick {
    	transition: .2s;
    	cursor: pointer;
    	height: 30px;
    }

    .remove-trick svg {
    	transition: .2s;
		fill: #333;
		width: 30px;
    }

    .remove-trick svg path {
		fill: #333;
		stroke: #333;
		transition: .2s;
		transform-origin: center center;
    }

    .remove-trick:hover svg path {
    	fill: #a00;
    	stroke: #a00;
    }

    .remove-trick svg circle {
		stroke: #333 !important;
		transition: .2s;
    }

    .remove-trick:hover svg circle {
    	stroke: #a00 !important;
    }
    .remove-trick:hover svg .remove-trick-first-path {
    	transform: rotate(90deg);
    }

    .remove-trick:hover svg .remove-trick-second-path {
    	transform: rotate(-90deg);
    }

    .remove-trick:active svg .remove-trick-first-path {
    	transform: rotate(135deg);
    }

    .remove-trick:active svg .remove-trick-second-path {
    	transform: rotate(-135deg);
    }

    .remove-video {
    	fill: #555;
    	width: 24px;
    	transition: .2s;
    	cursor: pointer;
    }

    .remove-video:hover {
    	fill: #a00;
    }

    .custom-alert-container {
    	position: fixed;
    	top: 70px;
    	display: flex;
    	flex-direction: column;
    	z-index: 200;
    	transition: .2s;
    }

    .custom-alert-container .alert {
		transition: .2s;
    }

    .video-date {
    	display: flex;
    	flex-direction: column;
    }

    .video-date-year {
    	font-size: 14px;
    }

    .video-date-dm {
    	font-size: 18px;
    }

    .video-add-spot, .video-remove-spot {
    	width: 36px;
    	transition: .2s;
    	cursor: pointer;
    }

    .video-remove-spot {
		width: 30px;
    }

    .video-remove-spot:hover {
    	fill: #a00;
    }

    .video-add-spot:hover {
    	fill: #080;
    }

    .video-edit-buttons {
    	display: flex;
    	align-items: center;
    	height: 24px;
    }

    .map-container {
    	position: fixed;
        z-index: 1002;
	    width: 100vw;
	    height: 100vh;
	    left: 0px;
	    top: 0px;
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    background-color: rgba(0, 0, 0, 0.5);
    }

    .map-wrap {
		width: 90%;
		height: 80%;
    }

    .mobile-add-element {
    	display: none;
    	position: absolute;
    	top: 0;
    	right: 10px;
    	bottom: 0;
    }

    .mobile-add-element svg {
    	width: 30px;
    }

    .custom-add-video-btn {
    	position: relative;
    }

    .video-load-placeholder {
	    position: absolute;
	    width: 100%;
	    height: 100%;
	    left: 0;
	    top: 0;
	    background-color: #0275d8;
    }

    .video-load-placeholder path {
    	stroke: #fff;
    }

    .image-load-placeholder {
    	width: 100%;
    	height: 100%;
    }

    .image-load-placeholder path {
    	stroke: rgb(91, 157, 232);
    }

    @media(max-width: 1160px) {
    	.profile-content {
    		width: auto;
    	}

    	.trick-container {
    		width: 450px;
    	}

    	.custom-video-container .custom-video {
    		min-height: 200px;
    		max-height: 300px;
    	}
    }

    @media(max-width: 1040px) {
    	.trick-container {
    		width: 350px;
    	}

    	.custom-video-container .custom-video {
    		min-height: 150px;
    		max-height: 250px;
    	}

    	.desktop-add-element {
    		display: none;
    	}

    	.mobile-add-element {
	    	display: flex;
	    	align-items: center;
    	}
    }

    @media(max-width: 830px) {
    	.tricks-container {
    		justify-content: center;
    	}

    	.trick-container {
    		width: 500px;
    	}

    	.custom-video-container .custom-video {
    		min-height: 250px;
    		max-height: 400px;
    	}

    	.custom-list-group .custom-list-group-item {
    		width: 49%;
    	}

    	.change-image, .remove-image {
    		opacity: 1;
    		transform: translateY(0);
    	}

    	.avatar-container .add-image {
    		opacity: 1;
    	}

    	.avatar-wrap {
    		width: 200px;
    	}

    	.avatar-container {
    		width: 150px;
    		height: 150px;
    	}
    }

    @media(max-width: 700px) {
    	main.main-content {
    		padding: 0px 10px 0px 10px;
    	}

    	.avatar-wrap {
    		width: 150px;
    	}

    	.avatar-container {
    		width: 100px;
    		height: 100px;
    	}

    	.image-buttons svg {
    		width: 36px;
    		height: 36px;
    	}
    }

    @media(max-width: 560px) { 
    	.custom-video-container .custom-video {
    		min-height: 150px;
    		max-height: 300px;
    	}

    	.profile-info {
    		flex-direction: column;
    	}

    	.avatar-wrap {
    		width: 100%;
		    margin-bottom: 20px;
    	}

    	.avatar-container {
    		width: 200px;
    		height: 200px;
    	}

    	.image-buttons svg {
    		width: 64px;
    		height: 64px;
    	}
    }

    @media(max-width: 480px) { 
    	.custom-list-group .custom-list-group-item {
    		width: 100%;
    	}

    	.social-default {
    		font-size: 11px;
    	}

    	.social-item .custom-btn {
    		font-size: 12px;
    	}

    	.close-map-btn {
    		top: 5px;
    		right: 10px;
		    fill: #e33;
    		z-index: 2000;
    	}
    }
</style>