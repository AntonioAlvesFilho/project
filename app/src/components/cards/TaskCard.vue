<template>
  <div>{{ task.label }} {{ task.todo_id }}</div>
</template>

<script>
export default {
  props: {
    task: {
      type: Object,
      default: () => ({})
    }
  }
}
</script>

<style lang="scss" scoped></style>
