import Cookie from './token'
import axios from 'axios'
import store from '../store'
import { useToast } from 'vue-toast-notification'
const $toast = useToast()

export default {
  redirectIfAuthenticated(to, from, next) {
    const token = Cookie.getToken('token_todo')
    let n

    if (token) {
      n = { name: 'home' }
      $toast.info('Already Logged In', {
        position: 'top-right'
      })
    }

    next(n)
  },
  async redirectIfNotAuthenticated(to, from, next) {
    const token = Cookie.getToken('token_todo')
    let n

    if (token) {
      await axios
        .get('/api/auth/index')
        .then((response) => {
          if (!store?.state?.user?.id) {
            store.commit('STORE_USER', response.data.data)
          }
        })
        .catch(() => {
          Cookie.removeToken()
          console.log('teste')
          n = { name: 'login' }
        })
    } else {
      n = { name: 'login' }
      $toast.info('Login First', {
        position: 'top-right'
      })
    }

    next(n)
  }
}
