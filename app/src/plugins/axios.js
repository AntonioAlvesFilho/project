import axios from 'axios'
import Cookie from '../middlewares/token'

axios.defaults.baseURL = 'http://127.0.0.1:8000'
axios.defaults.headers.common['Content-Type'] = 'applicatio/json'
axios.defaults.headers.common.Accept = 'application/json'
axios.interceptors.request.use(
  function (config) {
    const token = Cookie.getToken()
    if (token) {
      config.headers.Authorization = token
    }
    return config
  },
  function (error) {
    console.log(error)
    return Promise.reject(error)
  }
) //interceptadores servem para executar um trecho de código antes do Then ou Catch do axios

axios.interceptors.response.use(
  function (response) {
    console.log('sucesso')

    return response
  },
  function (error) {
    console.log('error')
    return Promise.reject(error)
  }
)

export default axios
