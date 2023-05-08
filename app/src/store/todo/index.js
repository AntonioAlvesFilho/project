export default {
  nameSpaced: true,
  state: () => ({
    todo: {}
  }),
  mutations: {
    STORE_TODO(state, todo) {
      state.todo = todo
    }
  }
}
