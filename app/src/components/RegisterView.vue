<template>
  <main class="form-signin w-100 m-auto">
    <Form ref="registerForm" v-on:submit="register()">
      <h1 class="h3 mb-4 fw-normal text-center">Sign Up!</h1>

      <div class="form-floating mb-3 align-center">
        <label for="name">Name</label>
        <Field
          name="name"
          rules="required|alpha_spaces"
          v-model="name"
          type="text"
          class="form-control"
          id="floatingName"
          placeholder="Horacio" />
        <ErrorMessage class="errorText" name="name"></ErrorMessage>
      </div>

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
      </div>

      <div class="form-floating">
        <label class="" for="date">Date of Birth</label>
        <div class="form-floating mb-3">
          <Field
            max="01-01-1910"
            name="date"
            rules="required|max:10"
            v-model="date"
            class="form-control"
            type="date"
            id="date" />
          <br />
          <ErrorMessage class="errorText" name="date"></ErrorMessage>
        </div>
      </div>

      <div class="column is-6">
        <p>Gender</p>

        <p class="control">
          <label class="radio m-1">
            <Field name="gender" rules="required" value="1" type="radio" />
            Male
          </label>

          <label class="radio m-1">
            <Field name="gender" value="2" type="radio" />
            Female
          </label>
          <label class="radio m-1">
            <Field name="gender" value="3" type="radio" disabled />
            Other
          </label>
          <br />
          <ErrorMessage class="errorText" name="gender"></ErrorMessage>
        </p>
      </div>

      <div class="form-floating mb-3 align-center">
        <label for="floatingPassword">Password</label>
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
        <label for="floatingConfirmPassword">Confirm Password</label>
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

      <button
        :disabled="loading.running"
        type="submit"
        class="w-100 mb-4 w-100 h-100 btn btn-lg btn-primary">
        <p v-if="!loading.running">Sign Up</p>
        <img
          v-else-if="loading.running"
          style="color: white"
          src="loading.png"
          alt="" />
      </button>

      <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </Form>
  </main>
</template>

<script>
import axios from 'axios'
import { Form, Field, ErrorMessage } from 'vee-validate'

export default {
  components: { Form, Field, ErrorMessage },
  data() {
    return {
      name: '',
      email: '',
      date: '',
      genero: '',
      password: '',
      passwordConfirmation: '',
      loading: {
        running: false
      }
    }
  },

  methods: {
    register() {
      this.loading.running = 1
      setTimeout(() => {
        try {
          const validator = this.$refs.registerForm.validate()

          if (!validator) {
            return
          }
        } catch (error) {
          console.log(error)
        }

        const payload = {
          name: this.name,
          email: this.email,
          data_nascimento: this.date,
          genero: this.genero,
          password: this.password
        }

        axios
          .post('http://127.0.0.1:8000/api/auth/register', payload)
          .then(() => {})
          .catch(() => {})
      }, 1500)
      this.loading.running = false
    }
  }
}
</script>

<style>
.errorText {
  color: red;
}
</style>
