<template>
  <div>
    <!-- <li class="list-group-item">
      {{ todo.id }}
      <input v-model="todo.label" type="text" @keyup.enter="updateTodo(todo)" />
      <button v-on:click="deleteTodo(todo)">del</button>
    </li> -->
    <div v-if="isShowing">
      {{ todo.label }} - {{ todo.state }}
      <button v-on:click.stop.prevent="changeStateToUpdating()">Edit</button>
      <button v-on:click.stop.prevent="changeStateToDeleting()">Delete</button>
    </div>

    <div v-if="isUpdating">
      Update <button v-on:click.stop.prevent="updateTodo(todo)">Edit</button>
      <button v-on:click.stop.prevent="changeStateToShow()">Cancel</button>
    </div>

    <div v-if="isDeleting">
      Delete
      <button v-on:click.stop.prevent="deleteTodo(todo)">Deleter</button>
      <button v-on:click.stop.prevent="changeStateToShow()">Cancel</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'TodoCard',
  data() {
    return {}
  },
  props: {
    todo: {
      type: Object,
      default: () => ({})
    }
  },
  methods: {
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
    },
    changeStateToShow() {
      this.todo.state = 'show'
    },
    changeStateToUpdating() {
      this.todo.state = 'update'
    },
    changeStateToDeleting() {
      this.todo.state = 'delete'
    }
  },
  computed: {
    isShowing() {
      return this.todo.state === 'show'
    },
    isUpdating() {
      return this.todo.state === 'update'
    },
    isDeleting() {
      return this.todo.state === 'delete'
    }
  }
}
</script>

<style scoped>



</style>
