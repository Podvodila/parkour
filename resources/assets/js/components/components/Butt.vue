<template>
	<transition name="betton" appear>
		<button class="btn btn-primary" :disabled="progressbar != 100">
			Send Data
		</button>
	</transition>
</template>

<script>
	
	export default {
		props: ['progressbar'],
	}
</script>

<style>
	.betton-enter-active {
		animation: megacool 1s;
	}

	@keyframes megacool {
		from { transform: rotate(180deg); }
		to {transform: rotate(0deg);}
	}
</style>