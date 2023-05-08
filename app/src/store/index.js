import { createStore } from 'vuex'
import user from './user'
import todo from './todo'

export default createStore({
  state: {},
  getters: {},
  mutations: {},
  actions: {},
  modules: {
    user,
    todo
  }
})
