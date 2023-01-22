<template>

    <div class="col-9 ">
        <div class="col-12 mt-5 text-center" v-show="!show">
            <div>
                <h2>Add product</h2>
            </div>
            <div class="d-flex col-12 flex-row text-center justify-content-center">
                <div class="m-3 p-3 col-9">
                    <input class="form-control m-3 mb-0  p-3" v-model.trim="productData.title" placeholder="Name">
                    <div class="text-danger text-start m-o ps-3">{{ err.title[0] }}</div>
                    <select v-model="productData.category_id" class="form-select m-3 mb-0  p-3">
                        <option disabled value="">Category</option>
                        <option v-for="(c, k) in categories" :value="c.id" :key="k">
                            {{ c.title }}
                        </option>
                    </select>
                    <div class="text-danger text-start m-o ps-3">{{ err.category_id[0] }}</div>
                    <select multiple v-model="productData.tag_ids" class="form-select m-3 mb-0  p-3">
                        <option value="" disabled>Tags</option>
                        <option v-for="(t, k) in tags"  :value="t.id" :key="k">
                            {{ t.title }}
                        </option>
                    </select>
                    <div class="text-danger text-start m-o ps-3">{{ err.tag_ids[0] }}</div>
                    <input type="number" class="form-control m-3 mb-0  p-3" v-model.trim="productData.price" placeholder="Price">
                    <div class="text-danger text-start m-o ps-3">{{ err.price[0] }}</div>
                    <input type="number" class="form-control m-3 mb-0  p-3" v-model.trim="productData.quantity"
                           placeholder="Quantity">
                    <div class="text-danger text-start m-o ps-3">{{ err.quantity[0] }}</div>
                    <div class="form-control m-3 mb-0  p-1">
                        <editor toolbar="essential" v-model:content="productData.description" contentType="html" theme="snow"
                                placeholder="Description" class="col-12" ></editor>
                    </div>

                    <div class="text-danger text-start m-o ps-3">{{ err.description[0] }}</div>

                    <div ref="images" class="btn d-block p-5 text-center  col-12 p-3 m-3 mb-0 border-2 border-dark"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                        </svg> Image upload
                    </div>
                    <div class="text-danger text-start m-o ps-3">{{ err.images[0] }}</div>

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
            <button v-show="show" @click="show=!show;" class="btn btn-info">Add</button>
        </div>

        <div class="d-flex col-12 text-center justify-content-center">
            <div class="col-11">
                <table class="table">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col">REVIEWS COUNT</th>
                        <th scope="col">LIKE</th>
                        <th scope="col">SHOW</th>
                        <th scope="col">ADD QUANTITY</th>
                        <th scope="col">DELETE</th>
                    </tr>
                    </thead>

                    <tbody>
                    <template v-for="(product, key) in products.data" v-bind:key="key">
                    <tr :class="!isShow(product.id) ? '' : 'd-none'">
                        <td>{{ key + 1 }}</td>
                        <td>{{ product.title }}</td>
                        <td>{{ product.category.title }}</td>
                        <td>{{ product.price+'$' }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>{{ product.reviews_count }}</td>
                        <td>{{ likes(product) }}</td>
                        <td>
                            <router-link :to="{name: 'product_show', params:{id: product.id}}" class="text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </router-link>
                        </td>
                        <td>
                            <a class="text-muted btn" @click.prevent='change(product)'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <a class="text-danger btn" @click.prevent="del(product.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                        <tr :class="isShow(product.id) ? '' : 'd-none'">
                            <td>{{ key + 1 }}</td>
                            <td>{{ product.title }}</td>
                            <td>{{ product.category.title }}</td>
                            <td>{{ product.price+'$' }}</td>
                            <td><input type="number" v-model="this.quantity" class="flex-column" placeholder="Quantity"></td>
                            <td>{{ product.reviews_count }}</td>
                            <td>{{ likes(product) }}</td>
                            <td>
                                <router-link :to="{name: 'product_show', params:{id: product.id}}" class="text-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </router-link>
                            </td>
                            <td>
                                <a class="text-muted" @click.prevent="updateQuantity(product.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a class="text-danger" @click.prevent="del(product.id)">
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
                    <pagination :pagination="products" :callback="getResults" :size="'small'">

                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../../api";
import PaginationComponent from "@/components/PaginationComponent";
import {Dropzone} from "dropzone";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
    name: "ProductsViews",

    components: {
        Pagination: PaginationComponent,
        Editor: QuillEditor,
    },

    data() {
        return {
            updateId: null,
            products: {},
            product: {},
            quantity: null,
            images: null,
            productData: {
                title: '',
                images: [],
                price: '',
                category_id: '',
                tag_ids: [],
                description: '',
                quantity: '',
            },
            err: {
                title: [''],
                images: [''],
                price: [''],
                category_id: [''],
                tag_ids: [''],
                description: [''],
                quantity: [''],
            },
            categories: {},
            tags: {},
            show: true,
            url: this.$store.state.URL + '/api/admin/products'
        }
    },
    computed:{

    },
    methods: {
        likes(product){
            if(typeof product.likes==='object'){
                return product.likes.length
            }
            return 0;
        },

        add() {
            this.err = {
                title: [''],
                images: [''],
                price: [''],
                category_id: [''],
                tag_ids: [''],
                description: [''],
                quantity: [''],
            };
            this.productData.tag_ids=Array.from(this.productData.tag_ids)
            const data = new FormData();
            data.append('title', this.productData.title);
            data.append('description', this.productData.description);
            data.append('price', this.productData.price);
            data.append('quantity', this.productData.quantity);
            data.append('category_id', this.productData.category_id);
            const files = this.images.getAcceptedFiles();

            files.forEach((file) => {
                data.append('images[]', file);
                this.images.removeFile(file);
            });

            this.productData.tag_ids.forEach((tag) => {
                data.append('tag_ids[]', tag);
            });

            api.post(this.url, data)
                .then(() => {
                    this.productData = {
                        title: '',
                        images: [],
                        price: '',
                        category_id: '',
                        tag_ids: [],
                        description: '',
                        quantity: '',
                    }
                    this.updateId='';
                    this.query();
                })
                .catch(err => {
                    if (err.response.data.errors) {
                        this.err = Object.assign(this.err, err.response.data.errors);
                    }
                    console.log(err);
                });

        },

        change(product) {
            this.show = true;
            this.quantity = product.quantity;
            this.updateId = product.id;
        },

        isShow(id) {
            return id === this.updateId;
        },

        updateQuantity(id) {
            api.post(this.url+'/updateQuantity/'+id,{
                quantity: this.quantity,
            })
                .then(()=>{
                    this.updateId=null;
                    this.quantity=null;
                    this.query();
                })
                .catch(err=>{
                    console.log(err);
                });
        },

        query() {
            api.get(this.url)
                .then(r => {
                    this.products = r.data.products;
                    this.categories = r.data.categories;
                    this.tags = r.data.tags;
                    console.log(r)
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
                    this.products = r.data.products;
                });
        }
    },

    created() {
        this.query();
    },

    mounted() {
        if (this.$refs.images) {
            this.images = new Dropzone(this.$refs.images, {
                url: '/',
                autoProcessQueue: false,
                addRemoveLinks: true,
                acceptedFiles: 'image/*',

            });
        }

    },

}
</script>

<style scoped>
textarea {
    height: 200px;
}
a{
    cursor: pointer;
    margin: 0;
    padding: 0;
}


</style>
