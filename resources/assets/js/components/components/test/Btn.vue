<template>
	<button class="btn btn-success" :disabled="!canNext" @click="nextQuestion">Далее</button>
</template>

<script>
	import {mapGetters, mapMutations} from 'vuex'

	export default {
		computed: {
			...mapGetters([
				'canNext'
			]),
		},
		methods: {
			...mapMutations([
				'nextQuestion'
			]),
		}
	}
</script>