<template>
    <div>
        <h3 class="text-center">All Candidates</h3><br/>
        <div class="pb-2"> 
            <select required class="form-control col-4" v-model="searchSkill">
                <option value="" disabled selected>Filter By Skill</option>
                <option value="All">All</option>
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
            <tr v-for="candidate in searchTable" :key="candidate.id">
                <td>{{ candidate.name }}</td>
                <td>{{ candidate.email }}</td>
                <td>{{ candidate.old }}</td>
                <td>{{ candidate.url }}</td>
                <td>
                    <ul v-for="skill in candidate.skills" :key="candidate.skills.id" class="list-group">
                       <li class="list-group-item"> {{ skill.name }} </li>
                    </ul>
                </td>
                <td>
                    <div class="btn-group d-flex" role="group">
                        <router-link :to="{name: 'edit', params: { id: candidate.id }}" class="btn btn-primary mr-1"><i class="fas fa-edit"></i>
                        </router-link>
                        <button class="btn btn-danger" @click="deleteCandidate(candidate.id)"><i class="fas fa-trash"></i></button>
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
                candidates: [],
                searchSkill: ''
            }
        },
        created() {
            const token = localStorage.getItem('access');
            this.axios
                .get('http://localhost:8000/api/candidate/candidates', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(response => {
                    this.candidates = response.data;
                })
                .catch(error =>  this.$router.push({name: 'login'}))
                .finally(() => this.loading = false)      
                
        },
        methods: {
            deleteCandidate(id) {
               this.$swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const token = localStorage.getItem('access');
                        this.axios
                            .delete(`http://localhost:8000/api/candidate/delete/${id}`,{
                                headers: {
                                        'Authorization': `Bearer ${token}`
                                    }
                            })
                            .then(response => {
                                let i = this.candidates.map(item => item.id).indexOf(id); // find index of your object
                                this.candidates.splice(i, 1)
                            });
                    }
                })
                    
            }
        },
        computed: {
            searchTable(){
                if(this.searchSkill){
                    if(this.searchSkill=="All"){
                        return this.candidates;
                    }else{
                        return this.candidates.filter((item)=>{
                            return item.skills.find(skill => skill.name === this.searchSkill);
                        })
                    }
                }else{
                    return this.candidates;
                }
            }
        }
    }
</script>