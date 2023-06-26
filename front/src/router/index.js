import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/catalog',
    name: 'catalog',
    component: () => import( '../views/catalogView.vue')
  },
  {
    path: '/catering',
    name: 'catering',
    component: () => import( '../views/catalogView.vue')  },
  {
    path: '/cart',
    name: 'cart',
    component: () => import( '../views/catalogView.vue')  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
