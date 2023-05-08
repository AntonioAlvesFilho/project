<template>
  <div class="d-flex">
    <div>
      <ul>
        <h2 class="text-center">Profile</h2>
        <li class="list-group-item">Name: {{ name }}</li>
        <li class="list-group-item">Email: {{ email }}</li>
        <li class="list-group-item">Age: {{ age }}</li>
        <li class="list-group-item">Gender: {{ gender }}</li>
        <li class="list-group-item">Registered at: {{ since }}</li>
      </ul>
    </div>

    <div>
      <ul class="list-group">
        <h2 class="text-center">Lista</h2>
        <div v-for="todo in this.todos" :key="todo.id">
          <li class="list-group-item">
            {{ todo.id }}
            <input
              v-model="todo.label"
              type="text"
              @keyup.enter="updateTodo(todo)" />
            <button v-on:click="deleteTodo(todo)">del</button>
          </li>
        </div>
      </ul>
      <div class="text-center" v-if="loading.ico">
        <img src="../assets/circle.gif" alt="" />
      </div>
      <Form class="text-center" ref="loginValidate" v-on:submit="addTodo()">
        Adicionar Nova Tarefa
        <Field
          name="todo"
          v-model="todo"
          type="string"
          rules="required"
          class="form-control"
          id="todo"
          placeholder="detalhe a tarefa" />
        <button type="submit">Adicionar nova tarefa</button>
      </Form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { Form, Field } from 'vee-validate'

export default {
  data() {
    return {
      todos: [],
      name: '',
      email: '',
      age: '',
      gender: '',
      since: '',
      loading: {
        ico: true
      },
      todo: ''
    }
  },
  created() {
    const user = this.$store.state.user.user
    this.name = user.name
    this.email = user.email
    this.age = user.data_nascimento
    this.gender = user.genero
    this.since = user.created_at
    this.getTodos()
  },
  methods: {
    getTodos() {
      setTimeout(() => {
        axios
          .get('/api/auth/todos')
          .then((response) => {
            this.todos = response.data.data
            console.log(response)
            this.loading.ico = false
          })
          .catch((response) => {
            console.log(response)
          })
      }, 2000)
    },
    addTodo() {
      this.label = {
        label: this.todo
      }
      axios
        .post('api/auth/todos', this.label)
        .then((response) => {
          console.log(response)
          this.getTodos()
          this.loading.ico = true
        })
        .catch((response) => {
          console.log(response)
        })
    },
    updateTodo(todo) {
      const payLoad = {
        label: todo.label
      }
      axios
        .put(`api/auth/todos/${todo.id}`, payLoad)
        .then((response) => {
          console.log(response)
          this.getTodos()
          this.loading.ico = true
        })
        .catch((response) => {
          console.log(response)
        })
    },
    deleteTodo(todo) {
      axios
        .delete(`api/auth/todos/${todo.id}`)
        .then((response) => {
          console.log(response)
          this.getTodos()
          this.loading.ico = true
        })
        .catch((response) => {
          console.log(response)
        })
    }
  },
  components: { Form, Field }
}
</script>
