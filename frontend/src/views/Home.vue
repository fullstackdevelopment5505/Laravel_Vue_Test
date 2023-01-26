<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-5 d-flex  justify-content-between">
        <a href="javascript:void(0)" @click="logout()"> Logout</a>
        <a  href="javascript:void(0)" @click="goPost()"> Create Post</a>
      </div>
      <div class="col-md-12 mt-5">
        <input type="text" class="form-control" placeholder="serach..." v-model="search" />        
      </div>
      <div class="col-md-12 d-flex justify-content-between mt-5">
        <a href="javascript:void(0)" class="mr-2" @click="prev()">prev</a> <a href="javascript:void(0)"  @click="next()">next</a>
      </div>
      <div class="col-md-12 d-flex justify-content-center mt-5">
        <div class="row">
          <div class="col-md-4 mb-5" v-for="(post, i) in posts" :key="`item__${i}`">
            <PostCard  :title="post.title" :description="post.description" :image="post.image" :id="post.id" ></PostCard>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import PostCard from '@/components/PostCard.vue'
  import { postAPI } from '../api/axios-base'

  export default {
    name: 'VueHome',
    components: {
      PostCard,
    },
    data() {
      return {
        page: 1,
        posts:[],
        search: "",
        lastPage: 1,
      }
    },
    computed: {
      authenticated() {
        if (this.$store.state.authenticated == 1) {
          return true;
        } else {
          return false;
        }
      }        
    },
    watch: {
      'search': {
        handler: function () {
          this.getPosts()
        }
      }
    },
    mounted() {
      this.getPosts()
    },
    methods: {
      logout() {
        this.$store.dispatch('logoutUser')
        this.$router.push({name: 'LogIn'})
      },
      goPost() {
        this.$router.push({name: 'CreatePost'})
      },
      getPosts() {
        postAPI.get(`/api/post/?page=${this.page}&search=${this.search}`, { headers: { Authorization: `Bearer ${this.$store.state.accessToken}` } })
        .then(response => {
          if (response.data) {
            this.posts = response.data.data
            this.lastPage = response.data.last_page
          }
        })
        .catch(err => {
          console.log(err)
          console.log(err.response)
        })
      },
      prev() {
        if (this.page > 1) {
          this.page = this.page - 1
          this.getPosts()
        }
      },
      next() {
        if (this.page < this.lastPage) {
          this.page = this.page + 1
          this.getPosts()
        }
      }
    }
  }
</script>
