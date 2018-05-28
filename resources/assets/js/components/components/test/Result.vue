<template>
	<table class="table table-bordered">
		<tbody>
			<tr v-for="(answer, index) in answers">
				<td>{{questions[index].title}}</td>
				<td><span v-for="singleAnswer in answer">{{singleAnswer}} </span><br></td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	import {mapGetters} from 'vuex'

	export default {
		computed: {
			...mapGetters([
				'answers',
				'questions',
			]),
		}
	}
</script>