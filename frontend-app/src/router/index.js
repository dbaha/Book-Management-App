import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import axios from 'axios';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true }
    },
    {
      path:'/login',
      name: 'login',
      component: LoginView
    },
    {
      path:'/author',
      name: 'AuthorIndex',
      component: () => import('../views/authors/AuthorIndex.vue'),
      meta: { requiresAuth: true }
    },
    {
      path:'/author/create',
      name: 'AuthorCreate',
      component: () => import('../views/authors/AuthorCreate.vue'),
      meta: { requiresAuth: true }
    },
    {
      path:'/author/:id/edit',
      name: 'AuthorEdit',
      component: () => import('../views/authors/AuthorUpdate.vue'),
      props:true,
      meta: { requiresAuth: true }
    },
    {
      path:'/book',
      name: 'BookIndex',
      component: () => import('../views/books/BookIndex.vue'),
      meta: { requiresAuth: true }
    },
    {
      path:'/book/create',
      name: 'BookCreate',
      component: () => import('../views/books/BookCreate.vue'),
      meta: { requiresAuth: true }
    },
    {
      path:'/book/:id/edit',
      name: 'BookEdit',
      component: () => import('../views/books/BookUpdate.vue'),
      props:true,
      meta: { requiresAuth: true }
    },
    {
      path: '/:catchAll(.*)*', // Catch-all route for unauthorized access
      redirect: { name: 'home' }
    }
  ]
});
router.beforeEach(async (to,from,next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    const token = localStorage.getItem('token');

    try {
      const response = await axios.get('http://127.0.0.1:8000/api/token', {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });

      if (response.status === 200 ) {
        next();
      } else {
        localStorage.removeItem('token');
        console.log("failed to login ");
        next({ name: 'login' });
      }
    } catch (error){
      if(error.response.status === 401){
        console.log("Unauthenticated!");
        next({ name: 'login' });
      }
    }
  } else {
    // Non-protected route, proceed as usual
    next();
  }
});



export default router;
