<template>
  <div class="sign-up">
          <h1 class="title">iDiary</h1>
        <b-form v-if="show">
        
        <b-form-group
            id="input-group-1"
            label="Email address:"
            label-for="input-1"
            description="We'll never share your email with anyone else."
        >
            <b-form-input
            id="input-1"
            v-model="userInfo.email"
            type="email"
            required
            placeholder="Enter email"
            ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-2">
            <b-form-input
            id="input-2"
            v-model="userInfo.name"
            required
            placeholder="Full Name"
            ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-2">
            <b-form-input
            id="input-2"
            v-model="userInfo.username"
            required
            placeholder="Username"
            ></b-form-input>
        </b-form-group>

        <b-form-group
            id="input-group-1"
            label-for="input-1"
            description="Your password must be 8-20 characters long, contain letters and numbers, and must not
        contain spaces, special characters, or emoji."
        >
            <b-form-input
            id="input-1"
            v-model="userInfo.password"
            type="password"
            required
            placeholder="Password"
            ></b-form-input>
        </b-form-group>


        <b-button block variant="primary" @click="addUser" :disabled="isDisabled">Sign Up</b-button>

        <p class="sign-login">Already had an account? <router-link to="login" class="link"> Login </router-link></p>
        </b-form>

  </div>
</template>

<script>
  export default {
    data() {
      return {
        userInfo: {
          email: '',
          name: '',
          username: '',
          password: ''
        },
        show: true
      }
    },
    methods: {

      async addUser() {
            if(this.userInfo.name.trim() == '' || 
                this.userInfo.username.trim() == '' || 
                this.userInfo.email.trim() == '' ||
                this.userInfo.password.trim() == '') return this.error('Please fill in the form completely to complete the sign up process.')

            const res = await this.callApi('post','/add-user', this.userInfo)

            if(res.status == 201)  {
                this.$router.push('login')
                this.success('Sign up completed! Redirecting to login page..')
            }
            else {
                this.swr()
            }
        }
    },

    computed: {
        isDisabled() {
          if(this.userInfo.name.trim() == '' || 
             this.userInfo.username.trim() == '' || 
             this.userInfo.email.trim() == '' ||
             this.userInfo.password.trim() == '') {
                 return true
             }
             else {
                 return false
             }
        }
    }    
  }
</script>