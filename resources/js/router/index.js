import { createRouter, createWebHistory } from 'vue-router'
// import HomeView from '../views/HomeView.vue'

const routes = [
  // {
  //   path: '/',
  //   name: 'home',
  //   component: HomeView
  // },
  // {
  //   path: '/:pathMatch(.*)*',
  //   name: 'notfound',
  //   component: () => import(/* webpackChunkName: "notfound" */ '../views/PageNotFound.vue')
  // }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
