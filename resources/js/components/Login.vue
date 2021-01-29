<template>
    <div class="container text-center col-md-4">
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form class="form-signin" autocomplete="off" @submit.prevent="login" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" v-model="credentials.email" class="form-control mb-3" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" v-model="credentials.password" class="form-control mb-3" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        error: null,
        credentials: {}
      }
    },
    methods: {
      login(){
        this.axios.post('http://localhost:8000/api/login', this.credentials)
            .then(response => {
                    if (response.data.token) {
                        localStorage.setItem('access', response.data.token)
                        localStorage.setItem('logout', 'true')
                        this.$router.push({name: 'home'})
                        location.reload();
                    }
                })
            .catch(error =>  this.$router.push({name: 'login'}))
            .finally(() => this.loading = false)    
      },
    }
  } 
</script>