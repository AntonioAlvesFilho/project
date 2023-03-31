import Cookie from 'js-cookie'

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
    next(n)
  }
}
