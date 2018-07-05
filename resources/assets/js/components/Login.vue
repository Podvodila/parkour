<template>
	<div class="login-container">

        <form id="login-form" class="login-form" method="POST" :action="route['login']" @submit.prevent="login">
			<input type="hidden" name="_token" :value="csrf">
            <div>
                <input id="login" type="text" class="form-control" name="login" :placeholder="local['login']" required autofocus>
                <Alert :msg="error" :error="true" v-if="error"></Alert>
            </div>

            <div>
                <input id="password" type="password" class="form-control" name="password" :placeholder="local['password']" required>
            </div>

            <div class="login-buttons">
                <label class="check-remember"><input type="checkbox" name="remember">{{ local['remember'] }}</label>
                <button type="submit" class="btn btn-primary">
                    {{ local['login'] }}
                </button>
            </div>
            
            <div>
                <a class="login-forgot" :href="route['forgot']"> 
                    {{ local['forgot pass'] }}
                </a>
            </div>
        </form>

        <div class="login-form register">
            <p class="login-reg">
                {{local['not registered yet']}}
                <a :href="route['register']">{{local['register']}}</a>
            </p>
        </div>
    
    </div>
</template>

<script>
    import Alert from './Alert.vue';

	export default {
		props: ['localization', 'routes'],
		data() {
			return {
				local: JSON.parse(this.localization),
				csrf: $('meta[name="csrf-token"]').attr('content'),
                error: '',
                route: JSON.parse(this.routes),
			}
		},
		methods: {
			login(data) {
				var form = new FormData(document.querySelector("#login-form"));
                var self = this;

				$.ajax({
    			  method: "POST",
                  type: "POST",
    			  headers: {
    			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			  },
    			  url: this.route['login'],
    			  data: {// change data to this object
    			     _token : $('meta[name="csrf-token"]').attr('content'), 
    			     login: form.get('login'),
    			     password: form.get('password'),
                     remember: form.get('remember')
    			  },
    			  success: function(resultData) { window.location.href = '/profile' },
                  error: function(data) {
                    console.log(data.responseJSON.errors.login[0]);
                    self.error = data.responseJSON.errors.login[0];
                    setTimeout(()=> {
                        self.error = '';
                    }, 5000);
                  }
				});
			},
		},
        components: {
            Alert,
        },
	}
</script>

<style>
    .login-container {
        max-width: 600px;
        margin: 10px auto;
        margin-top: 100px;
    }

    .login-form {
        background-color: #fff;
        border: 1px solid #e6e6e6;
        padding: 30px;
        display: flex;
        flex-direction: column;
        font-family: 'Nunito';
        margin-bottom: 20px;
    }

    .register {
        padding: 25px;
    }

    .login-form>div {
        margin-bottom: 10px;
    }

    .login-form>div:last-child {
        margin-bottom: 0px;
    }

    .login-reg {
        text-align: center;
    }

    .login-buttons {
        display: flex;
        justify-content: space-between;
    }

    .check-remember {
        display: flex;
        align-items: center;
        color: #777;
        font-size: 13px;
    }

    .login-forgot {
        font-size: 15px;
    }

    .login-alert {
        position: absolute;
        /*right: 42%;*/
        top: 10px;
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