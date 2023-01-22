<template>

    <div class="col-9 ">
        <div class="col-12 mt-5 text-center" v-if="!show">
            <div>
                <h2>Add moderator</h2>
            </div>
            <div class="d-flex col-12 flex-row text-center justify-content-center">
                <div class="m-3 p-3 col-6">
                    <input type="text" class="form-control m-3 mb-0  p-3" name="name" v-model.trim="userData.name"
                           placeholder="Name">
                    <div class="text-danger text-start m-o ps-3">{{ err.name[0] }}</div>
                    <input type="text" class="form-control m-3 mb-0  p-3" name="last_name"
                           v-model.trim="userData.last_name"
                           placeholder="Last name">
                    <div class="text-danger text-start m-o ps-3">{{ err.last_name[0] }}</div>
                    <input type="email" class="form-control m-3 mb-0  p-3" name="email" v-model.trim="userData.email"
                           placeholder="Email">
                    <div class="text-danger text-start m-o ps-3">{{ err.email[0] }}</div>
                    <input type="tel" class="form-control m-3 mb-0  p-3" name="pone" v-model.trim="userData.pone"
                           placeholder="Pone">
                    <div class="text-danger text-start m-o ps-3">{{ err.pone[0] }}</div>

                    <select v-model="userData.edge_id" class="form-select m-3 mb-0  p-3"
                            @change="queryRegions($event); queryCity($event)">
                        <option disabled value="">Edge</option>
                        <option v-for="(e, k) in edges" :value="e.id" :key="k">
                            {{ e.name }}
                        </option>
                    </select>
                    <div class="text-danger text-start m-o ps-3">{{ err.edge_id[0] }}</div>

                    <select v-if="regions" v-model="region_id" class="form-select m-3 mb-0  p-3"
                            @change="queryCity($event)">
                        <option value="">Region</option>
                        <option v-for="(r, k) in regions" :value="r.id" :key="k">
                            {{ r.name }}
                        </option>
                    </select>

                    <select v-if="cities" v-model="userData.city_id" class="form-select m-3 mb-0  p-3">
                        <option disabled value="">City</option>
                        <option v-for="(c, k) in cities" :value="c.id" :key="k">
                            {{ c.name }}
                        </option>
                    </select>
                    <div v-if="cities" class="text-danger text-start m-o ps-3">{{ err.city_id[0] }}</div>

                    <input type="text" class="form-control m-3 mb-0  p-3" name="address" v-model.trim="userData.address"
                           placeholder="Address">
                    <div class="text-danger text-start m-o ps-3">{{ err.address[0] }}</div>
                    <input type="date" class="form-control m-3 mb-0  p-3" name="last_name" v-model.trim="userData.age"
                           max="2006-01-01">
                    <div class="text-danger text-start m-o ps-3">{{ err.age[0] }}</div>


                    <div>
                        <label class="p-3">Gender</label><br>
                        <input class="form-check-input" type="radio" name="gender" v-model="userData.gender"
                               value="male">
                        <label class="form-check-label p-3 pt-0">Male</label><br>
                        <input class="form-check-input" type="radio" name="gender" v-model="userData.gender"
                               value="female">
                        <label class="form-check-label p-3 pt-0">Female</label>
                    </div>
                    <div class="text-danger text-start m-o ps-3">{{ err.gender[0] }}</div>
                    <button @click="add" class="btn btn-info m-3 p-3">
                        Add
                    </button>
                    <button @click="show=!show" class="btn btn-info m-3 p-3">
                        Close
                    </button>
                </div>
            </div>

        </div>
        <div class="col-12 mt-3 mb-3 text-center justify-content-center">
            <button v-if="show" @click="show=!show" class="btn btn-info">Add</button>
        </div>

        <div class="d-flex col-12 text-center justify-content-center">
            <div class="col-9">
                <table class="table">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">FULL NAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">CITY</th>
                        <th scope="col">SHOW</th>
                        <th scope="col">BLOCK</th>
                        <th scope="col">DELETE</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(user, key) in users.data" v-bind:key="key">
                        <td>{{ key + 1 }}</td>
                        <td>{{ user.name+' '+user.last_name}}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.city.name }}</td>
                        <td>
                            <router-link :to="{name: 'user_show', params:{id: user.id}}" class="text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </router-link>
                        </td>
                        <td v-if="!user.block">
                            <a class="text-danger" @click.prevent="block(user.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                </svg>
                            </a>
                        </td>
                        <td v-else>
                            <a class="text-info" @click.prevent="block(user.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <a class="text-danger" @click.prevent="del(user.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <div class="col-12 text-center text-dark d-flex col-12 text-center justify-content-center">
                    <pagination :pagination="users" :callback="getResults" :size="'small'">

                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../../api";
import PaginationComponent from "@/components/PaginationComponent";

export default {
    name: "CategoriesViews",

    components: {
        Pagination: PaginationComponent,
    },

    data() {
        return {
            users: {},
            err: {
                name: [''],
                last_name: [''],
                email: [''],
                pone: [''],
                edge_id: [''],
                region: [''],
                city_id: [''],
                address: [''],
                age: [''],
                gender: [''],
            },
            userData: {
                name: '',
                last_name: '',
                email: '',
                pone: '',
                city_id: '',
                edge_id: '',
                address: '',
                age: '',
                gender: '',

            },
            edges: {},
            regions: '',
            region_id: '',
            cities: '',
            show: true,
        }
    },

    computed:{
        // eslint-disable-next-line vue/no-dupe-keys
        url(){
            return this.$store.state.URL+'/api/admin/users'
        }
    },

    methods: {
        add() {
            this.err = {
                name: [''],
                last_name: [''],
                email: [''],
                pone: [''],
                edge_id: [''],
                region: [''],
                city_id: [''],
                address: [''],
                age: [''],
                gender: [''],
            }
            api.post(this.url,
                this.userData)
                .then(() => {
                    this.userData = {
                        name: '',
                        last_name: '',
                        email: '',
                        pone: '',
                        city_id: '',
                        edge_id: '',
                        address: '',
                        age: '',
                        gender: '',
                    }
                    this.query();
                })
                .catch((err) => {
                    console.log(err)
                    if (err.response.data.errors) {
                        this.err = Object.assign(this.err, err.response.data.errors);
                    }
                });

        },


        queryRegions(event) {
            let id = event.target.value;
            this.region_id = '';
            if (id) {
                api.get(this.url + '/edge_regions/' + id)
                    .then(r => {
                        this.regions = r.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        },

        queryCity(event) {
            let id = event.target.value;
            let url = ''
            if (this.region_id && id) {
                url += this.url + '/region_cities/' + id;
            } else if ( this.userData.edge_id && !this.region_id) {
                url += this.url + '/edge_cities/' + this.userData.edge_id;
            } else {
                return false;
            }
            api.get(url)
                .then(r => {
                    this.cities = r.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },

        block(id) {
            api.get(this.url + '/block/' + id)
                .then((r) => {
                    console.log(r)
                    this.query();
                })
                .catch(err => {
                    console.log(err);
                })


        },

        query() {
            api.get(this.url)
                .then(r => {
                    console.log(r)
                    this.users = r.data.users;
                    this.edges = r.data.edges;
                })
                .catch(err => {
                    console.log(err);
                });
        },

        del(id) {
            api.delete(this.url + '/' + id)
                .then(() => {
                    this.query();
                })
                .catch(err => {
                    console.log(err);
                });
        },

        getResults(page = 1) {
            api.get(this.url + '?page=' + page)
                .then((r) => {
                    this.users = r.data.users;
                });
        }
    },
    created() {
        this.query();
    },

}
</script>

<style scoped>

</style>
