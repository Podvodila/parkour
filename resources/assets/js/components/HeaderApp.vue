<template>
	<nav class="main-nav-container">
    	<div class="main-nav">
			<h1 class="nav-logo">parkour</h1>
	    	<ul class="custom-navbar">
	    		<li><a class="nav-link" :href="routes.find">Find a spot</a></li>
	            <template v-if="!auth">
	                <li><a class="nav-link login" :href="routes.login">Login</a></li>
	            </template>
	            <template v-else>
	            	<li><a class="nav-link" :href="routes.profile">Profile</a></li>
	                <li>
                        <a class="nav-link logout" :href="routes.logout"
                           @click.prevent="logout">
                            Logout
                        </a>

                        <form id="logout-form" :action="routes.logout" method="POST" style="display: none;" ref="logout">
                            <input type="hidden" name="_token" :value="token">
                        </form>
	                </li>
	            </template>
	        </ul>
        </div>
    </nav>
</template>

<script>
	export default {
		props: ['auth', 'routes'],
		data() {
			return {
				token: $('meta[name="csrf-token"]').attr('content'),
			}
		},
		methods: {
			logout() {
				document.getElementById('logout-form').submit();
			}
		},
		created() {
			console.log(this.auth);
		}
	}
</script>

<style>
	.login,
	.logout {
		border-left: 1px solid rgba(0,0,0,.0975);
		border-right: 1px solid rgba(0,0,0,.0975);
		color: #5886af;
		transition: .2s;
		margin-left: 30px;
	}

	.login:hover,
	.logout:hover {
		background-color: #5886af;
		color: #fff;
		border-left: 1px solid #5886af;
		border-right: 1px solid #5886af;
	}
</style>