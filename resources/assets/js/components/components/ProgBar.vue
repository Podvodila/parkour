<template>
	<div class="progress">
		<div class="progress-bar" :style="{width: progressbar + '%'}"></div>
	</div>
</template>

<script>
	
	export default {
		props: ['progressbar'],
	}
</script>