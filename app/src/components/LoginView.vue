<template>
  <main class="form-signin w-100 m-auto">
    <form>
      <h1 class="h3 mb-4 fw-normal text-center">Please sign in</h1>

      <div class="form-floating mb-3 align-center">
        <label for="floatingInput">Email address</label>

        <input
          v-model="email"
          type="email"
          class="form-control"
          id="floatingInput"
          placeholder="name@example.com" />
      </div>

      <div class="form-floating mb-3 align-center">
        <label for="floatingPassword">Password</label>

        <input
          v-model="password"
          type="password"
          class="form-control"
          id="floatingPassword"
          placeholder="Password" />
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me" /> Remember me
        </label>
      </div>
      <button
        v-on:click.stop.prevent="login()"
        class="w-100 btn btn-lg btn-primary"
        type="submit">
        Sign in
      </button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </form>
  </main>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    login() {
      const payload = {
        email: this.email,
        password: this.password
      }
      this.axios.post('api/auth/login', payload).then((response) => {
        console.log(response)
      })
    }
  }
}
</script>
