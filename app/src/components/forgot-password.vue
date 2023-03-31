<template>
  <main class="form-signin w-100 m-auto">
    <Form v-on:submit="sendEmail()">
      <h1 class="h3 mb-4 fw-normal text-center">Forgot Password?</h1>

      <div class="form-floating mb-3 align-center">
        <label for="floatingEmail">Email address</label>
        <Field
          name="email"
          rules="required|email"
          v-model="email"
          type="email"
          class="form-control"
          id="floatingEmail"
          placeholder="name@example.com" />
        <ErrorMessage class="errorText" name="email"></ErrorMessage>
        <div
          v-if="responseMessage.message"
          :class="`text-${responseMessage.color} rounded d-flex`">
          <h5>{{ responseMessage.message }}</h5>
        </div>
      </div>

      <button
        :disabled="loading.running"
        type="submit"
        class="w-100 mb-4 w-100 h-100 btn btn-lg btn-primary">
        <p v-if="!loading.running">Send</p>
        <img
          v-else-if="loading.running"
          style="color: white"
          src="loading.png"
          alt="" />
      </button>



      <p class="mt-5 mb-3 text-muted">&copy; 2017-2022</p>
    </Form>
  </main>
</template>

<script>
import axios from 'axios'
import { Field, Form, ErrorMessage } from 'vee-validate'
export default {
  name: 'forgot-password',
  components: { Field, Form, ErrorMessage },
  data() {
    return {
      email: '',
      responseMessage: {
        color: '',
        message: ''
      },
      loading: {
        running: false
      }
    }
  },
  methods: {
    sendEmail() {
      this.loading.running = true
      this.resetResponseMessage()

      setTimeout(() => {
        const payload = { email: this.email }

        axios
          .post('http://127.0.0.1:8000/api/auth/forgot-password', payload)
          .then(
            (this.responseMessage.message =
              'Link para recuperação de Email enviado'),
            (this.responseMessage.color = 'success')
          )
          .catch((error) => {
            console.log(error)
            this.responseMessage.message = error.response.data.message
            this.responseMessage.color = 'danger'
          })
          .finally((this.loading.running = false))
      }, 1500)

      return ''
    },
    resetResponseMessage() {
      ;(this.responseMessage.message = ''), (this.responseMessage.color = '')
    }
  }
}
</script>
