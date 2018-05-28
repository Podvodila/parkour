<template>
	<div class="form-group">
        <label>{{value.name}}</label>
        <transition name="alert">
		    <i v-if="value.correct" class="fa fa-exclamation-triangle" style="color: green;" key="correct"></i>
		    <i v-if="value.correct === false" class="fa fa-times-circle" style="color: red;" key="incorrect"></i>
		</transition>
        <input type="text" class="form-control" v-on:input="handleInput(value)" v-model="value.value">
    </div>
</template>

<script>
	
	export default {
		props: ['value', 'name'],
			methods: {
				handleInput(val) {
					this.$emit('handleInput', val);
				},
			}
	}
</script>

<style>
	.alert-enter-active {
		animation: alert .5s;
	}

	@keyframes alert {
		from { transform: translateX(100px); }
		to { transform: translateX(0px); }
	}
</style>