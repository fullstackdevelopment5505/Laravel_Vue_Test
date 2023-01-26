<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 justify-content-center mt-5">
        <h2>Create Post</h2>
      </div>
      <div class="col-md-12 mt-5">
        <div class="mb-3">
          <input type="text" class="form-control" v-model="title" placeholder="title...">
        </div>
      </div>
      <div class="col-md-12 mt-5">
        <div class="mb-3">
          <input type="text" class="form-control" v-model="description" placeholder="description...">
        </div>
      </div>
      <div class="col-md-12 mt-5">
        <div class="mb-3">
          <input type="file" class="form-control"  @change="uploadFile" ref="file">
        </div>
      </div>
      <div class="col-md-12 text-end mt-5">
        <a class="btn btn-primary mr-2" @click="cancel()">cancel</a>
        <a class="btn btn-primary" @click="createPost()">Crete Post</a>
      </div>
    </div>
  </div>
</template>
<script>
  import { postAPI } from '../api/axios-base'
  export default {
    name: 'CreatePost',

    data() {
      return {
        title: "",
        description:"",
        image: ""
      }
    },
    methods: {
      createPost() {
        const formData = new FormData();
        formData.append('file', this.Images);
        formData.append('title', this.title);
        formData.append('description', this.description);
        const headers = { 'Content-Type': 'multipart/form-data',  "Authorization": `Bearer ${this.$store.state.accessToken}` };

        postAPI.post(`/api/post/`,  formData, { headers })
        .then(response => {
          console.log(response);
          alert(response.data.message)
        })
        .catch(err => {
          console.log(err)
          console.log(err.response)
        })
      },
      uploadFile() {
        this.Images = this.$refs.file.files[0];
      },
      cancel() {
        this.$router.push({name: 'Home'})
      }
    }
  }
</script>
