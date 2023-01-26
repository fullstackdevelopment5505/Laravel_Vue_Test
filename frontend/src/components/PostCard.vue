<template>
  <div class="card" >
    <img class="card-img-top" v-if="image" :src="`http://localhost:8000/storage${image}`" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{ title }}</h5>
      <p class="card-text"> {{ description }}</p>
      
      <div class="mt-2">
        <div class="mb-3">
            <input type="text" class="form-control" v-model="answer" placeholder="answer...">
        </div>
        <div class="mb-3">
            <input type="file" class="form-control"  @change="uploadFile" ref="file">
        </div>
        <a class="btn btn-primary" @click="handleClick">Add Answer</a>
      </div>
    
      <div class="mt-2">
        <div  v-for="(response, i) in responses" :key="`item__${i}`">
          <p>{{ response.description }}</p>
          <img v-if="response.image" :src="`http://localhost:8000/storage${response.image}`" width="100" height="100"/>
        </div>
      </div>
      <a href="javascript:void(0)" @click="fetchResponse">show answers</a>
    </div>
  </div>
</template>
<script>
  import { postAPI } from '../api/axios-base'

  export default {
    name: 'PostCard',
    props: {
      id: {
        type: Number,
        default: 0,
      },
      image: {
        type: String,
        default: "",
      },
      title: {
        type: String,
        default: "",
      },
      description: {
        type: String,
        default: "",
      },
    },
    data() {
      return {
        isShow: false,
        answer: "",
        responses: [],
        page: 1
      }
    },
    methods: {
      fetchResponse() {
        postAPI.get(`/api/response/${this.id}`, { headers: { Authorization: `Bearer ${this.$store.state.accessToken}` } })
          .then(response => {
            this.responses = response.data.data;
          })
      },
      handleClick() {
        const formData = new FormData();
        formData.append('file', this.Images);
        formData.append('description', this.answer);
        const headers = { 'Content-Type': 'multipart/form-data',  "Authorization": `Bearer ${this.$store.state.accessToken}` };

        postAPI.post(`/api/response/${this.id}`,  formData, { headers })
        .then(response => {
          if (response.data) {
            this.responses = [...this.responses, response.data.data]
          }
        })
        .catch(err => {
          console.log(err)
          console.log(err.response)
        })
      },
      uploadFile() {
        this.Images = this.$refs.file.files[0];
      },
    }
  }

</script>