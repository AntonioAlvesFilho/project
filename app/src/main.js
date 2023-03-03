import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import '@/plugins/axios.js'
import '@/plugins/vee-validate.js'

import './assets/main.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

const app = createApp(App)

app.use(router)

app.mount('#app')
