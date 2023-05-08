import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import '@/plugins/vee-validate.js'
import AxiosPlugin from './plugins/axios'
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';

import './assets/main.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from './store'

const app = createApp(App).use(store)

app.use(router, ToastPlugin)

app.mount('#app')
