<template>
    <div class="col-10">
        <div class="col-11 justify-content-center ms-5 mt-5 p-3">
            <div v-show="show" class="col-8 bg-dark m-auto text-light radius">
                <div class=" corusel col-12">
                    <div class="corusel-a">
                        <span v-for="(img, k) in image" :key="k" ref="dots" class="dot" @click="currentSlide(k+1)"></span>
                    </div>
                    <div v-for="(img, k) in image" :key="k" ref="slides" class="corusel-v">
                        <img :src="img" :alt="product.title">
                        <div class="text"><a href=""></a></div>
                    </div>
                    <a class="prev text-light" @click="goSlide(-1)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                    </a>
                    <a class="next text-light" @click="goSlide(1)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                        </svg>
                    </a>
                </div>
                <div class=" col-12 m-auto mt-3 row">
                    <div class="col-6">
                        <span class="display-6"><strong>Product name:</strong></span>
                    </div>
                    <div class="col-6">
                        <span class="display-6"><i>{{ product.title }}</i></span>
                    </div>

                    <div class="col-6">
                        <span class="display-6"><strong>Product category:</strong></span>
                    </div>
                    <div class="col-6">
                        <span class="display-6"><i>{{ product.category.title }}</i></span>
                    </div>

                    <div class="col-6">
                        <span class="display-6"><strong>Product price:</strong></span>
                    </div>
                    <div class="col-6">
                        <span class="display-6"><i>{{ product.price+'$' }}</i></span>
                    </div>

                    <div class="col-6">
                        <span class="display-6"><strong>Product quantity:</strong></span>
                    </div>
                    <div class="col-6">
                        <span class="display-6"><i>{{ product.quantity }}</i></span>
                    </div>
                    <p  class="display-6 mt-3 text-center"><strong>Product tags</strong></p>
                    <div v-if="product.tags.length" class="col-6">
                        <span  v-for="(tag,k) in product.tags" :key="k"  class="display-6 p-2 m-2 border radius border-light"><i>{{ tag.title }}</i></span>
                    </div>
                    <div v-else class="col-12 text-center">
                        <span  class="display-6 p-2 m-2 "><i>Empty</i></span>
                    </div>
                    <p class=" display-6 mt-3 text-center"><strong>Described</strong></p>
                    <span class="p-3 ms-3 me-3" v-html="product.description"></span>
                    <div class="col-12 row mb-5">
                        <div class="col-3 m-auto mt-5 text-center">
                            <button class="btn btn-info" @click="show=!show">Update</button>
                        </div>
                        <div class=" col-3 m-auto mt-5 text-danger text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-balloon-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.49 10.92C19.412 3.382 11.28-2.387 8 .986 4.719-2.387-3.413 3.382 7.51 10.92l-.234.468a.25.25 0 1 0 .448.224l.04-.08c.009.17.024.315.051.45.068.344.208.622.448 1.102l.013.028c.212.422.182.85.05 1.246-.135.402-.366.751-.534 1.003a.25.25 0 0 0 .416.278l.004-.007c.166-.248.431-.646.588-1.115.16-.479.212-1.051-.076-1.629-.258-.515-.365-.732-.419-1.004a2.376 2.376 0 0 1-.037-.289l.008.017a.25.25 0 1 0 .448-.224l-.235-.468ZM6.726 1.269c-1.167-.61-2.8-.142-3.454 1.135-.237.463-.36 1.08-.202 1.85.055.27.467.197.527-.071.285-1.256 1.177-2.462 2.989-2.528.234-.008.348-.278.14-.386Z"/>
                            </svg>
                            <span class="ms-2">{{like.length}}</span>
                        </div>
                        <div class="col-3 m-auto mt-5 text-center text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                            </svg>
                            <span class="ms-2">{{product.reviews_count}}</span>
                        </div>

                    </div>
                </div>
            </div>

            <div v-show="!show" class="col-12 mt-5 text-center">
                <div>
                    <h2>Update product</h2>
                </div>
                <div class="d-flex col-12 flex-row text-center justify-content-center">
                    <div class="m-3 p-3 col-9">
                        <input class="form-control m-3 mb-0  p-3" v-model.trim="product.title" placeholder="Name">
                        <div class="text-danger text-start m-o ps-3">{{ err.title[0] }}</div>
                        <select v-model="product.category_id" class="form-select m-3 mb-0  p-3">
                            <option disabled value="">Category</option>
                            <option v-for="(c, k) in categories" :value="c.id" :key="k">
                                {{ c.title }}
                            </option>
                        </select>
                        <div class="text-danger text-start m-o ps-3">{{ err.category_id[0] }}</div>
                        <select multiple v-model="product.tag_ids"  class="form-select m-3 mb-0  p-3">
                            <option value="" disabled>Tags</option>
                            <option v-for="(t, k) in tags"  :value="t.id" :key="k">
                                {{ t.title }}
                            </option>
                        </select>
                        <div class="text-danger text-start m-o ps-3">{{ err.tag_ids[0] }}</div>
                        <input type="number" class="form-control m-3 mb-0  p-3" v-model.trim="product.price" placeholder="Price">
                        <div class="text-danger text-start m-o ps-3">{{ err.price[0] }}</div>
                        <input type="number" class="form-control m-3 mb-0  p-3" v-model.trim="product.quantity"
                               placeholder="Quantity">
                        <div class="text-danger text-start m-o ps-3">{{ err.quantity[0] }}</div>
                        <div class="form-control m-3 mb-0  p-1">
                            <editor  toolbar="essential" v-model:content="product.description" contentType="html" theme="snow" placeholder="Description" class="col-12" ></editor>
                        </div>
                        <div class="text-danger text-start m-o ps-3">{{ err.description[0] }}</div>
                        <div class="row col-12 m-3 mb-0  p-3">
                            <div class="col-3" v-for="(img, k) in img" :key="k">
                                <img class="img" :src="img" :alt="product.title" @click="deleteImg(k)">
                            </div>
                        </div>
                        <div ref="images" class="btn d-block p-5 text-center  col-12 p-3 m-3 mb-0 border-2 border-dark"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                            </svg> Image upload
                        </div>
                        <div class="text-danger text-start m-o ps-3">{{ err.images[0] }}</div>

                        <button @click="update" class="btn btn-info m-3 p-3">
                            Update
                        </button>
                        <button @click="show=!show" class="btn btn-info m-3 p-3">
                            Close
                        </button>
                    </div>
                </div>

            </div>
            <div class="mt-5 col-8 m-auto">
                <div v-for="(comment, key) in comments.data" :key="key"
                     class="col-12 bg-dark m-auto text-light p-3 mb-3 radius">
                    <div class="radius border-light border-3">
                        <div class="col-12">
                            <div class="h5 d-inline-block ps-3 col-12 text-start">User name:
                                {{ comment.user.name + ' ' + comment.user.last_name }}
                            </div>
                            <div class="h5 d-inline-block ps-3 col-12 col-sm-4 text-start">User email: {{
                                    comment.user.email
                                }}
                            </div>
                            <div class="h5 d-inline-block p-3 col-12 col-sm-7 text-end">
                                {{ comment.user.created_at.substring(0, 10) + ' ' + comment.user.created_at.substring(12, 19) }}
                            </div>
                        </div>
                        <p class="comment" v-html="comment.comment"></p>
                        <div class="h5 d-inline-block ps-3 col-12 text-start">
                            <button @click="deleteComment(comment.id)" class="btn btn-light">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="m-auto d-flex justify-content-center">
                    <pagination class="m-auto" :callback="getResults" :pagination="comments" :size="'small'"/>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import api from "../../api";
