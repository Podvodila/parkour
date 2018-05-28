<template>
	<div>
		<h2>{{ title }}</h2>
		<div v-for="value in answers">
			<label>
				<input :type="type" :value="value" name="answer" v-model="checked" @change="setAnswer(checked)">
				<span>{{ value }}</span>
			</label>
			<br>
		</div>
	</div>
</template>

<script>
	import {mapMutations} from 'vuex'

	export default {
		props: ['payload'],
		data() {
			return {
				title: this.payload.title,
				type: this.payload.type,
				answers: this.payload.answers,
				checked: []
			}
		},
		methods: {
			...mapMutations([
				'setAnswer'
			]),
		}
	}
</script>