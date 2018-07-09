<template>
	<div class="register-container">
		<transition name="alert">
            <div class="custom-alert-container" v-if="error">
                <Alert :msg="error" :error="true"></Alert>
            </div>
        </transition>
		<form id="register-form" class="register-form" method="POST" :action="route['register']" @submit.prevent="register">
			<input type="hidden" name="_token" :value="csrf">
			<div v-for="(value, key) in fields" :key="key" class="input-container">
				<input :type="value.type" class="form-control register-input" :placeholder="local[value.placeholder]" :name="value.name" v-model="value.value" 
				v-on:input="check_correct(value); is_pass_conf(value) ? check_pass_conf(value): '';"
				required>
				<transition name="alert">
					<svg v-if="value.correct" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="alert-svg fill-green"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"/></svg>
					
				    <svg v-if="value.correct === false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="alert-svg fill-red"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"/></svg>
				</transition>
			</div>
			<div class="register-btn-container progress">
				<button type="submit"  class="btn register-btn" :disabled="progressbar != 100" :style="{color: progressbar > 45 ? '#fff' : ''}">{{local['register']}}</button>
				<div class="progress-bar custom-progress-bar" :style="{width: progressbar + '%'}"></div>
			</div>
		</form>
	</div>
</template>

<script>
	import Alert from './Alert.vue';
	
	export default {
		props: ['routes', 'src_local'],
		data() {
			return {
				route: JSON.parse(this.routes),
				csrf: $('meta[name="csrf-token"]').attr('content'),
				error: '',
				fields: [
					{
						name: 'first_name',
						placeholder: 'first name',
						value: '',
						pattern: /^[a-zA-Zа-яА-я]{2,20}$/,
						type: 'text',
					},
					{
						name: 'last_name',
						placeholder: 'last name',
						value: '',
						pattern: /^[a-zA-Zа-яА-я]{2,20}$/,
						type: 'text',
					},
					{
						name: 'email',
						placeholder: 'email',
						value: '',
						pattern: /.+@.+\..+/i,
						type: 'text',
					},
					{
						name: 'password',
						placeholder: 'password',
						value: '',
						pattern: /[0-9a-zA-Z!@#$%^&*]{6,}/,
						type: 'password',
					},
					{
						name: 'password_confirmation',
						placeholder: 'confirm password',
						value: '',
						pattern: /[0-9a-zA-Z!@#$%^&*]{6,}/,
						type: 'password',
					},
				],
				local: this.src_local,
			}
		},
		computed: {
			progressbar(){
		      var piece = 100/this.fields.length;
		      var counter = 0;
		      for(var i = 0; i < this.fields.length; i++) {
		        if(this.fields[i].correct) {
		          counter++;
		        }
		      }
		      return piece * counter;
		    },
		},
		mounted() {
			eventBus.$on('changeLocale', (data) => {
				this.local = data;
			});
		},
		methods: {
			register() {
				var form = new FormData(document.querySelector("#register-form"));
                var self = this;
				$.ajax({
    			  method: "POST",
                  type: "POST",
    			  headers: {
    			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			  },
    			  url: this.route['register'],
    			  data: {// change data to this object
    			     _token : $('meta[name="csrf-token"]').attr('content'),
    			     first_name: form.get('first_name'),
    			     last_name: form.get('last_name'), 
    			     email: form.get('email'),
    			     password: form.get('password'),
                     password_confirmation: form.get('password_confirmation'),
    			  },
    			  success: function(resultData) { window.location.href = '/' },
                  error: function(data) {
                    console.log('error');
                    self.error = data.responseJSON.errors.email[0];
                    setTimeout(()=> {
                        self.error = '';
                    }, 5000);
                  }
				});
			},
			check_correct(val){
		      var check = val.pattern.test(val.value);
		      if(val.correct === undefined) {
		        this.$set(val, 'correct', false);
		      }
		      val.correct = check
		      if(val.same == false) val.correct = false;
		    },
		    is_pass_conf(val) {
		    	if(val.name == 'password_confirmation' || val.name == 'password') return true;
		    	return false;
		    },
		    check_pass_conf(val) {
		    	var currentField;
		    	var confirmationField;
		    	if(val.name == 'password_confirmation') {
		    		confirmationField = val;
					currentField = this.fields.filter(oh => oh.name == 'password')[0];
				}
				else {
					currentField = this.fields.filter(oh => oh.name == 'password_confirmation')[0];
					confirmationField = currentField;
				}
				if(currentField.value == val.value) {
					if(confirmationField.correct !== undefined) {
						confirmationField.correct = true;
					}
				}
				else {
					if(confirmationField.correct !== undefined) {
						confirmationField.correct = false;
					}
				}
		    },
		},
		components: {
            Alert,
        },
	}
</script>

<style>
	.register-container {
        max-width: 600px;
        margin: 10px auto;
        margin-top: 100px;
    }

    .register-form {
        background-color: #fff;
        border: 1px solid #e6e6e6;
        padding: 30px;
        display: flex;
        flex-direction: column;
        font-family: 'Nunito', 'Arial';
        margin-bottom: 20px;
    }

    .register-form>div {
        margin-bottom: 10px;
    }

    .register-form>div:last-child {
        margin-bottom: 0px;
    }

    .register-btn-container {
    	position: relative;
    	height: 34px;
    }

    .register-btn {
    	position: absolute;
    	background-color: transparent;
    	z-index: 100;
    	width: 100%;
    	cursor: pointer;
    }

    .input-container {
    	display: flex;
    	align-items: center;
    }

    .alert-svg {
    	height: 17px;
    	margin-left: 10px;
    }

    .fill-red {
    	fill: #c00;
    }

    .fill-green {
    	fill: green;
    }

    .custom-alert-container {
        position: fixed;
        top: 70px;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        transition: .2s;
    }

    .custom-alert-container .alert {
        transition: .2s;
    }

    .alert-enter, .alert-leave-to {
      opacity: 0;
      transform: translateY(30px);
    }
    .alert-leave-active {
      position: fixed;
    }

    .custom-progress-bar {
    	height: 100%;
    	transition: .4s;
    }
</style>