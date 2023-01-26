import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import VueLogIn from '../views/LogIn.vue'
import VueRegister from '../views/Register.vue'
import CreatePost from '../views/CreatePost.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/login',
    name: 'LogIn',
    component: VueLogIn,
  },
  {
    path: '/register',
    name: 'Register',
    component: VueRegister,
  },
  {
    path: '/createpost',
    name: 'CreatePost',
    component: CreatePost,
  },
];
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router