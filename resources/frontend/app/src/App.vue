<template>
    <header-component></header-component>
    <nav-component></nav-component>
    <div class="row col-12 min-vh-100 bg-conteyner  m-0">
        <div class="mt-3  m-auto mb-3 row-cols-11 m-auto m-sm-0 row-cols-sm-6 ">
            <div class="col-11  mt-3 col-sm-9 d-flex ">
                <div class="m-auto col-10">
                    <input type="search" @input="search($event)" class="form-control p-2 mt-2 mb-2"
                           placeholder="Search">
                    <div class="m-auto">
                        <span class="display-6 text-danger">{{ success }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="show" class="col-11 col-sm-9 mt-5">

            <div  v-for="(product, key) in searchData.data" :key="key"
                  class="row col-10 radius bg-secondary m-auto mb-3">

                <div class="col-11 m-auto m-sm-0 col-sm-5">
                    <img :src="images(product)[0]">
                </div>

                <div class="col-11 col-sm-6">
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product name:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ product.title }}</i></span>
                        </div>

                    </div>
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product category:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ product.category.title }}</i></span>
                        </div>

                    </div>
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product price:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ product.price + '$' }}</i></span>
                        </div>

                    </div>
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product Quantity:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ product.quantity }}</i></span>
                        </div>
                        <p class="display-6 mt-3 text-center"><strong>Product tags</strong></p>
                        <div v-if="product.tags.length" class="col-6">
                            <span v-for="(tag,k) in product.tags" :key="k"
                                  class="display-6 p-2 m-2 border radius border-dark"><i>{{ tag.title }}</i></span>
                        </div>
                        <div v-else class="col-12 text-center">
                            <span class="display-6 p-2 m-2 "><i>Empty</i></span>
                        </div>

                    </div>
                    <div class="col-12 row mb-5">
                        <div class="col-3 m-auto mt-5 text-danger text-center">
                            <router-link :to="{ name: 'showProduct', params: {id: product.id}}" class="text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                                </svg>
                            </router-link>
                        </div>
                        <div class="col-3 m-auto mt-5 text-center text-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path
                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                            </svg>
                            <span class="ms-2">{{ product.reviews_count }}</span>
                        </div>
                    </div>
                </div>
                <pagination :callback="getResults" :pagination="searchData" :size="'small'">

                </pagination>
            </div>
        </div>

        <div v-else class="col-11 col-sm-9 mt-5">
            <router-view/>
        </div>
        <div class="col-11 col-sm-3 mt-2 bg-stat radius m-auto mb-5 scroll ">
            <feedback-component></feedback-component>
        </div>
    </div>


</template>

<script>
import headerComponent from "@/components/HeaderComponent";
import navComponent from "@/components/NavComponent";
import feedbackComponent from "@/components/FeedbackComponent";
import paginationComponent from "@/components/PaginationComponent";
import axios from "axios";

export default {
    name: 'app',
    components: {
        headerComponent,
        navComponent,
        feedbackComponent,
        pagination: paginationComponent,
    },

    data() {
        return {
            searchData: {},
            show: false,
            success: '',
        }
    },

    computed: {
        url() {
            return this.$store.getters.getUrl + '/api/search'
        }
    },

    methods: {
        search(event) {
            let text = event.target.value;
            if (text.length >= 3) {
                axios.post(this.url, {text})
                    .then(r => {
                        console.log(r)
                        this.searchData = r.data;
                        this.show = true;
                        if(r.data.data.length===0){
                            this.success='Nothing found!!!';
                        }
                    })
                    .catch(e => {
                        console.log(e);
                    })
            }
            if(text===''){
                this.show=false;
                this.success='';
            }
        },

        getResults(page = 1) {
            axios.get(this.url + '/' + this.id + '?page=' + page)
                .then(r => {
                    this.searchData = r.data;
                });
        },

        images(product) {
            return JSON.parse(product.images);
        },
    },

    watch: {
        '$route': {
            immediate: true,
            handler() {
                this.show=false;
                this.success='';
            },
        },
    },

    created() {
        this.$store.dispatch('setAuth');
    }
}

</script>

<style>

img {
    width: 100%;
    padding: 3px;
    height: 300px;
    border-radius: 10px;
}

a {
    color: antiquewhite;
    text-decoration: none;
}

a:hover {
    color: antiquewhite;
}

.bg-conteyner {
    background-color: #D3D3D3;
}

.bg-stat {
    background-color: #A9A9A9;
}

.radius {
    border-radius: 10px;
}

@media (min-width: 576px) {
    .scroll {
        position: fixed;
        right: 0.5%;
    }
}

</style>
