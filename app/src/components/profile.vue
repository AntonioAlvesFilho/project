<template>
  <div>
    <h1>Profile</h1>
    <p>Name: {{ name }}</p>
    <p>Email: {{ email }}</p>
    <p>Age: {{ age }}</p>
    <p>Gender: {{ gender }}</p>
    <p>Registered at: {{ since }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      age: '',
      gender: '',
      since: ''
    }
  },
  created() {
    const user = this.$store.state.user.user

    this.name = user.name
    this.email = user.email
    this.age = user.data_nascimento
    this.gender = user.genero
    this.since = user.created_at
  }
}
</script>
