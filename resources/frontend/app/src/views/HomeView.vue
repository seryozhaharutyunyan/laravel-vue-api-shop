<template>
    <div v-for="(product, key) in products" :key="key" class="row col-10 radius bg-secondary m-auto mb-3">

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
                <p  class="display-6 mt-3 text-center"><strong>Product tags</strong></p>
                <div v-if="product.tags.length" class="col-6">
                    <span  v-for="(tag,k) in product.tags" :key="k"  class="display-6 p-2 m-2 border radius border-dark"><i>{{ tag.title }}</i></span>
                </div>
                <div v-else class="col-12 text-center">
                    <span  class="display-6 p-2 m-2 "><i>Empty</i></span>
                </div>

            </div>
            <div class="col-12 row mb-5">
                <div class="col-3 m-auto mt-5 text-danger text-center">
                    <router-link :to="{ name: 'showProduct', params: {id: product.id}}" class="text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                            <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
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
    </div>
</template>

<script>

import axios from "axios";

export default {
  name: 'HomeView',
    data() {
        return {
            id: this.$route.params.id,
            products: {},
            like: true,
        }
    },

    computed: {
        url() {
            return this.$store.getters.getUrl + '/api';
        },


    },


    methods: {
        images(product) {
            return  JSON.parse(product.images);
        },

        query() {
            axios.get(this.url+'/showTop')
                .then(r => {
                    this.products = r.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },

    },

    created() {
        this.query();
    },
}
</script>

<style scoped>
img {
    width: 100%;
    padding: 3px;
    height: 300px;
    border-radius: 10px;
}
</style>
