<template>
    <div>
        <h3 class="text-center">All Candidates</h3><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Old</th>
                <th>Linkedin</th>
                <th>Skills</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="candidate in candidates" :key="candidate.id">
                <td>{{ candidate.name }}</td>
                <td>{{ candidate.email }}</td>
                <td>{{ candidate.old }}</td>
                <td>{{ candidate.url }}</td>
                <td>{{ candidate.url }}</td>
                <td>
                    <div class="btn-group d-flex" role="group">
                        <router-link :to="{name: 'edit', params: { id: candidate.id }}" class="btn btn-primary mr-1"><i class="fas fa-edit"></i>
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(candidate.id)"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                candidates: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/candidates')
                .then(response => {
                    this.candidates = response.data;
                });
        },
        methods: {
            deleteCandidate(id) {
                this.axios
                    .delete(`http://localhost:8000/api/candidate/delete/${id}`)
                    .then(response => {
                        let i = this.candidates.map(item => item.id).indexOf(id); // find index of your object
                        this.candidates.splice(i, 1)
                    });
            }
        }
    }
</script>