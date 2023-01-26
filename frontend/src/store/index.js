import { createStore } from 'vuex'
import { axiosBase } from '../api/axios-base'

export default createStore({
  state: {
    accessToken: localStorage.getItem('access_token') || sessionStorage.getItem('access_token') || null,
    APIData: '', // received data from the backend API is stored here.,
    username: localStorage.getItem('username') || sessionStorage.getItem('username') || null,
    user_id: localStorage.getItem('user_id') || sessionStorage.getItem('user_id') || null,
    authenticated: localStorage.getItem('authenticated') || sessionStorage.getItem('authenticated') || 0,
  },
  getters: {
    loggedIn (state) {
      return state.accessToken != null
    }
  },
  mutations: {
    updateLocalStorage (state, { access }) {
      localStorage.setItem('access_token', access)
      localStorage.setItem('authenticated', 1)
      state.accessToken = access
    },
    destroyToken (state) {
      state.accessToken = null
      state.authenticated = 0
    }
  },
  actions: {
    logoutUser (context) {
      if (context.getters.loggedIn) {
        localStorage.removeItem('access_token')
        localStorage.removeItem('authenticated')
        context.commit('destroyToken')
      }
    },
    loginUser (context, credentials) {
      return new Promise((resolve, reject) => {
        axiosBase.post('/api/login/', {
          email: credentials.email,
          password: credentials.password
        })
        .then(response => {
          context.commit('updateLocalStorage', { access: response.data.token })
          resolve()
        })
        .catch(err => {
          reject(err)
        })
      })
    },
    registerUser (context, credentials) {
      return new Promise((resolve, reject) => {
        axiosBase.post('/api/register/', {
          name: credentials.name,
          email: credentials.email,
          password: credentials.password
        })
        .then(response => {
          context.commit('updateLocalStorage', { access: response.data.token })
          resolve()
        })
        .catch(err => {
          reject(err)
        })
      })
    },
  }
})