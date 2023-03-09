export default {
  nameSpaced: true,
  state: () => ({
    user: {}
  }),
  mutations: {
    STORE_USER(state, user) {
      state.user = user
    }
  }
}
