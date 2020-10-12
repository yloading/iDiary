<template>
    <div>
        <div class="login">
            <h1 class="title">iDiary</h1>
            <b-form-group id="input-group-2">
                <b-form-input
                id="input-2"
                v-model="data.username"
                required
                placeholder="Username"
                ></b-form-input>
            </b-form-group>

            <b-form-group
                id="input-group-1"
                label-for="input-1"
            >
                <b-form-input
                id="input-1"
                v-model="data.password"
                type="password"
                required
                placeholder="Password"
                ></b-form-input>
            </b-form-group>

                <!-- <b-form-checkbox class="mb-2 mr-sm-2 mb-sm-0">Remember me</b-form-checkbox> -->

                <b-button block :pressed="true" variant="light" @click="login" :disabled="isLoggingIn" :loading="isLoggingIn">{{isLoggingIn ? 'Logging In...' : 'Login'}}</b-button>


                <p class="sign-login">Don't have an account? Sign up <router-link to='sign-up' class="link">here</router-link></p>

        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            data : {
                username : '',
                password : ''
            },
            isLoggingIn : false
        }
    },

    methods : {
         async login() {
            if(this.data.username.trim() == '' && this.data.password.trim() == '') return this.error('Please provide your credentials.')
            if(this.data.username.trim() == '') return this.error('Please enter your username.')
            if(this.data.password.trim() == '') return this.error('Please enter your password.')
            
            const res = await this.callApi('post', '/idiary/login', this.data)

            if (res.status == 200) {
                this.isLoggingIn = true
                window.location = '/'
            }
            else {
                if (res.status == 422) {
                    for(let i in res.data.errors) {
                        this.error(res.data.errors[i][0])
                    }
                }
                else if (res.status == 401) {
                    this.error(res.data.msg)
                }

            }
        }
    }
}
</script>