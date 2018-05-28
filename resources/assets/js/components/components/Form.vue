<template>
	<form @submit.prevent="showresultchild">
		<app-prog-bar :progressbar="this.progressbar"></app-prog-bar>
		<transition name="form" appear>
		<div>
				
				<app-input v-for="(value, name) in info" :key="name" :value="value" :name="name" v-on:handleInput="handleclasse"></app-input>
			
		</div>
		</transition>
		<app-butt :progressbar="this.progressbar"></app-butt>
	</form>
</template>

<script>
	import appProgBar from './ProgBar';
	import appInput from './Input';
	import appButt from './Butt';

	export default {
		props: ['progressbar', 'info'],
		methods: {
			handleclasse(val) {
				this.$emit('handleclasse', val);
			},
			showresultchild(e) {
				this.$emit('showresultchild', e);
			}
		},
		components: {
			appProgBar,
			appInput,
			appButt
		}
	}
</script>

<style>
	.form-enter {
		
	}

	.form-enter-active {
	   animation: kek 1s;
	}

	@keyframes kek {
		from { transform: scale(0.1); transform: translatey(-200px); }
		to { transform: scale(1); transform: translateY(0px);}
	}
</style>