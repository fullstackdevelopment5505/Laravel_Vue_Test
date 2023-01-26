import axios from 'axios'
import store from '../store'
import router from '../router'

const APIUrl = "http://localhost:8000/"
const axiosBase = axios.create({
  baseURL: APIUrl,
  headers: { 'content-type': 'application/json'}
})
const postAPI = axios.create({
  baseURL: APIUrl
})
postAPI.interceptors.response.use(undefined, async function (err) {
  // if error response status is 401, it means the request was invalid due to expired access token
  if (err.config && err.response && err.response.status === 401) {
    store.commit('logout');
    router.push('/login')
  }
  return Promise.reject(err) 
})
export { axiosBase, postAPI }