import {Dropzone} from "dropzone";
import { QuillEditor } from '@vueup/vue-quill'
import PaginationComponent from "@/components/PaginationComponent";
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import axios from "axios";


export default {
    name: "ProductShowView",
    components:{
        Editor: QuillEditor,
        Pagination: PaginationComponent,
    },
    data() {
        return {
            id: this.$route.params.id,
            product: {
                tag_ids: [],
            },
            index: 1,
            show: true,
            categories:{},
            tags:{},
            err: {
                title: [''],
                images: [''],
                price: [''],
                category_id: [''],
                tag_ids: [''],
                description: [''],
                quantity: [''],
            },
            img: [],
            images: [],
            deleteImage: [],
            like: '',
            comments: {},
        }
    },
    computed: {
        url() {
            return this.$store.state.URL + '/api/admin/products/show';
        },
        urlImg() {
            return this.$store.state.URL + '/storage/'
        },
        image() {
            return JSON.parse(this.product.images);
        }
    },
    methods: {
        getComments(product) {
            api.get(this.$store.state.URL + '/api/admin/comments/' + product.id)
                .then(r => {
                    this.comments=r.data
                })
                .catch(e => {
                    console.log(e)
                })
        },

        deleteComment(id){
            api.delete(this.$store.state.URL + '/api/admin/comments/' + id)
                .then(() => {
                   this.query();
                })
                .catch(e => {
                    console.log(e)
                })
        },

        getResults(page = 1) {
            axios.get(this.url + '/comments/'+this.id+'?page=' + page)
                .then(r => {
                    this.comments = r.data;
                });
        },

        getLikes(product) {
            axios.get(this.$store.state.URL + '/api/likes/show/' + product.id)
                .then(r => {
                    this.like=r.data;
                })
                .catch(e => {
                    console.log(e)
                })
        },

        tag(){
            this.product.tags.forEach(item=>{
                this.product.tag_ids.push(item.id)
            })
        },

        update(){
            this.err = {
                title: [''],
                images: [''],
                price: [''],
                category_id: [''],
                tag_ids: [''],
                description: [''],
                quantity: [''],
            };

            const data = new FormData();
            data.append('title', this.product.title);
            data.append('description', this.product.description);
            data.append('price', this.product.price);
            data.append('quantity', this.product.quantity);
            data.append('category_id', this.product.category_id);
            const files = this.images.getAcceptedFiles();

            files.forEach((file) => {
                data.append('images[]', file);
                this.images.removeFile(file);
            });

            this.product.tag_ids.forEach((tag) => {
                data.append('tag_ids[]', tag);
            });

            this.img.forEach((img) => {
                data.append('img[]', img);
            });

            this.deleteImage.forEach((img) => {
                data.append('img_d[]', img);
            });
            api.post(this.url+'/update/'+this.id, data)
                .then((r) => {
                    if(r.data.err){
                        this.err.images[0]=r.data.err;
                    }else{
                        this.show=true;
                        this.query();
                    }

                })
                .catch(err => {
                    if (err.response.data.errors) {
                        this.err = Object.assign(this.err, err.response.data.errors);
                    }
                    console.log(err);
                });

        },

        query() {

            api.get(this.url + "/" + this.id)
                .then(r => {
                    Object.assign(this.product, r.data.product);
                    this.categories=r.data.categories;
                    this.tags=r.data.tags;
                    this.tag();
                    this.img=JSON.parse(this.product.images);
                    this.getLikes(this.product);
                    this.getComments(this.product);
                })
                .catch(err => {
                    console.log(err);
                })
        },

        deleteImg(k){
            this.deleteImage.push(this.img[k]);

            let arr=this.img.filter((v,i)=>{
                return i!==k;
            });

            this.img=arr;
        },

        drop(){
            if (this.$refs.images) {
                this.images = new Dropzone(this.$refs.images, {
                    url: '/',
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    acceptedFiles: 'image/*',

                });
            }
        },

        /**** slider ****/
        start() {
            setInterval(this.goSlide
            , 3000);
        },

        showSlides(n) {
            const slides = this.$refs.slides;
            const dots = this.$refs.dots
            if (n > slides.length) {
                this.index = 1
            }
            if (n < 1) {
                this.index = slides.length
            }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (let i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace("active", "");
            }
            slides[this.index - 1].style.display = "block";
            dots[this.index - 1].className += " active";
        },

        goSlide() {
            this.showSlides(this.index += 1);
        },

        currentSlide(k) {
            this.index=k
            this.showSlides(this.index);
        }
    },

    created() {
        this.query();
    },

    mounted() {
        this.drop();
        this.showSlides(this.index);
        this.start();
    },
}
</script>

