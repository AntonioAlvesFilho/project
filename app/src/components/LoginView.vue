<template>
  <main class="form-signin w-100 m-auto">
    <h1 class="h3 mb-4 fw-normal text-center">Please sign in</h1>

    <Form ref="loginValidate" v-on:submit="login()">
      <div class="form-floating mb-3 align-center">
        <label name="email" for="floatingInput">Email address</label>

        <Field
          name="email"
          v-model="email"
          type="email"
          rules="required|email"
          class="form-control"
          id="floatingInput"
          placeholder="name@example.com" />
        <ErrorMessage
          style="color: darkorange"
          v-if="!loading.running"
          name="email"></ErrorMessage>
      </div>

      <div class="form-floating mb-3 align-center">
        <label for="floatingPassword">Password</label>

        <Field
          name="password"
          v-model="password"
          type="password"
          rules="required|min:5"
          class="form-control"
          id="floatingPassword"
          placeholder="Password" />
        <ErrorMessage style="color: darkorange" name="password"></ErrorMessage>
      </div>

      <div class="checkbox mb-3">
        <label>
          <Field name="remember-me" type="checkbox" value="remember-me" />
          Remember me
        </label>
      </div>
      <div style="height: 64px" class="d-flex">
        <button
          :disabled="loading.running"
          type="submit"
          class="w-100 mb-4 w-100 h-100 btn btn-lg btn-primary">
          <p v-if="!loading.running">Login</p>
          <img
            v-else-if="loading.running"
            style="color: white"
            src="loading.png"
            alt="" />
        </button>
      </div>
      <div
        v-if="loginResponse.message"
        :class="`text-${loginResponse.color} rounded d-flex`">
        <h5>{{ loginResponse.message }}</h5>
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </Form>
  </main>
</template>

<script>
import axios from 'axios'
import Cookie from 'js-cookie'
import { Form, Field, ErrorMessage } from 'vee-validate'

export default {
  name: 'Login',
  components: { Form, Field, ErrorMessage },
  data() {
    return {
      email: '',
      password: '',
      loading: {
        running: false
      },
      loginResponse: {
        color: '',
        message: ''
      }
    }
  },

  methods: {
    login() {
      //replace the "login" with a loading img
      this.loading.running = true
      //delay setted for visualization
      setTimeout(() => {
        // First it verifies if the inputs are filled correctly
        try {
          const validator = this.$refs.loginValidate.validate()
          if (!validator) {
            return
          }
        } catch (error) {
          return console.log(error)
        }

        //then

        //payload = input.characters
        const payload = {
          email: this.email,
          password: this.password
        }

        //reset error message to see clearly if it refresh on login click
        this.resetErrorMessage()
        axios
          //posting payload to api and waiting for response
          .post('http://127.0.0.1:8000/api/auth/login', payload)
          .then((response) => {
            //getting JWT Token from api
            const token = `${response.data.token_type}/${response.data.access_token}`
            //setting js-Cookie to insert JWT Token as a cookie in browser
            Cookie.set('token_todo', token, { expires: 30 })
            // sending the api response, with the user data like name, id, genre ETC. to vuex to show on front end
            this.$store.commit('STORE_USER', response.data.data)
            //Stop img-loading show
            this.loading.running = false
          })
          .catch((error) => {
            const errorMessage =
              // A login authentication error is expected here, but if is not what is returned for some reason, like an axios url error, it returns a generic error (unexpected error) instead of crashing the aplication.
              error?.response?.data?.message || 'Unexpected Error'
            this.loginResponse.color = 'danger'
            this.loginResponse.message = errorMessage
            this.loading.running = false
            console.log('login mal sucedido')
          })
      }, 1500)
    },

    resetErrorMessage() {
      ;(this.loginResponse.color = ''), (this.loginResponse.message = '')
      return
    }
  }
}
</script>
