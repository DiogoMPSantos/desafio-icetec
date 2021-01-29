<template>
    <div>
        <h3 class="text-center">Edit Candidate</h3>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form @submit.prevent="updateCandidate">
                        <div class="form-group">
                                <label>Name</label>
                                <input type="text" required class="form-control" v-model="candidate.name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" required class="form-control" v-model="candidate.email">
                            </div>
                            <div class="form-group">
                                <label>Old</label>
                                <input type="number" required class="form-control" v-model="candidate.old">
                            </div>
                            <div class="form-group">
                                <label>Url Linkedin</label>
                                <input type="url" class="form-control" required v-model="candidate.url">
                            </div>
                            <div class="form-group">
                                <label>Skills</label>
                                <select required class="form-control" v-model="candidate.skills" multiple>
                                    <option value="C#">C#</option>
                                    <option value="Javascript">Javascript</option>
                                    <option value="Nodejs">Nodejs</option>
                                    <option value="Angular">Angular</option>
                                    <option value="Ionic">Ionic</option>
                                    <option value="Mensageria">Mensageria</option>
                                    <option value="PHP">PHP</option>
                                    <option value="Laravel">Laravel</option>
                                </select>
                            </div>
                        <button type="submit" class="btn btn-primary">Update Candidate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                candidate: {}
            }
        },
        created() {
            const token = localStorage.getItem('access');
            this.axios
                .get(`http://localhost:8000/api/candidate/edit/${this.$route.params.id}`,{
                    headers: {
                            'Authorization': `Bearer ${token}`
                        }
                })
                .then((response) => {
                    this.candidate = response.data;
                })
                .catch(error => { this.$router.push({name: 'login'})})
                .finally(() => this.loading = false);
        },
        methods: {
            updateCandidate() {
                const token = localStorage.getItem('access');
                this.axios
                    .post(`http://localhost:8000/api/candidate/update/${this.$route.params.id}`, this.candidate,{
                        headers: {
                                'Authorization': `Bearer ${token}`
                            }
                    })
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    })
                    .catch(error =>  this.$router.push({name: 'login'}))
                    .finally(() => this.loading = false);
            }
        }
    }
</script>