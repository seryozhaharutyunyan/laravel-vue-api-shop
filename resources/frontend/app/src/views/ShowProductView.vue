<template>
    <div class="col-11  justify-content-center ms-5 mt-5  p-3">
        <div class="col-12 mb-3 bg-dark m-auto text-light radius">
            <div class=" corusel col-12">
                <div class="corusel-a">
                    <span v-for="(img, k) in images" :key="k" ref="dots" class="dot" @click="currentSlide(k+1)"></span>
                </div>
                <div v-for="(img, k) in images" :key="k" ref="slides" class="corusel-v">
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
                    <span class="display-6"><i>{{ product.price + '$' }}</i></span>
                </div>

                <div class="col-6">
                    <span class="display-6"><strong>Product quantity:</strong></span>
                </div>
                <div class="col-6">
                    <span class="display-6"><i>{{ product.quantity }}</i></span>
                </div>
                <p class="display-6 mt-3 text-center"><strong>Product tags</strong></p>
                <div v-if="product.tags.length" class="col-6">
                    <span v-for="(tag,k) in product.tags" :key="k" class="display-6 p-2 m-2 border radius border-light"><i>{{
                            tag.title
                        }}</i></span>
                </div>
                <div v-else class="col-12 text-center">
                    <span class="display-6 p-2 m-2 "><i>Empty</i></span>
                </div>

                <p class="display-6 mt-3 text-center"><strong>Described</strong></p>
                <span class="p-3 ms-3 me-3" v-html="product.description"></span>
                <div class="col-12 row mb-5">
                    <div v-if="product.quantity===0" class="text-danger m-1 display-6 col-3 m-auto mt-5 text-center">not
                        available
                    </div>
                    <div v-else class="col-3 m-auto mt-5 text-center">
                        <input type="number" v-model="quantity" class="form-control mb-1 col-3" min="0"
                               :max="product.quantity" placeholder="Quantity">
                        <button class="btn btn-info" @click="addBasket(product)">Add basket</button>
                    </div>
                    <template v-if="$store.getters.getAuth">
                        <div v-if="!showUserLike()"
                             class="btn border-0 col-3 m-auto mt-5 text-danger text-center"
                             @click="addLike(product.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                            </svg>
                            <span class="ms-2">{{ like.length }}</span>
                        </div>
                        <div v-else class="btn border-0 col-3 m-auto mt-5 text-danger text-center"
                             @click="addLike(product.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                            <span class="ms-2">{{ like.length }}</span>
                        </div>
                    </template>
                    <template v-else>
                        <div class="btn border-0 col-3 m-auto mt-5 text-danger text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                            </svg>
                            <span class="ms-2">{{ like.length }}</span>
                        </div>
                    </template>
                    <div class="col-3 m-auto mt-5 text-center text-muted">
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

        <div v-if="$store.getters.getAuth" class="col-12 bg-dark m-auto text-light p-3 mb-3 radius">
            <div class="radius col-11 m-auto border-light border-3">
                <div class=" form-control mb-0  p-1">
                    <textarea v-model="comment" placeholder="Comment" class="h-25 area col-12"></textarea>
                </div>
                <div class="text-danger text-start m-o ps-3">{{ err }}</div>
                <div class="m-auto mt-3 text-center">
                    <button class="btn btn-light" @click="addComment()">Add comment</button>
                </div>
            </div>
        </div>
        <div class="col-12">
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
                            {{
                                comment.user.created_at.substring(0, 10) + ' ' + comment.user.created_at.substring(12, 19)
                            }}
                        </div>
                    </div>
                    <p class="comment" v-html="comment.comment"></p>

                </div>
            </div>
            <div class="m-auto d-flex justify-content-center">
                <pagination class="m-auto" :callback="getResults" :pagination="comments" :size="'small'"/>
            </div>
        </div>


    </div>
</template>

<script>
import axios from "axios";
import api from "../../api";
import PaginationComponent from "@/components/PaginationComponent";

