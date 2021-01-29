<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <a href="https://shouts.dev/" target="_blank"><img src="https://www.wpoint.co.uk/images/scc-logo.jpg"></a><br>
            <span class="text-secondary">Candidate Control System</span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link to="/home" class="nav-item nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/add" class="nav-item nav-link">Add Candidate</router-link>
                    </li>
                    <li class="nav-item" v-if="access==='true'">
                        <button class="btn btn-danger" @click="logout()">Logout</button>
                    </li>
                </ul>
            </div>
        </nav>
        <br/>
        <transition name="fade">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {                
                access: 'false'
            }
        },
        created() {
            this.access = localStorage.getItem("logout")
        },
        methods: {
            logout(){
                this.$swal.fire({
                title: 'Are you sure?',
                text: "Logout Application",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const token = localStorage.getItem('access');
                        this.axios.post('http://localhost:8000/api/candidate/logout',null,{
                                headers: {
                                        'Authorization': `Bearer ${token}`
                                }
                            })
                            .then(response => {
                                    localStorage.setItem('logout','false');
                                    localStorage.setItem("access","");
                                    this.$router.push({name: 'login'})
                                    location.reload();
                            })
                            .catch(error => console.log(error))
                            .finally(() => this.loading = false)    
                    }})
            },
        }
    }
</script>