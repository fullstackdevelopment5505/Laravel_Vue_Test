<template>
<div class="container">
  <div class="row">
      <div class="col-md-12 justify-content-center mt-5">
          <h2>Login</h2>
      </div>
      <form
        action="#"
        method="POST"
        class="space-y-6"
        @submit.prevent="login()"
      >
        <div>
          <div class="mt-1">
            <label> Email </label>
            <input
              id="email"
              v-model="input.email"
              type="login"
              required
              class="form-control"
              data-email
            >
          </div>
        </div>

        <div class="mt-1">
          <label>Password</label>
          <div class="mt-1 rounded-md shadow-sm">
            <input
              id="pass"
              v-model="input.password"
              type="password"
              required
              class="form-control"
              data-password
            >
          </div>
        </div>

        <div class="mt-1  d-flex  justify-content-between">
          <a href="javascript:void(0)" @click="goRegister()">Register</a>
          <span class="">
            <button
              type="submit"
              class="btn btn-primary"
              :disabled="spin"
            >
              <svg
                v-if="spin"
                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
              >
                <circle
                  class="opacity-25"
                  cx="12"
                  cy="12"
                  r="10"
                  stroke="currentColor"
                  stroke-width="4"
                />
                <path
                  class="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                />
              </svg>
              login
            </button>
          </span>
        </div>
        <div
          v-if="status"
        >
          <div class="flex">
            <div class="ml-3">
              <p
                :class="{'text-green-800':status=='success','text-red-800':status=='error'}"
                class="error-msg text-sm leading-5 font-medium"
              >
                {{ message }}
              </p>
            </div>
          </div>
        </div>
      </form>
  </div>
</div>
</template>

<script>
export default {
  name: 'SignIn',
  props: {
  },
  data() {
    return {
      spin: false,
      input: {
        email: "",
        password: "",
      },
      status: null,
      message: null
    }
  },
  methods: {
    goRegister() {
      this.$router.push({name: 'Register'})
    },
    login () { // call loginUSer action
      this.spin = true,
      this.$store.dispatch('loginUser', {
        email: this.input.email,
        password: this.input.password,
      })
      .then(() => {
        this.$router.push({ name: 'Home' })
      })
      .catch(err => {
        this.spin = false
        this.status = 'error';
        this.message = "Incorrect credentials"
        return err
      })
    }
  }
}
</script>
