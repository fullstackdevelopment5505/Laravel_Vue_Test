import { createApp } from 'vue'
import App from './App.vue'
import './assets/bootstrap.min.css'
import './assets/custom.css'
import router from './router'
import store from './store'
import infiniteScroll from 'vue-infinite-scroll'

createApp(App).use(router).use(store).use(infiniteScroll).mount('#app')