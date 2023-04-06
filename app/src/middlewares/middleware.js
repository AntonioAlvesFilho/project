import Cookie from 'js-cookie'
import axios from 'axios'

export default {
  redirectIfAuthenticated(to, from, next) {
    const token = Cookie.get('token_todo')
    let n

    if (token) {
      n = { name: 'home' }
    }

    next(n)
  },
  redirectIfNotAuthenticated(to, from, next) {
    const token = Cookie.get('token_todo')
    let n

    if (!token) {
      n = { name: 'login' }
    }

    axios.get('http://localhost:8000/api/auth/me')

    next(n)
  }
}
