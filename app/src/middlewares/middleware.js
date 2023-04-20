import Cookie from './token'
import axios from 'axios'
import store from '../store'

export default {
  redirectIfAuthenticated(to, from, next) {
    const token = Cookie.getToken('token_todo')
    let n

    if (token) {
      n = { name: 'home' }
    }

    next(n)
  },
  async redirectIfNotAuthenticated(to, from, next) {
    const token = Cookie.getToken('token_todo')
    let n

    if (token) {
      await axios
        .get('/api/auth/idx')
        .then((response) => {
          if (!store?.state?.user?.id) {
            store.commit('STORE_USER', response.data.data)
          }
        })
        .catch(() => {
          Cookie.removeToken()
          n = { name: 'login' }
        })
    } else {
      n = { name: 'login' }
    }

    next(n)
  }
}
