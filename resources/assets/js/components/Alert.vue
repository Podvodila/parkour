<template>
        <div class="alert custom-alert" role="alert" ref="message" :class="this.error ? 'alert-danger' : 'alert-success'">  
            {{ message }}
        </div>
</template>

<script>
	export default {
		props: ['msg', 'error'],
		data() {
			return {
				message: this.msg,
			}
		},
		created() {
			setTimeout(()=> {
                this.$refs.message.parentNode.style.left = (document.documentElement.clientWidth - this.$refs.message.getBoundingClientRect().width)/2 + 'px';
            }, 0);
		},
	}
</script>

<style>
	.custom-alert {
        z-index: 200;
        display: inline-block;
        transition: all 1s;
        white-space: nowrap;
	}

	.alert-enter-active {
        animation: alertUp .5s;
    }

    .alert-leave-active {
        animation: alertAway .5s;
    }

    @keyframes alertUp {
        from {opacity: 0}
        to {opacity: 1}
    }

    @keyframes alertAway {
        from {opacity: 1}
        to {opacity: 0}
    }
</style>