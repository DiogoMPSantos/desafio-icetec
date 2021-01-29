<template>
    <div>
        <h3 class="text-center">Add Candidate</h3>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form @submit.prevent="addCandidate">
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
                        <button type="submit" class="btn btn-primary">Add Candidate</button>
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
        methods: {
            addCandidate() {

                this.axios
                    .post('http://localhost:8000/api/candidate/create', this.candidate)
                    .then(response => (
                        this.$router.push({name: 'home'})
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>