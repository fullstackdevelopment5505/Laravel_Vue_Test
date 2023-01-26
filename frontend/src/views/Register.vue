<template>
  <div class="container">
    <div class="col-md-12 justify-content-center mt-5">
        <h2>Register</h2>
    </div>
    <form
      action="#"
      method="POST"
      class="space-y-6"
      @submit.prevent="register()"
    >
      <div>
        <div class="mt-1">
          <label> Email </label>
          <input
            id="login"
            v-model="input.email"
            type="login"
            required
            class="form-control"
          >
        </div>
        <div class="mt-1">
          <label>name</label>
          <div class="mt-1 rounded-md shadow-sm">
            <input
              id="name"
              v-model="input.name"
              type="text"
              required
              class="form-control"
            >
          </div>
        </div>
        <div class="mt-1">
          <label> Password </label>
          <input
            id="Password"
            v-model="input.password"
            type="password"
            required
            class="form-control"
          >
        </div>
      </div>
      <div class="text-end mt-1  d-flex  justify-content-between">
        <a href="javascript:void(0)" @click="goLogin()">Login</a>
        <button
          type="submit"
          class="btn btn-primary"
        >
          Register
        </button>
      </div>
    </form>
  </div>
</template>
<script>
  export default {
    name: 'VueRegister',
    data() {
      return {
        input: {
          email: "",
          password: "",
          name:""
        },
        message: null
      }
    },
    methods: {
      goLogin() {
        this.$router.push({name: 'LogIn'})
      },
      register () {
        this.$store.dispatch('registerUser', {
          email: this.input.email,
          password: this.input.password,
          name: this.input.name,
        })
        .then(() => {
          this.$router.push({ name: 'Home' })
        })
        .catch(err => {
          this.message = err
        })
      }
    }
  }
</script>