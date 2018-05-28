<template>
	<div>
		<table class="table table-bordered">
			<tbody>
			<tr v-for="(value) in info">
				<td>{{value.name}}</td>
				<td>{{value.value}}</td>
			</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		props: ['info'],
	}
</script>