<template>

    <div class="col-9 ">
        <div class="col-12 mt-5 text-center" v-if="!show">
            <div>
                <h2>Add city</h2>
            </div>
            <div class="d-flex col-12 flex-row text-center justify-content-center">
                <div class="m-3 p-3 col-6">
                    <input class="form-control m-3 mb-0  p-3" name="name" v-model.trim="name" placeholder="Name">
                    <div class="text-danger text-start m-o ps-3">{{ err }}</div>
                    <select v-model="edge_id" class="form-select m-3 mb-0  p-3" aria-label="Edge" @change="queryRegion($event)">
                        <option disabled value="">Edge</option>
                        <option v-for="(e, k) in edges" :value="e.id" :key="k" >
                            {{ e.name }}
                        </option>
                    </select>
                    <select v-if="regions" v-model="region_id" class="form-select m-3 mb-0  p-3" aria-label="Edge">
                        <option value="">Region</option>
                        <option v-for="(e, k) in regions" :value="e.id" :key="k" >
                            {{ e.name }}
                        </option>
                    </select>

                    <div class="text-danger text-start m-o ps-3">{{ errE }}</div>
                    <button @click="add" class="btn btn-info m-3 p-3">
                        Add
                    </button>
                    <button @click="show=!show; edge_id=''" class="btn btn-info m-3 p-3">
                        Close
                    </button>
                </div>
            </div>

        </div>
        <div class="col-12 mt-3 mb-3 text-center justify-content-center">
            <button v-if="show" @click="show=!show; name=''; edge_id=''; updateId=undefined" class="btn btn-info">Add</button>
        </div>

        <div class="d-flex col-12 text-center justify-content-center">
            <div class="col-8">
                <table class="table">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">CITY</th>
                        <th scope="col">REGION</th>
                        <th scope="col">EDGE</th>
                        <th scope="col">UPDATE</th>
                        <th scope="col">DELETE</th>
                    </tr>
                    </thead>

                    <tbody>

                    <template v-for="(city, key) of cities.data" v-bind:key="key">
                        <tr :class="!isShow(city.id) ? '' : 'd-none'">
                            <td>{{ key + 1 }}</td>
                            <td>{{ city.name }}</td>
                            <td>{{ region(city) }}</td>
                            <td>{{ city.edge.name }}</td>
                            <td>
                                <a class="text-info" @click.prevent="changeId(city.id, city.name, city.edge_id, city.region_id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a class="text-danger" @click.prevent="del(city.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr :class="isShow(city.id) ? '' : 'd-none'">
                            <td>{{ key + 1 }}</td>
                            <td>
                                <input type="text" v-model="name" class="form-control">
                                <div class="text-danger text-start m-o ps-3">{{ err }}</div>
                            </td>
                            <td>
                                <select v-if="regions" v-model="region_id" class="form-select" aria-label="Edge">
                                    <option disabled value="">Region</option>
                                    <option v-for="(e, k) in regions" :value="e.id" :key="k" >
                                        {{ e.name }}
                                    </option>
                                </select>
                            </td>
                            <td>
                                <select v-model="edge_id" class="form-select" aria-label="Edge" @change="queryRegion(edge_id)">
                                    <option disabled value="">Edge</option>
                                    <option v-for="(e, k) in edges" :value="e.id" :key="k" >
                                        {{ e.name }}
                                    </option>
                                </select>
                                <div class="text-danger text-start m-o ps-3">{{ errE }}</div>
                            </td>
                            <td>
                                <a class="text-info" @click.prevent="update(city.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                        <path
                                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a class="text-danger" @click.prevent="del(city.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </template>

                    </tbody>
                </table>
                <div class="col-12 text-center text-dark d-flex col-12 text-center justify-content-center">
                    <pagination :pagination="cities" :callback="getResults" :size="'small'">

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
    name: "RegionsViews",

    components: {
        Pagination: PaginationComponent,
    },

    data() {
        return {
            cities: [],
            updateId: undefined,
            name: '',
            region_id: '',
            edge_id: '',
            edges: '',
            regions: '',
            err: '',
            errE: '',
            show: true,
            url: this.$store.state.URL+'/api/admin/cities',
        }
    },

    methods: {
        region(city){
            if (city.region){
                return city.region.name;
            } else {
                return '';
            }
        },

        queryRegion(event){
            this.region_id='';
            let id='';
            if(typeof event==='object'){
                id=event.target.value;
            }else {
                id=event;
            }

            api.get(this.url+'/search_regions/'+id)
                .then(r=>{
                    this.regions=r.data;
                })
                .catch(err=>{
                    console.log(err);
                })
        },

        add() {
            this.setContent()
            this.region_id='';
            this.edge_id='';
        },

        changeId(id, name, edge_id, region_id) {
            this.show=true;
            this.name = name;
            this.updateId = id;
            this.edge_id=edge_id;
            if(region_id===null){
                region_id='';
            }
            this.queryRegion(edge_id)
            this.region_id=region_id;
        },

        isShow(id) {
            return id === this.updateId;
        },

        update(id) {
            this.setContent(id)
        },

        setContent(id = null) {
            let url = ''
            if (id === null) {
                url += this.url;
            } else {
                url += (this.url + '/' + id);
            }
            if (this.name === "") {
                this.err = 'name field is empty';
            } else if (this.name.length <= 2) {
                this.err = 'pole name cannot be beat shorter than 2 syngvols';
            } else if (this.edge_id === '') {
                this.errE = 'edge field is empty';
            } else {
                api.post(url,
                    {
                        name: this.name,
                        edge_id: this.edge_id,
                        region_id:this.region_id,
                    })
                    .then(() => {
                        this.updateId = undefined;
                        this.name = '';
                        this.edge_id = '';
                        this.query();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }

        },

        query() {
            api.get(this.url)
                .then(r => {
                    this.cities=r.data.cities
                    this.edges = r.data.edges;
                    this.regions = r.data.regions;
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
                .then(r => {
                    this.cities = r.data.cities;
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
