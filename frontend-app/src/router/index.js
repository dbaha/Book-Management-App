import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'

import table from '../components/TableData.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/HomeView.vue')
    },
    {
      path:'/login',
      name: 'login',
      component: LoginView
    },
    {
      path:'/author',
      name: 'AuthorIndex',
      component: () => import('../views/authors/AuthorIndex.vue')
    },
    {
      path:'/author/create',
      name: 'AuthorCreate',
      component: () => import('../views/authors/AuthorCreate.vue')
    },
    {
      path:'/author/:id/edit',
      name: 'AuthorEdit',
      component: () => import('../views/authors/AuthorUpdate.vue')
    },
  ]
})

export default router
