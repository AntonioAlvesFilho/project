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

      <div class="g-3">
        <label class="" for="date">Date of Birth</label>
        <div class="d-flex mb-3">
          <Field
            name="day"
            rules="required|length:2|max_value:31|min_value:1"
            v-model="day"
            class="form-control col-md-1 text-center"
            type="number"
            id="day" />
          /
          <Field
            name="mouth"
            rules="required|length:2|max_value:12|min_value:1"
            v-model="mouth"
            class="form-control col-md-1 text-center"
            type="number"
            id="mouth" />
          /
          <Field
            name="year"
            rules="required|length:4|max_value:2005|min_value:1910"
            v-model="year"
            class="form-control col-md-1 text-center"
            type="number"
            id="year" />

          <ErrorMessage class="errorText" name="day"></ErrorMessage>
          <ErrorMessage class="errorText" name="mouth"></ErrorMessage>
          <ErrorMessage class="errorText" name="year"></ErrorMessage>
        </div>
      </div>

      <div class="column is-6">
        <p>Gender</p>

        <p class="control">
          <label class="radio m-1">
            <Field
              name="gender"
              v-model="genero"
              rules="required"
              value="male"
              type="radio" />
            Male
          </label>

          <label class="radio m-1">
            <Field name="gender" value="female" type="radio" />
            Female
          </label>
          <label class="radio m-1">
            <Field name="gender" value="other" type="radio" disabled />
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
      year: '',
      mouth: '',
      day: '',
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
      this.loading.running = true
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
          data_nascimento: this.year + '-' + this.mouth + '-' + this.day,
          genero: this.genero,
          password: this.password
        }

        axios
          .post('http://127.0.0.1:8000/api/auth/register', payload)
          .then((response) => {
            console.log(response.statusText)
          })
          .catch((error) => {
            console.log(error)
          })
          .finally((this.loading.running = false))
      }, 1500)
    }
  }
}
</script>

<style>
.errorText {
  color: red;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  /* display: none; <- Crashes Chrome on hover */
  -webkit-appearance: none;
  margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type='number'] {
  -moz-appearance: textfield; /* Firefox */
}
</style>
