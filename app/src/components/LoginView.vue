<template>
  <main class="form-signin w-100 m-auto">
    <h1 class="h3 mb-4 fw-normal text-center">Please sign in</h1>

    <Form ref="loginValidate" v-on:submit="login()" :validation-schema="schema">
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
        <ErrorMessage name="email"></ErrorMessage>
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
        <ErrorMessage name="password"></ErrorMessage>
      </div>

      <div class="checkbox mb-3">
        <label>
          <Field name="remember-me" type="checkbox" value="remember-me" />
          Remember me
        </label>
      </div>
      <button type="submit" class="w-100 btn btn-lg btn-primary">Login</button>
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
      error: ''
    }
  },

  methods: {
    async login() {
      const validator = await this.$refs.loginValidate.validate()
      if (!validator) {
        return
      }
      //payload
      const payload = {
        email: this.email,
        password: this.password
      }

      try {
        axios
          .post('http://127.0.0.1:8000/api/auth/login', payload) //payload
          .then((response) => {
            console.log(response)
            const token = `${response.data.token_type}/${response.data.access_token}`
            Cookie.set('token_todo', token, { expires: 30 })
            this.$store.commit('STORE_USER', response.data.data)
          })
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>
