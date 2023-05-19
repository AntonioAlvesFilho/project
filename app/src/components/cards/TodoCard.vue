<template>
  <div>
    <div v-if="isShowing">
      {{ todo.label }} - {{ todo.state }}
      <button v-on:click.stop.prevent="changeStateToUpdating()">Edit</button>
      <button v-on:click.stop.prevent="changeStateToDeleting()">Delete</button>
    </div>

    <div v-if="isUpdating">
      <input v-model="todo.label" />
      <button v-on:click.stop.prevent="updateTodo(todo)">Edit</button>
      <button v-on:click.stop.prevent="changeStateToShow()">Cancel</button>
    </div>

    <div v-if="isDeleting">
      You really want to delete this task?
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
          this.loading.ico = true
        })
        .catch((response) => {
          console.log(response)
        })
      this.changeStateToShow()
    },
    deleteTodo(todo) {
      axios
        .delete(`api/auth/todos/${todo.id}`)
        .then((response) => {
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

<style scoped></style>
