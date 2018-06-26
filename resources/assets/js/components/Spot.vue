<template>
	<div class="content-container">
		<div class="main-spot-content">
			<div class="spot-page-section">
				<div id="map">
		
				</div>
				<div class="spot-description">
					<h4 class="spot-description-title">Description</h4>
					<div class="spot-description-body" :class="{'spot-description-body-active' : editMode}">
						<div v-if="!editMode" class="spot-description-text" key="1">
							{{spot.description ? spot.description : 'This spot has no description'}}
						</div>
						<div v-else contenteditable="true" @input="inputDescription" class="spot-description-text" key="2">
							{{spot.description}}
						</div>
						<button v-if="editMode" class="btn btn-secondary custom-btn-save-description" type="button" @click="changeDescription">Save</button>
					</div>
				</div>
				<div class="spot-videos">
					<transition-group class="tricks-container" tag="div" name="videos" mode="out-in">
						<div v-for="video in currentVideos(currentTrick)" :key="video.id" class="trick-container card">
							<h3 class="card-header custom-card-header custom-card-header-full-videos custom-card-header-mute">
								<template v-if="!editMode || video.user_id != user">
									<span>{{getDate(video.created_at, 'year')}}</span>
									<span @mouseover="tip.msg='Day and month'; tip.show=true;"
										  @mouseout="tip.show=false">{{getDate(video.created_at, 'dm')}}</span>
								</template>
								<template v-else>
									<span class="video-date">
										<span class="video-date-year">{{getDate(video.created_at, 'year')}}</span>
										<span 
											class="video-date-dm"
											@mouseover="tip.msg='Day and month'; tip.show=true;"
											@mouseout="tip.show=false">
											{{getDate(video.created_at, 'dm')}}
										</span>
									</span>
									<span class="video-edit-buttons">
										<svg 
											v-if="video.spot_id"
											@mouseover="tip.msg='Detach from spot'; tip.show=true;"
											@mouseout="tip.show=false"
											@click="removeSpotFromVideo(video.id)"
											class="video-remove-spot" 
											xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 144.083 144.083" enable-background="new 0 0 144.083 144" xml:space="preserve">
											<path d="M64.759,44.479c-10.203,0-18.504,8.301-18.504,18.504c0,10.202,8.301,18.503,18.504,18.503  c10.203,0,18.503-8.301,18.503-18.503C83.262,52.78,74.961,44.479,64.759,44.479z M64.759,78.486  c-8.549,0-15.504-6.955-15.504-15.503c0-8.549,6.955-15.504,15.504-15.504c8.548,0,15.503,6.955,15.503,15.504  C80.262,71.532,73.307,78.486,64.759,78.486z"/>
											<path d="M95.856,78.513c2.975-5.458,4.941-10.823,4.941-15.518c0-19.872-16.166-36.039-36.039-36.039  c-19.872,0-36.039,16.167-36.039,36.039c0,19.51,33.595,50.587,35.024,51.901l1.015,0.932l1.015-0.932  c0.49-0.451,4.769-4.41,10.172-10.195c2.545,8.294,10.271,14.343,19.389,14.343c11.182,0,20.279-9.097,20.279-20.278  C115.614,87.76,106.795,78.793,95.856,78.513z M75.194,101.049c-4.623,5.053-8.631,8.964-10.435,10.682  C59.096,106.336,31.72,79.4,31.72,62.995c0-18.218,14.821-33.039,33.039-33.039c18.218,0,33.039,14.821,33.039,33.039  c0,4.644-2.199,10.134-5.477,15.74c-9.754,1.464-17.266,9.875-17.266,20.03C75.055,99.539,75.108,100.299,75.194,101.049z   M95.334,116.044c-9.527,0-17.279-7.751-17.279-17.278s7.752-17.279,17.279-17.279c9.529,0,17.279,7.752,17.279,17.279  S104.864,116.044,95.334,116.044z"/>
											<rect x="86.545" y="97.286" width="17.576" height="3"/>
										</svg>
									</span>
								</template>
							</h3>
							<div class="card-body custom-card-body">
								<app-video :video="video"></app-video>
							</div>
						</div>
					</transition-group>
				</div>
			</div>
			<div class="spot-page-section comments-container">
				<div class="comments-adding-container" @focus.capture="commentFocus" @blur.capture="commentBlur" ref="commentContainer">
					<div class="comments-adding-wrap">
						<div contenteditable="true" @input="inputComment" class="comments-add-field" ref="comment"></div>
						<svg xmlns="http://www.w3.org/2000/svg" 
							viewBox="0 0 100 100" x="0px" y="0px" 
							class="svg-add-comment" :class="newComment == '' ? 'svg-add-comment-disabled' : ''"
							@click="addComment">
							<path d="M51.14,52.05,25,54.58l-6.88,22a3.41,3.41,0,0,0,4.75,4.09L80.16,52.93a3.26,3.26,0,0,0,0-5.86L22.91,19.31a3.41,3.41,0,0,0-4.75,4.09l6.88,22,26.09,2.53a2.06,2.06,0,0,1,0,4.1Z"/>
						</svg>
						<span v-if="newComment == ''" class="comments-adding-placeholder">Text...</span>
					</div>
				</div>
				<div class="comments-wrap">
					<div v-for="post in comments" class="comment-container" :key="post.comment.id">
						<div class="comment-header">
							<a :href="getUserRoute(post.user.id)" class="comment-thumbnail-container">
								<img :src="post.user.thumbnail" alt="small avatar" class="comment-thumbnail">
							</a>
							<div class="comment-header-info">
								<a :href="getUserRoute(post.user.id)" class="comment-user-name">
									{{post.user.first_name + ' ' + post.user.last_name}}
								</a>
								<span class="comment-date">
									{{getDate(post.comment.created_at, 'comment')}}
								</span>
							</div>
							<svg v-if="post.user.id == user" class="remove-comment" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" @click="removeComment(post.comment.id)">
								<path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
							</svg>
						</div>
						<div class="comment-body">
							{{post.comment.description}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<aside class="aside-content">
			<div class="images-block-container spot-page-section">
				<div class="images-container">
					<transition-group tag="div" name="images-slider" class="images-wrap" :style="{width: images.length * 330 + 'px', transform: 'translateX(' + sliderPosition + 'px)'}">
						<div v-for="image in images" :key="image.path" class="image-wrap" @click="sliderOpened = true;" style="opacity: 0;">
							<img :src="image.path" @load="adjustImg">
							<transition name="remove-image">
								<div class="remove-image" v-if="editMode" @click.stop="removeImage(image.id, $event)">
									<svg class="downsize-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" width="64px" height="64px">
										<path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
									</svg>
								</div>
							</transition>
						</div>
					</transition-group>
					<div> <!-- If no photos -->
						<svg version="1.1" baseProfile="tiny" id="DESIGNS" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" xml:space="preserve">
							<g>
								<g>
									<rect x="4.5" y="3.5" transform="matrix(0.9659 -0.2588 0.2588 0.9659 -3.5956 4.6861)" fill="#DBD2C1" width="23" height="25"></rect>
								</g>
								<rect x="4.5" y="3.5" fill="#FFFAEE" width="23" height="25"></rect>
								<g>
									
									<svg x="12" y="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" width="8" height="8" class="remove-move"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>
									<rect x="6.5" y="5.5" fill="#3D3935" width="19" height="17"></rect>
								</g>
								<path fill="#231F20" d="M28,26.2l3-0.8l-3-11V3h-3.1l-0.7-2.7L14.3,3H4v2.8L1,6.5l3,11V29h3.1l0.7,2.7l9.9-2.7H28V26.2z M29.7,24.7
									L28,25.2v-6.9L29.7,24.7z M23.5,1.6L23.9,3h-5.8L23.5,1.6z M2.3,7.3L4,6.8v6.9L2.3,7.3z M8.5,30.4L8.1,29h5.8L8.5,30.4z M27,28H5V4
									h22V28z M26,5H6v18h20V5z M25,22H7V6h18V22z"></path>
							</g>
							<text transform="matrix(1 0 0 1 7 26.223)" fill="#231F20" font-family="'Nunito'" font-size="3px">N</text>
							<text transform="matrix(1 0 0 1 9.2793 26.223)" fill="#231F20" font-family="'Nunito'" font-size="3px">O</text>
							<text transform="matrix(1 0 0 1 11.6553 26.223)" fill="#231F20" font-family="'Nunito'" font-size="3px"> </text>
							<text transform="matrix(1 0 0 1 12.4053 26.223)" fill="#231F20" font-family="'Nunito'" font-size="3px">P</text>
							<text transform="matrix(1 0 0 1 14.4063 26.223)" fill="#231F20" font-family="'Nunito'" font-size="3px">H</text>
							<text transform="matrix(1 0 0 1 16.686 26.223)" fill="#231F20" font-family="'Nunito'" font-size="3px">O</text>
							<text transform="matrix(1 0 0 1 18.9478 26.223)" fill="#231F20" font-family="'Nunito'" font-size="3px">T</text>
							<text transform="matrix(1 0 0 1 20.7827 26.223)" fill="#231F20" font-family="'Nunito'" font-size="3px">O</text>
							<text transform="matrix(1 0 0 1 23.1587 26.223)" fill="#231F20" font-family="'Nunito'" font-size="3px">S</text>
						</svg>
					</div>
				</div>
				<transition name="slider">
					<div v-if="sliderOpened" class="slider-fullsize">
						<div class="images-wrap-fullsize" :style="{width: fullsizeSliderWidth + 'px', transform: 'translateX(' + fullsizeSliderPosition + 'px)'}">
							<div v-for="image in images" :key="image.path" class="image-wrap-fullsize" @click="sliderOpened = false;">
								<img :src="image.path" @load="adjustFullsizeImg" @resize="adjustFullsizeImg" ref="images" @click.stop>
							</div>
						</div>
						<svg class="fullsize-button-left button-left" xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" @click.stop="prevImg">
							<path d="M74.7,31.1L55.8,50l18.9,18.9c5.1,5.1,5.1,13.4,0,18.5h0c-5.1,5.1-13.4,5.1-18.5,0L37.3,68.5L23.4,54.6  c-2.6-2.6-2.6-6.7,0-9.3l13.9-13.9l18.9-18.9c5.1-5.1,13.4-5.1,18.5,0h0C79.8,17.7,79.8,26,74.7,31.1z"/>
						</svg>
						<svg class="fullsize-button-right button-right" xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" @click.stop="nextImg">
							<path d="M74.7,31.1L55.8,50l18.9,18.9c5.1,5.1,5.1,13.4,0,18.5h0c-5.1,5.1-13.4,5.1-18.5,0L37.3,68.5L23.4,54.6  c-2.6-2.6-2.6-6.7,0-9.3l13.9-13.9l18.9-18.9c5.1-5.1,13.4-5.1,18.5,0h0C79.8,17.7,79.8,26,74.7,31.1z"/>
						</svg>
					</div>
				</transition>
				<div class="images-control">
					<div class="images-control-info">
						<form method="POST" enctype="multipart/form-data" id="upload-img" v-if="editMode">
							<input type="hidden" name="_token" :value="token">
							<input type="file" name="image[]" class="hidden" ref="crap" @change="uploadImg" multiple>
							<button type="button" class="btn btn-secondary" @click="$refs.crap.click()">Add images</button>
						</form>
						<span>{{currentImage}} of {{images.length}}</span>
					</div>
					<div class="images-control-buttons">
						<svg class="button-left" xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" @click="prevImg">
							<path d="M74.7,31.1L55.8,50l18.9,18.9c5.1,5.1,5.1,13.4,0,18.5h0c-5.1,5.1-13.4,5.1-18.5,0L37.3,68.5L23.4,54.6  c-2.6-2.6-2.6-6.7,0-9.3l13.9-13.9l18.9-18.9c5.1-5.1,13.4-5.1,18.5,0h0C79.8,17.7,79.8,26,74.7,31.1z"/>
						</svg>
						<svg class="button-right" xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" @click="nextImg">
							<path d="M74.7,31.1L55.8,50l18.9,18.9c5.1,5.1,5.1,13.4,0,18.5h0c-5.1,5.1-13.4,5.1-18.5,0L37.3,68.5L23.4,54.6  c-2.6-2.6-2.6-6.7,0-9.3l13.9-13.9l18.9-18.9c5.1-5.1,13.4-5.1,18.5,0h0C79.8,17.7,79.8,26,74.7,31.1z"/>
						</svg>
					</div>
				</div>
			</div>
			<div class="spot-elements spot-page-section">
				<ul v-if="editMode" class="nav nav-tabs nav-tricks">
				  <li class="nav-item">
				    <a class="nav-link" href="#" 
				    	@click.prevent="showMyMoves = true;"
				    	:class="{active: showMyMoves}">
					    My Moves
					</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" href="#" 
						@click.prevent="showMyMoves = false;"
						:class="{active: !showMyMoves}">
						Add Moves
					</a>
				  </li>
				</ul>
				<h3 v-else class="spot-elements-title">List of elements</h3>
				<transition-group name="side-tricks" tag="ul" class="spot-elements-list">
					<li v-if="showMyMoves"
						v-for="trick in tricks" 
						:key="trick.id"
						@click="currentVideos(trick.id).length > 0 ? currentTrick = trick.id : ''" 
						class="spot-elements-list-item" 
						:class="{'spot-elements-list-item-active' : currentTrick == trick.id, 'with-video' : currentVideos(trick.id).length > 0}">
						<span>
							<svg @click.stop="removeMove(trick.id)" class="remove-move" v-if="editMode" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" width="64px" height="64px">
								<path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
							</svg>
							{{trick.name}}
						</span>
						
						<template v-if="currentVideos(trick.id).length > 0">
							<svg v-if="currentTrick != trick.id" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="svg-with-video">
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
					<li v-if="!showMyMoves"
						v-for="trick in new_tricks"
						:key="trick.id"
						class="spot-elements-list-item">
						<svg @click.stop="addMove(trick.id)" class="add-move" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" width="64px" height="64px">
							<path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
						</svg>
						<span>{{trick.name}}</span>
					</li>
				</transition-group>
			</div>
		</aside>
		<svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 100" x="0px" y="0px" class="settings-btn" 
			:style="{fill: editMode ? '#5b9de8' : '', transform: editMode ? 'rotate(60deg)' : ''}"
			@click="editMode = !editMode; tip.show=false;"
			@mouseover="tip.msg = editMode ? 'Disable edit mode' : 'Enable edit mode'; tip.show=true;"
			@mouseout="tip.show=false"
			v-if="owner">
			<path d="M98.44,43.73c-0.8-.51-7.11-4.28-9.61-5.43l-3.1-7.5c0.92-2.48,2.69-9.43,3-10.64a3.34,3.34,0,0,0-.9-3.1L82.94,12.2a3.32,3.32,0,0,0-3.1-.9c-0.92.21-8,2-10.64,3l-7.5-3.1c-1.09-2.4-4.76-8.55-5.43-9.61A3.32,3.32,0,0,0,53.44,0H46.56a3.35,3.35,0,0,0-2.83,1.56c-0.51.8-4.28,7.11-5.43,9.61l-7.5,3.1c-2.48-.92-9.43-2.69-10.64-3a3.34,3.34,0,0,0-3.1.9L12.2,17.06a3.32,3.32,0,0,0-.9,3.1c0.21,0.92,2,8,3,10.64l-3.1,7.5c-2.4,1.09-8.55,4.76-9.61,5.43A3.32,3.32,0,0,0,0,46.56v6.87a3.35,3.35,0,0,0,1.56,2.83c0.8,0.51,7.11,4.28,9.61,5.43l3.1,7.5c-0.92,2.48-2.69,9.43-3,10.64a3.34,3.34,0,0,0,.9,3.1l4.86,4.86a3.32,3.32,0,0,0,3.1.9c0.92-.21,8-2,10.64-3l7.5,3.1c1.09,2.4,4.76,8.55,5.43,9.61A3.32,3.32,0,0,0,46.56,100h6.87a3.35,3.35,0,0,0,2.83-1.56c0.51-.8,4.28-7.11,5.43-9.61l7.5-3.1c2.48,0.92,9.43,2.69,10.64,3a3.34,3.34,0,0,0,3.1-.9l4.86-4.86a3.32,3.32,0,0,0,.9-3.1c-0.21-.92-2-8-3-10.64l3.1-7.5c2.4-1.09,8.55-4.76,9.61-5.43A3.32,3.32,0,0,0,100,53.44V46.56A3.3,3.3,0,0,0,98.44,43.73ZM50,71.77A21.79,21.79,0,1,1,71.81,50,21.82,21.82,0,0,1,50,71.77Z"/>
		</svg>
		<tip :msg="tip.msg" v-if="tip.show"></tip>
		<transition-group name="alerts" tag="div" class="custom-alert-container">
			<template v-for="(response, key) in responses">
					<Alert :msg="response.msg" :error="response.error" v-if="response.show" :key="response.key"></Alert>
			</template>
		</transition-group>
	</div>
</template>

<script>
	import appVideo from './Video.vue';
	import Tip from './Tip.vue';
	import Alert from './Alert.vue';

	export default {
		props: ['routes', 'src_images', 'src_spot', 'tricks_src', 'src_videos', 'user', 'src_new_tricks', 'src_comments', 'local'],
		data() {
			return {
				videos: this.src_videos,
				images: this.src_images,
				spot: this.src_spot,
				currentTrick: null,
				tricks: null,
				currentImage: 1,
				sliderPosition: 0,
				fullsizeSliderPosition: 0,
				sliderOpened: false,
				editMode: false,
				tip: {
					show: false,
					msg: '',
				},
				token: $('meta[name="csrf-token"]').attr('content'),
				newDescription: this.src_spot.description,
				responses: [],
				customKey: 10,
				showMyMoves: true,
				new_tricks: this.src_new_tricks,
				owner: this.src_spot.user_id == this.user,
				newComment: '',
				comments: this.src_comments,
			}
		},
		computed: {
			fullsizeSliderWidth() {
				return this.images.length * document.documentElement.clientWidth;
			},
		},
		created() {
			this.tricks = this.sortTricks(this.tricks_src);
			this.currentTrick = this.tricks[0].id;
		},
		mounted() {
			if(window.mapLoaded === undefined) {
				var heh = document.querySelector('#googleMap');
				heh.addEventListener('load', this.initMap);
			} else {
				this.initMap();
			}

			window.addEventListener('resize', this.onResize);
			console.log(this.user);
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
				} else if(type == 'comment') {
					var hms = date.split(' ')[1].split(':');
					var result = `${arr[2]} ${this.local.months[parseInt(arr[1])]} ${arr[0]} ${this.local.at} ${hms[0]}:${hms[1]}`;
					return result;
				}
			},
			sortTricks(tricks) {
				var self = this;
				return tricks.sort(function(a, b) {
					if(self.currentVideos(a.id) > self.currentVideos(b.id)) {
						return -1;
					} else if(self.currentVideos(a.id) < self.currentVideos(b.id)) {
						return 1;
					}
					return 0;
				});
			},
			adjustImg(e) {
				var img = e.target;
				var settings = getComputedStyle(img);
				if(parseInt(settings.width) > parseInt(settings.height)) {
					img.classList.add('wide');
					img.style.left = '-' + parseInt(settings.width)/2 + 'px';
				} else {
					img.classList.add('high');
					img.style.top = '-' + parseInt(settings.height)/2 + 'px';
				}
				img.parentNode.style.opacity = 1;
			},
			prevImg() {
				var currentImage = this.currentImage - 1;
				if(currentImage < 1) this.currentImage = this.images.length;
				else this.currentImage = currentImage;
			},
			nextImg() {
				var currentImage = this.currentImage + 1;
				if(currentImage > this.images.length) this.currentImage = 1;
				else this.currentImage = currentImage;
			},
			adjustFullsizeImg(e) {
				var img = e.target || e;
				var settings = getComputedStyle(img);
				img.style.top = (document.documentElement.clientHeight - parseInt(settings.height))/2 + 'px';
				img.style.left = (document.documentElement.clientWidth - parseInt(settings.width))/2 + 'px';
			},
			onResize() {
				if(this.sliderOpened) {
					for(var i = 0; i < this.$refs.images.length; i++) {
						this.adjustFullsizeImg(this.$refs.images[i]);
					}
				}
			},
			uploadImg() {
				var self = this;
				var form = new FormData(document.querySelector("#upload-img"));
				form.append('spot_id', this.spot.id);
				$.ajax({
    			  method: "post",
    			  url: self.routes.addImages,
    			  contentType: false,
    			  processData: false,
    			  data: form,
    			  success: function(data) { 
    			  	self.images = data;
    			  	if(self.currentImage == 0) self.currentImage = 1;
    			  },
                  error: function(data, b, c) {
                    console.log(data);
                  }
				});
			},
			removeImage(id, event) {
				event.currentTarget.parentNode.style.pointerEvents = "none";
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: self.routes.removeImage,
    			  headers: {
				    'X-CSRF-TOKEN': self.token,
				  },
    			  data: {
    			  	image_id: id,
    			  	_token: self.token,
    			  },
    			  success: function(data) { 
    			  	self.images = data;
    			  	if(self.currentImage > self.images.length) self.currentImage = self.images.length;
    			  },
                  error: function(data, b, c) {
                  	event.currentTarget.parentNode.style.pointerEvents = "auto";
                    console.log(data);
                  }
				});
			},
			changeDescription() {
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: self.routes.editDescription,
    			  headers: {
				    'X-CSRF-TOKEN': self.token,
				  },
    			  data: {
    			  	description: self.newDescription || null,
    			  	_token: self.token,
    			  },
    			  success: function(data) { 
    			  	if(typeof data == 'object') data = null;
    			  	self.spot.description = data;
    			  	var response = {};
                    response.msg = 'Description changed';
    			  	response.error = false;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
    			  },
                  error: function(data, b, c) {
                    var response = {};
                    response.msg = data.responseJSON.errors.description[0];
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
			removeMove(trick_id) {
				var self = this;

				if(this.tricks.length <= 1) {
					var response = {};
                    response.msg = 'Spot must have at least one move';
    			  	response.error = true;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
                    return;
				}
				
				$.ajax({
    			  method: "post",
    			  url: self.routes.removeMove,
    			  headers: {
				    'X-CSRF-TOKEN': self.token,
				  },
    			  data: {
    			  	move: trick_id,
    			  	_token: self.token,
    			  },
    			  success: function(data) {
    			  	self.tricks = self.sortTricks(data.attached_tricks);
    			  	if(self.currentTrick == trick_id) self.currentTrick = self.tricks[0].id;
    			  	self.new_tricks = data.new_tricks;
    			  },
                  error: function(data, b, c) {
                  	console.log(data);
                  }
				});
			},
			addMove(trick_id) {
				var self = this;

				$.ajax({
    			  method: "post",
    			  url: self.routes.addMove,
    			  headers: {
				    'X-CSRF-TOKEN': self.token,
				  },
    			  data: {
    			  	move: [trick_id],
    			  	_token: self.token,
    			  },
    			  success: function(data) {
    			  	self.tricks = self.sortTricks(data.attached_tricks);
    			  	self.new_tricks = data.new_tricks;
    			  },
                  error: function(data, b, c) {
                  	console.log(data);
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
    			  	self.tip.show = false;
    			  	var response = {};
                    response.msg = "Video successfuly detached from this spot";
    			  	response.error = false;
    			  	response.show = true;
    			  	response.key = self.customKey++;
    			  	self.responses.push(response);
    			  	setTimeout(()=> {
                        self.responses.shift();
                    }, 5000);
    			  },
                  error: function(data) {
                    console.log(data);
                  }
				});
			},
			inputDescription(e) {
				this.newDescription = e.target.textContent;
			},
			inputComment(e) {
				this.newComment = e.target.textContent;
			},
			addComment() {
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: self.routes.addComment,
    			  dataType: "json",
    			  headers: {
				    'X-CSRF-TOKEN': self.token,
				  },
    			  data: {
    			  	text: self.newComment,
    			  	_token: self.token,
    			  },
    			  success: function(data) { 
    			  	self.$refs.comment.innerHTML = '';
    			  	self.newComment = '';
    			  	self.comments = data;
    			  },
                  error: function(data) {
                    console.log(data);
                  }
				});
			},
			commentFocus(e) {
				this.$refs.commentContainer.style.padding = "20px 20px 20px 30px";
			},
			commentBlur(e) {
				this.$refs.commentContainer.style.padding = "10px 20px 10px 30px";
			},
			removeComment(comment_id) {
				var self = this;
				$.ajax({
    			  method: "post",
    			  url: self.routes.removeComment,
    			  dataType: "json",
    			  headers: {
				    'X-CSRF-TOKEN': self.token,
				  },
    			  data: {
    			  	comment_id: comment_id,
    			  	_token: self.token,
    			  },
    			  success: function(data) { 
    			  	self.comments = data;
    			  },
                  error: function(data) {
                    console.log(data);
                  }
				});
			},
		},
		components: {
			appVideo,
			Tip,
			Alert,
		},
		watch: {
			currentImage(val) {
				var val = val - 1;
				this.sliderPosition = val * -330;
				this.fullsizeSliderPosition = val * -parseInt(document.documentElement.clientWidth);
			},
			editMode(val) {
				if(val == false) {
					if(this.showMyMoves == false) this.showMyMoves = true;
				}
			},
			sliderOpened(val) {
				if(val) {
					document.querySelector('html').style.overflowY = 'hidden';
				} else {
					document.querySelector('html').style.overflowY = 'visible';
				}
			},
			videos(val) {
				if(this.currentVideos(this.currentTrick).length <= 0) {
					this.currentTrick = this.tricks[0].id;
				}
			},
		}
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
	    position: relative;
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

	.images-block-container {
		height: 312px;
		margin-bottom: 20px;
		width: 100%;
	}

	.images-container {
		width: 100%;
		height: 226px;
		overflow: hidden;
	}

	.images-wrap {
		display: flex;
		width: 100%;
		height: 100%;
		transition: transform .5s;
	}

	.image-wrap {
		width: 330px;
		height: 100%;
		overflow: hidden;
		position: relative;
		cursor: pointer;
		transition: .2s;
	}

	.image-wrap img {
		position: relative;
	    user-select: none;
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
		user-select: none;
	}

	.spot-description {
		padding: 30px;
	}

	.spot-description p {
		font-size: 20px;
		word-wrap: break-word;
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
		min-height: 200px !important;
	}

	.custom-card-header {
		font-size: 16px;
		font-family: 'Nunito';
		font-weight: normal;
		background-color: #f2f2f4;
		display: flex;
		justify-content: space-between;
		position: relative;
	    height: 41px;
	    align-items: center;
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

    .slider-enter, .slider-leave-to,
    .remove-image-enter, .remove-image-leave-to {
		opacity: 0;
    }

    .slider-enter-to, .slider-leave,
    .remove-image-enter-to, .remove-image-leave {
    	opacity: 1;
    }

    .slider-enter-active, .slider-leave-active,
    .remove-image-enter-active, .remove-image-leave-active {
    	transition: .5s;
    }

    .spot-elements-list-item {
    	display: flex;
    	transition: .5s;
    }

    .spot-elements-list-item:not(.with-video) {
    	cursor: default;
    }

    .spot-elements-list-item-active span {
    	transform: translateX(-30px);
    	font-weight: bold;
    }

    .spot-elements-list-item span {
    	align-self: center;
	    display: flex;
    	align-items: center;
    	transition: .5s;
    }

    .spot-elements-list-item:hover span.with-video {
    	font-weight: bold;
    }

    .spot-elements-list-item svg {
    	width: 30px;
    	height: 30px;
    	transition: .5s;
    }

    .spot-elements-list-item:hover .svg-with-video {
    	transform: scale(-1, 1);
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

    .high {
		width: 100%;
		margin: 50% 0 0 0;
	}

	.wide {
		height: 100%;
		margin: 0 0 0 50%;
	}

	.images-control {
		display: flex;
		justify-content: space-between;
		align-items: center;
    	padding: 20px;
    	height: 86px;
	}

	.images-control-info {
		user-select: none;
		display: flex;
		flex-direction: column;
		align-items: center;
		transition: all .5s;
	}

	.images-control-info form {
		margin-bottom: 10px;
	}

	.images-control-buttons {
		display: flex;
	}

	.images-control-buttons svg {
		width: 32px;
		height: 32px;
		fill: #777;
		transition: .1s;
		cursor: pointer;
	}

	.button-left:hover, .button-right:hover {
		fill: #5b9de8;
	}

	.button-left {
		margin-right: 10px;
	}

	.button-right {
		transform: scale(-1, 1);
	}

	.slider-fullsize {
		position: fixed;
		z-index: 100;
		top: 0;
		left: 0;
		width: 100vw;
		height: 100vh;
		background-color: rgba(0, 0, 0, 0.5);
	}

	.images-wrap-fullsize {
		display: flex;
		height: 100%;
		transition: .5s;
	}

	.image-wrap-fullsize {
		width: 100vw;
		height: 100vh;
		position: relative;
	}

	.image-wrap-fullsize img {
		position: absolute;
		max-width: 90vw;
		max-height: 80vh;
		user-select: none;
	}

	.fullsize-button-right, .fullsize-button-left {
		width: 54px;
		height: 54px;
		fill: #fff;
		transition: .1s;
		cursor: pointer;
		position: absolute;
	}

	.fullsize-button-left {
		top: calc(50% - 27px);
		left: 10px;
	}

	.fullsize-button-right {
		top: calc(50% - 27px);
		right: 10px;
	}

	.settings-btn {
		width: 24px;
		position: absolute;
		top: 0;
		left: 100%;
		fill: rgba(0, 0, 0, 0.3);
		transition: .2s;
		transform: rotate(0deg);
		cursor: pointer;
	}

	.settings-btn:hover {
		fill: #5b9de8;
	}

	.remove-image {
		position: absolute;
		top: 0;
		right: 0;
		background-color: rgba(0, 0, 0, 0.5);
		width: 32px;
		height: 32px;
		cursor: pointer;
	}

	.remove-image svg {
		width: 32px;
		height: 32px;
		fill: #fff;
		transition: .2s;
	}

	.remove-image:hover svg {
		fill: #c00;
	}

	.hidden {
		display: none;
	}

	.image-wrap {
	  transition: all 1s;
	  display: inline-block;
	}

	.images-slider-enter, .images-slider-leave-to {
	  opacity: 0 !important;
	}
	.images-slider-leave-active {
	  position: absolute;
	  right: 0;
	  z-index: -1;
	}

	.custom-btn-save-description {
		cursor: pointer;
	    border: 0;
	    border-left: 1px solid #ccc;
	    border-radius: 0;
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

    .alerts-enter, .alerts-leave-to,
    .side-tricks-enter, .side-tricks-leave-to {
	  opacity: 0;
	  transform: translateY(30px);
	}
	.alerts-leave-active,
	.side-tricks-leave-active {
	  position: absolute;
	}

	.nav-tricks {
		margin-bottom: 20px;
	}

	.nav-tricks li a {
		color: #0275d8;
	}

	.nav-tricks li a:hover {
		color: #014c8c;
	}

	.spot-elements-list-item .remove-move {
		fill: #a00;
		transition: .2s;
		cursor: pointer;
		width: 24px;
		height: 24px;
	}

	.spot-elements-list-item .remove-move:hover {
		fill: #d00;
		transform: scale(1.1);
	}

	.spot-elements-list-item .add-move {
		width: 24px;
		height: 24px;
		fill: #090;
		transform: rotate(45deg);
		transition: .2s;
		cursor: pointer;
	}

	.spot-elements-list-item .add-move:hover {
		fill: #0b0;
		transform: rotate(45deg) scale(1.1);
	}

	.video-date {
    	display: flex;
    	flex-direction: column;
    	justify-content: center;
    }

    .video-date-year {
    	font-size: 12px;
    }

    .video-date-dm {
    	font-size: 14px;
    }

    .video-edit-buttons {
    	display: flex;
    	height: 30px;
    }

    .video-remove-spot {
    	width: 36px;
    	transition: .2s;
    	cursor: pointer;
    }

    .video-remove-spot:hover {
    	fill: #a00;
    }

    .comments-container {
    	margin-top: 20px;
    	margin-bottom: 300px;
    }

    .spot-description-body {
    	display: flex;
    	justify-content: space-between;
    }

    .spot-description-body-active {
    	border: 1px solid rgba(0, 0, 0, 0.2);
    	border-radius: 3px;
    }

    .spot-description-text {
		outline: none;
		width: 100%;
		white-space: normal;
    }

    .spot-description-body-active .spot-description-text {
    	padding: 7px;
	    max-width: 90%;
    }

    .comments-adding-container {
    	padding: 10px 20px 10px 30px;
    	font-family: 'Nunito';
    	font-weight: normal;
    	box-shadow: 0 2px 5px rgba(144,153,162,.1);
    	transition: .2s;
    }

    .comments-adding-placeholder {
    	position: absolute;
    	top: 7px;
    	left: 0;
    	color: #b4b8c4;
    	font-size: 16px;
    	z-index: 1;
    }

    .comments-adding-wrap {
    	position: relative;
    	display: flex;
    	align-items: center;
    }

    .comments-add-field {
    	width: 100%;
    	outline: 0;
    	font-size: 16px;
    	font-family: 'Nunito';
    	font-weight: normal;
    	color: #515669;
    	z-index: 2;
	    width: calc(100% - 30px);
    }

    .svg-add-comment {
    	fill: #5b9de8;
    	width: 30px;
    	height: 30px;
    	align-self: flex-end;
    }

    .svg-add-comment:hover:not(.svg-add-comment-disabled) {
    	fill: #2e82e2;
    	cursor: pointer;
    }

    .svg-add-comment-disabled {
    	fill: #88b8ee;
    	pointer-events: none;
    }

    .comments-wrap {
    	background-color: #fafbfb;
    	color: #515669;
	    font-size: 14px;
    }

    .comment-container {
	    padding: 30px 92px;
	    border-bottom: 1px solid #eaeaea;
    }

    .comment-header {
    	display: flex;
    	align-items: center;
    	margin-bottom: 15px;
    	position: relative;
    }

    .comment-header-info {
    	display: flex;
    	flex-direction: column;
    }

    .comment-thumbnail-container {
    	margin-right: 10px;
    }

    .comment-thumbnail {
    	border-radius: 50%;
    }

    .comment-user-name {
		color: #3d464a;
		font-size: 14px;
		font-weight: bold;
		margin-bottom: 5px;
    }

    .comment-date {
		color: #82889c;
		font-size: 12px;
    }

    .comment-body {
    	color: #222;
    	line-height: 20px;
    }

    .remove-comment {
    	position: absolute;
    	top: 0;
    	right: 0;
    	width: 18px;
    	height: 18px;
    	opacity: 0;
    	transition: .2s;
    	fill: #aaa;
    	cursor: pointer;
    }

    .remove-comment:hover {
    	fill: #a00;
    }

    .comment-container:hover .remove-comment {
    	opacity: 1;
    }
</style>