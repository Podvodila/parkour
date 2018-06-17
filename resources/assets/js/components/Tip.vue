<template>
	<span class="custom-tip" ref="tip">{{msg}}</span>
</template>

<script>
	export default {
		props: ['msg'],
		data() {
			return {

			}
		},
		created() {
			document.querySelector("body").addEventListener('mousemove', this.changeCoordinates);
		},
		beforeDestroy() {
			document.querySelector("body").removeEventListener('mousemove', this.changeCoordinates);
		},
		methods: {
			changeCoordinates(e) {
				var coordY = document.documentElement.clientHeight - e.clientY > 30 ? 10 : -15;
				this.$refs.tip.style.top = e.clientY + coordY + 'px';
				this.$refs.tip.style.left = e.clientX - parseInt(getComputedStyle(this.$refs.tip).width) - 10 + 'px';
			},
		},
	}
</script>

<style>
	.custom-tip {
		position: fixed;
		color: #fff;
	    background: #5c626a;
	    padding: 0 9px;
	    border-radius: 2px;
        white-space: nowrap;
        font-family: 'Nunito';
        font-weight: normal;
        font-size: 10px;
        line-height: 19px;
        z-index: 2147483647;
	}
</style>