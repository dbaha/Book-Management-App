import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      //meta: { requiresAuth: true }
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
      //meta: { requiresAuth: true }
    },
    {
      path:'/author/create',
      name: 'AuthorCreate',
      component: () => import('../views/authors/AuthorCreate.vue'),
     // meta: { requiresAuth: true }
    },
    {
      path:'/author/:id/edit',
      name: 'AuthorEdit',
      component: () => import('../views/authors/AuthorUpdate.vue'),
      props:true,
      //meta: { requiresAuth: true }
    },
    {
      path:'/book',
      name: 'BookIndex',
      component: () => import('../views/books/BookIndex.vue'),
      //meta: { requiresAuth: true }
    },
    {
      path:'/book/create',
      name: 'BookCreate',
      component: () => import('../views/books/BookCreate.vue'),
      //meta: { requiresAuth: true }
    },
    {
      path:'/book/:id/edit',
      name: 'BookEdit',
      component: () => import('../views/books/BookUpdate.vue'),
      props:true,
      //meta: { requiresAuth: true }
    },
    {
      path: '/:catchAll(.*)*', // Catch-all route for unauthorized access
      redirect: { name: 'home' }
    }
  ]
});

//router.beforeEach((to, from, next) => {
//  if (to.matched.some(record => record.meta.requiresAuth) && !store.getters['auth/isLoggedIn']) {
//    next({ name: 'login' });
//  } else if (to.matched.some(record => record.meta.requiresAuth)) {
//    axios.get('/api/auth/check-token', {
//      headers: {
//        Authorization: `Bearer ${store.getters['auth/token']}`
//      }
//    })
//      .then(() => next())
//      .catch((error) => {
//        console.error('Token validation error:', error);
//        store.commit('auth/logout');
//        next({ name: 'login' });
//      });
//  } else {
//    next();
//  }
//});

export default router;