<style>
.dz-success-mark{
    display: none;
}

.dz-error-mark{
    display: none;
}

.radius{
    border-radius: 10px;
}

/*CORUSEL*/
.corusel {
    height: 400px;
    margin: auto;
    position: relative;
}

.corusel .corusel-v img {
    width: 100%;
    height: 400px;
    border-radius: 10px 10px 0 0;
}

.prev, .next {
    font-size: 1.8rem;
    position: absolute;
    top: 38%;
    width: auto;
    padding: 16px;
    margin-top: -22px;
    font-weight: bold;
    transition: 0.5s;
    border-radius: 0 3px 3px 0;
}

.next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

.prev:hover, .next:hover {
    cursor: pointer;
    background-color: rgb(0, 0, 0, 0.5)
}

.text {
    display: block;
    font-size: 1.5rem;
    padding: 10px;
    position: absolute;
    top: 0;
    margin-top: 5px;
    padding: 0;
    background-color: #000;
    width: 100%;
    text-align: center;
    opacity: 0.7;
    color: #fff;
}

.corusel-a {
    display: block;
    position: absolute;
    left: 48%;
    bottom: 0.6rem;
}

.dot {
    cursor: pointer;
    height: 13px;
    width: 13px;
    background-color: #bdb9b9;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
}

.active, .dot:hover {
    background-color: rgb(56, 56, 56);
}

.img{
    width: 100%;
    padding: 3px;
    height: 100px;
    border-radius: 10px;
}
</style>
