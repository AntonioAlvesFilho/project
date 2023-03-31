<template>
  <main class="form-signin w-100 m-auto">
    <h1 class="h3 mb-4 fw-normal text-center">Reset Password</h1>

    <Form ref="resetValidate" v-on:submit="reset()">
      <div class="form-floating mb-3 align-center">
        <label for="floatingPassword">New Password</label>
        <Field
          name="password"
          rules="required|min:5"
          v-model="password"
          type="password"
          class="form-control"
          id="floatingPassword"
          placeholder="Password" />
        <ErrorMessage class="errorText" name="password"></ErrorMessage>
      </div>

      <div class="form-floating mb-5 align-center">
        <label for="floatingConfirmPassword">Confirm New Password</label>
        <Field
          name="confirmation"
          rules="confirmed:@password|required"
          v-model="passwordConfirmation"
          type="password"
          class="form-control"
          id="Password"
          placeholder="Confirm Password" />
        <ErrorMessage class="errorText" name="confirmation"></ErrorMessage>
      </div>

      <div style="height: 64px" class="d-flex">
        <button
          :disabled="loading.running"
          type="submit"
          class="w-100 mb-4 w-100 h-100 btn btn-lg btn-primary">
          <p v-if="!loading.running">Reset Password</p>
          <img
            v-else-if="loading.running"
            style="color: white"
            src="loading.png"
            alt="" />
        </button>
      </div>

      <div
        v-if="resetResponse.message"
        :class="`text-${resetResponse.color} rounded d-flex`">
        <h5>{{ resetResponse.message }}</h5>
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </Form>
  </main>
</template>

<script>
import axios from 'axios'
import { Form, Field, ErrorMessage } from 'vee-validate'

export default {
  name: 'Login',
  components: { Form, Field, ErrorMessage },
  data() {
    return {
      email: '',
      password: '',
      passwordConfirmation: '',
      token: '',
      loading: {
        running: false
      },
      resetResponse: {
        color: '',
        message: ''
      }
    }
  },

  beforeRouteEnter(to, from, next) {
    if (!to?.query?.token || !to?.query?.email) {
      next({ name: 'login' })
    }
    next()
  },

  created() {
    this.token = this.$route?.query?.token || ''
    this.email = this.$route?.query?.email || ''
  },

  methods: {
    async reset() {
      const validator = await this.$refs.resetValidate.validate()
      // First it verifies if the inputs are filled correctly
      if (!validator) {
        return
      }

      this.resetErrorMessage()
      //replace the "login" with a loading img
      this.loading.running = true
      //delay setted for visualization
      setTimeout(() => {
        //payload = input.characters
        const payload = {
          email: this.email,
          password: this.password,
          token: this.token
        }

        //reset error message to see clearly if it refresh on login click

        axios
          //posting payload to api and waiting for response
          .post('http://127.0.0.1:8000/api/auth/reset-password', payload)
          .then((response) => {
            this.loading.running = false
            console.log(response.statusText)
          })
          .catch((error) => {
            // A login authentication error is expected here, but if is not what is returned for some reason, like an axios url error, it returns a generic error (unexpected error) instead of crashing the aplication.
            const errorMessage =
              error?.response?.data?.message || 'Unexpected Error'
            this.resetResponse.color = 'danger'
            this.resetResponse.message = errorMessage
            this.loading.running = false
            console.log(errorMessage)
            console.log(error.statusText)
          })
      }, 1500)
    },

    resetErrorMessage() {
      return (this.resetResponse.message = '')
    }
  }
}
</script>
