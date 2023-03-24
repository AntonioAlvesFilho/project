import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../components/LoginView.vue'
import RegisterView from '../components/RegisterView.vue'
import ForgotPasswordView from '../components/ForgotPasswordView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login', //colocar Authcomponent aqui
      children: [{ path: '', name: 'login', component: LoginView }]
    },
    {
      path: '/register', //colocar Authcomponent aqui
      children: [{ path: '', name: 'register', component: RegisterView }]
    },
    {
      path: '/forgot-password', //colocar Authcomponent aqui
      children: [
        { path: '', name: 'forgot-password', component: ForgotPasswordView }
      ]
    }
  ]
})

export default router