export default {
    name: "ProductShowView",

    data() {
        return {
            id: this.$route.params.id,
            product: {},
            index: 1,
            like: {},
            quantity: null,
            user: {},
            err: '',
            comment: '',
            comments: {},
        }
    },

    components: {
        pagination: PaginationComponent,
    },

    computed: {
        url() {
            return this.$store.state.URL + '/api';
        },

        images() {
            return JSON.parse(this.product.images);
        }
    },
    methods: {
        showUserLike() {
            for (let key in this.like) {
                if (this.user.id === this.like[key].user_id) {
                    return true;
                }
            }
            return false;

        },

        getLikes(product) {
            axios.get(this.url + '/likes/show/' + product.id)
                .then(r => {
                    this.like = r.data;
                })
                .catch(e => {
                    console.log(e)
                })
        },

        getComments(product) {
            axios.get(this.url + '/comments/' + product.id)
                .then(r => {
                    this.comments = r.data
                })
                .catch(e => {
                    console.log(e)
                })
        },

        addComment() {
            this.err = '';
            const data = {
                product_id: this.product.id,
                comment: this.comment,
                user_id: this.user.id,
            }

            axios.post(this.url + '/comments', data)
                .then(() => {
                    this.comment = '';
                    this.query();
                })
                .catch(e => {
                    this.err = e.response.data.message;
                })
        },

        addBasket(product) {
            if (this.$store.getters.getAuth) {
                this.addBasketAuth(product);
            } else {
                this.addBasketUAuth(product);
            }
        },
        addBasketUAuth(product) {
            if (this.quantity) {
                let img = JSON.parse(product.images);
                let flag = true;
                let data = [
                    {
                        id: product.id,
                        name: product.title,
                        image: img[0],
                        category: product.category.title,
                        quantity: this.quantity,
                        price: product.price,
                    }
                ];

                if (!localStorage.getItem('count')) {
                    localStorage.setItem('count', 1);
                }

                if (!localStorage.getItem('basket')) {
                    data = JSON.stringify(data);
                    localStorage.setItem('basket', data);
                } else {
                    let stor = JSON.parse(localStorage.getItem('basket'));
                    stor.forEach((value) => {
                        if (value.id === data[0].id && value.price === data[0].price) {
                            value.quantity += data[0].quantity;
                            flag = false
                        }
                    });
                    if (flag) {
                        stor.push(data[0]);
                        let count = localStorage.getItem('count');
                        count = count * 1 + 1;
                        localStorage.setItem('count', count);
                    }

                    stor = JSON.stringify(stor);
                    localStorage.setItem('basket', stor);
                }


                data = [];
                this.quantity = null;
                this.$store.dispatch('setCount');
            }

        },

        getCount() {

            api.get(this.url + '/orders/count')
                .then(r => {
                    localStorage.clear()
                    localStorage.setItem('count', r.data);
                    this.$store.dispatch('setCount');
                })
                .catch(e => {
                    console.log(e)
                })
        },

        addBasketAuth(product) {
            if (this.quantity) {
                let data = {
                    price: product.price,
                    city_id: this.user.city_id,
                    address: this.user.address,
                    product_id: product.id,
                    quantity: this.quantity,
                }

                api.post(this.url + '/orders/auth', data)
                    .then((r) => {
                        console.log(r);
                        this.getCount();
                        this.quantity = null;

                    })
                    .catch(e => {
                        console.log(e);
                    });
            }

        },

        addLike(id) {

            api.post(this.url + '/likes/' + id)
                .then(() => {
                    this.query()
                })
        },


        query() {
            axios.get(this.url + "/products/" + this.id)
                .then(r => {
                    console.log(r);
                    this.product = r.data;
                    this.getLikes(r.data);
                    this.getComments(r.data);

                })
                .catch(err => {
                    console.log(err);
                })
        },

        getUser() {

            if (sessionStorage.getItem('token')) {
                api.post(this.url + '/auth/me')
                    .then(r => {
                        this.user = r.data;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            } else {
                this.user = {};
            }

        },

        getResults(page = 1) {
            axios.get(this.url + '/comments/' + this.id + '?page=' + page)
                .then(r => {
                    this.comments = r.data;
                });
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
            this.index = k
            this.showSlides(this.index);
        },

        addReviewsCount(id) {
            axios.get(this.url + '/products/reviews_count/' + id)
                .then(() => {
                    this.query();
                })
                .catch(err => {
                    console.log(err);
                })
        },
    },

    watch: {
        '$store.state.auth'() {
            this.getUser()
        }
    },

    created() {
        this.getUser();
        this.addReviewsCount(this.id);
    },

    mounted() {
        this.showSlides(this.index);
        this.start();
    },
}
</script>

<style>

.comment {
    border: 2px solid #708090;
    border-radius: 5px;
    padding: 0.2em;
    margin: 1em;
    font-size: 1.4em;
}

.area {
    border-radius: 5px;
    min-height: 150px;
}

.radius {
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

.img {
    width: 100%;
    padding: 3px;
    height: 100px;
    border-radius: 10px;
}
</style>
