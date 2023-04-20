import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../layouts/home-view.vue'
import ProfileView from '../components/profile.vue'
import LoginView from '../components/login.vue'
import RegisterView from '../components/register.vue'
import ForgotPasswordView from '../components/forgot-password.vue'
import ResetPasswordView from '../components/reset-password.vue'
import ContentView from '../components/content-dummy.vue'
import Guard from '../middlewares/middleware'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',

      children: [{ path: '', name: 'home', component: HomeView }]
    },
    {
      path: '/login', //colocar Authcomponent aqui
      beforeEnter: Guard.redirectIfAuthenticated,
      children: [{ path: '', name: 'login', component: LoginView }]
    },
    {
      path: '/register', //colocar Authcomponent aqui
      children: [{ path: '', name: 'register', component: RegisterView }]
    },
    {
      path: '/forgot-password',
      children: [
        { path: '', name: 'forgot-password', component: ForgotPasswordView }
      ]
    },
    {
      path: '/reset-password',
      children: [
        { path: '', name: 'reset-password', component: ResetPasswordView }
      ]
    },
    {
      path: '/content-dummy', //colocar Authcomponent aqui
      beforeEnter: Guard.redirectIfNotAuthenticated,
      children: [{ path: '', name: 'content-dummy', component: ContentView }]
    },
    {
      path: '/profile', //colocar Authcomponent aqui
      beforeEnter: Guard.redirectIfNotAuthenticated,
      children: [{ path: '', name: 'profile', component: ProfileView }]
    }
  ]
})

export default router
