<template>
    <div>
        <template v-if="!$store.getters.getAuth">
            <div v-for="(product, key) in products" :key="key" class="row col-10 radius bg-secondary m-auto mb-3">
                <div class="col-11 m-auto m-sm-0 col-sm-5">
                    <img :src="product.image">
                </div>

                <div class="col-11 col-sm-6">
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product name:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ product.name }}</i></span>
                        </div>

                    </div>
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product category:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ product.category }}</i></span>
                        </div>

                    </div>
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product price:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ (product.price * product.quantity) + '$' }}</i></span>
                        </div>

                    </div>

                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product Quantity:</strong></span>
                        </div>
                        <div v-show="!show(product.id)" class="col-6">
                            <span class="h5"><i>{{ product.quantity }}</i></span>
                        </div>
                        <div v-show="show(product.id)" class="col-6">
                            <input type="number" class="form-control col-3" v-model="quantity" min="0"
                                   :max="productQuantity" placeholder="Quantity">
                            <div class="text-danger">{{ err }}</div>
                        </div>
                        <div v-show="panel(product.id)" class="col-12 m-auto mt-3 row">
                            <div class="m-3 p-3 col-6">
                                <select v-model="edge_id" class="form-select m-3 mb-0  p-3"
                                        @change="queryRegions($event); queryCity($event)">
                                    <option disabled value="">Edge</option>
                                    <option v-for="(e, k) in edges" :value="e.id" :key="k">
                                        {{ e.name }}
                                    </option>
                                </select>
                                <div class="text-danger text-start m-o ps-3">{{ errC.edge_id[0] }}</div>

                                <select v-if="regions" v-model="region_id" class="form-select m-3 mb-0  p-3"
                                        @change="queryCity($event)">
                                    <option value="">Region</option>
                                    <option v-for="(r, k) in regions" :value="r.id" :key="k">
                                        {{ r.name }}
                                    </option>
                                </select>

                                <select v-if="cities" v-model="city_id" class="form-select m-3 mb-0  p-3">
                                    <option disabled value="">City</option>
                                    <option v-for="(c, k) in cities" :value="c.id" :key="k">
                                        {{ c.name }}
                                    </option>
                                </select>
                                <div v-if="cities" class="text-danger text-start m-o ps-3">{{
                                        errC.city_id[0]
                                    }}
                                </div>

                                <input type="text" class="form-control m-3 mb-0  p-3" name="address"
                                       v-model.trim="address"
                                       placeholder="Address">
                                <div class="text-danger text-start m-o ps-3">{{ errC.address[0] }}</div>
                            </div>
                        </div>
                        <div class="display-6 text-danger">{{ orderErr }}</div>
                    </div>
                    <div class="col-12 row mb-5">
                        <div v-if="guard" class="col-10 col-sm-3 m-auto mt-1 mt-sm-5 text-danger text-center">
                            <button class="btn btn-light" @click="showPanel(product)">Order</button>
                        </div>
                        <div v-else class="col-10 col-sm-3 m-auto mt-1 mt-sm-5 text-danger text-center">
                            <button class="btn btn-light" @click="setOrderUAuth(product)">Order</button>
                        </div>
                        <div v-show="!show(product.id)"
                             class="col-10 col-sm-3 mt-1 m-auto mt-sm-5 text-danger text-center">
                            <button class="btn btn-light" @click="getProductQuantity(product)">Update</button>
                        </div>
                        <div v-show="show(product.id)"
                             class="col-10 col-sm-3 mt-1 m-auto mt-sm-5 text-danger text-center">
                            <button class="btn btn-light" @click="updateUAuth()">Update</button>
                        </div>
                        <div class="col-10 col-sm-3 m-auto mt-sm-5 mt-1 text-danger text-center">
                            <button class="btn btn-light" @click="deletedUAut(product)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template v-else>
            <div v-for="(order, key) in orders" :key="key" class="row col-10 radius bg-secondary m-auto mb-3">
                <div class="col-11 m-auto m-sm-0 col-sm-5">
                    <img :src="images(order.product)[0]">
                </div>

                <div class="col-11 col-sm-6">
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product name:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ order.product.title }}</i></span>
                        </div>

                    </div>
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product category:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ order.product.category.title }}</i></span>
                        </div>

                    </div>
                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product price:</strong></span>
                        </div>
                        <div class="col-6">
                            <span class="h5"><i>{{ (order.price * order.quantity) + '$' }}</i></span>
                        </div>

                    </div>

                    <div class="col-12 m-auto mt-3 row">
                        <div class="col-6">
                            <span class="h5"><strong>Product Quantity:</strong></span>
                        </div>
                        <div v-show="!show(order.product_id)" class="col-6">
                            <span class="h5"><i>{{ order.quantity }}</i></span>
                        </div>
                        <div v-show="show(order.product_id)" class="col-6">
                            <input type="number" class="form-control col-3" v-model="quantity" min="0"
                                   :max="productQuantity" placeholder="Quantity">
                            <div class="text-danger">{{ err }}</div>
                        </div>
                        <div v-show="panel(order.product_id)" class="col-12 m-auto mt-3 row">
                            <div class="m-3 p-3 col-6">
                                <select v-model="edge_id" class="form-select m-3 mb-0  p-3"
                                        @change="queryRegions($event); queryCity($event)">
                                    <option disabled value="">Edge</option>
                                    <option v-for="(e, k) in edges" :value="e.id" :key="k">
                                        {{ e.name }}
                                    </option>
                                </select>
                                <div class="text-danger text-start m-o ps-3">{{ errC.edge_id[0] }}</div>

                                <select v-if="regions" v-model="region_id" class="form-select m-3 mb-0  p-3"
                                        @change="queryCity($event)">
                                    <option value="">Region</option>
                                    <option v-for="(r, k) in regions" :value="r.id" :key="k">
                                        {{ r.name }}
                                    </option>
                                </select>

                                <select v-if="cities" v-model="city_id" class="form-select m-3 mb-0  p-3">
                                    <option disabled value="">City</option>
                                    <option v-for="(c, k) in cities" :value="c.id" :key="k">
                                        {{ c.name }}
                                    </option>
                                </select>
                                <div v-if="cities" class="text-danger text-start m-o ps-3">{{
                                        errC.city_id[0]
                                    }}
                                </div>

                                <input type="text" class="form-control m-3 mb-0  p-3" name="address"
                                       v-model.trim="address"
                                       placeholder="Address">
                                <div class="text-danger text-start m-o ps-3">{{ errC.address[0] }}</div>
                            </div>
                        </div>
                        <div class="display-6 text-danger">{{ orderErr }}</div>
                    </div>
                    <div class="col-12 row mb-5">
                        <div class="col-10 col-sm-3 m-auto mt-1 mt-sm-5 text-danger text-center">
                            <button class="btn btn-light" @click="setOrderAuth(order.product)">Order</button>
                        </div>
                        <div v-show="!show(order.product_id)"
                             class="col-10 col-sm-3 mt-1 m-auto mt-sm-5 text-danger text-center">
                            <button class="btn btn-light" @click="getProductQuantity(order.product)">Update</button>
                        </div>
                        <div v-show="show(order.product_id)"
                             class="col-10 col-sm-3 mt-1 m-auto mt-sm-5 text-danger text-center">
                            <button class="btn btn-light" @click="updateAuth(order)">Update</button>
                        </div>
                        <div class="col-10 col-sm-3 m-auto mt-sm-5 mt-1 text-danger text-center">
                            <button class="btn btn-light" @click="deletedAut(order.id)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

</template>

<script>

import axios from "axios";
import api from "../../api";

export default {
    name: "BasketView",

    data() {
        return {
            orders: [],
            products: [],
            updateId: null,
            productQuantity: null,
            quantity: null,
            err: '',
            orderErr: '',
            edges: {},
            regions: null,
            cities: null,
            edge_id: '',
            region_id: '',
            city_id: '',
            address: '',
            errC: {
                edge_id: [''],
                region_id: [''],
                city_id: [''],
                address: [''],
            },
            panel_id: null,
            guard: !this.$store.state.aut,
            user: {},

        }
    },

    computed: {
        url() {
            return this.$store.getters.getUrl + '/api/';
        },


    },


    methods: {
        images(product) {
            return JSON.parse(product.images);
        },

        getCount() {

            api.get(this.url + 'orders/count')
                .then(r => {
                    localStorage.clear()
                    localStorage.setItem('count', r.data);
                    this.$store.dispatch('setCount');
                })
                .catch(e => {
                    console.log(e)
                })
        },

        getUser() {

            if (sessionStorage.getItem('token')) {
                api.post(this.url + 'auth/me')
                    .then(r => {
                        this.user = r.data;
                        this.getProductsAuth()
                    })
                    .catch(e => {
                        console.log(e);
                    });
            } else {
                this.user = {};
            }

        },

        getProductsUAuth() {
            if (localStorage.getItem('basket')) {
                this.products = JSON.parse(localStorage.getItem('basket'));
            }
        },

        getProductsAuth() {
            api.get(this.url + 'orders/products')
                .then(r => {
                    console.log(r)
                    this.orders = r.data;
                    this.getCount();
                })
                .catch(e => {
                    console.log(e);
                });
        },

        getProductQuantity(product) {
            this.updateId = product.id;
            if (product.order_quantity) {
                this.quantity = product.order_quantity;
            } else {
                this.quantity = product.quantity;
            }


            axios.get(this.url + 'products/quantity/' + product.id)
                .then(r => {
                    this.productQuantity = r.data;
                    if (this.productQuantity < this.quantity) {
                        this.quantity = this.productQuantity;
                    }
                    if (this.productQuantity === 0) {
                        this.err = 'No product';
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        },

        show(id) {
            return id === this.updateId;
        },

        updateUAuth() {
            if (this.quantity === 0) {
                this.deleted(this.updateId);
                this.updateId = null;
                this.quantity = null;
                this.productQuantity = null;
            } else {
                let store = JSON.parse(localStorage.getItem('basket'));
                store.forEach(item => {
                    if (item.id === this.updateId) {
                        item.quantity = this.quantity;
                    }
                });

                store = JSON.stringify(store);
                localStorage.setItem('basket', store);
                this.updateId = null;
                this.quantity = null;
                this.productQuantity = null;
            }
            this.getProductsUAuth()
        },

        deletedUAut(product) {
            let data = JSON.parse(localStorage.getItem('basket'));
            product.price = product.price * 1;
            let newData = data.filter((item) => {
                item.price = item.price * 1;
                if (item.id !== product.id || item.price !== product.price && item.id === product.id) {
                    return true;
                }
                return false;


            });

            newData = JSON.stringify(newData);
            localStorage.setItem('basket', newData);

            let count = localStorage.getItem('count') * 1;
            if (count > 0) {
                count -= 1;
            } else {
                count = 0
            }

            localStorage.setItem('count', count);
            this.$store.dispatch('setCount');
            this.getProductsUAuth();
        },

        updateAuth(order) {
            if (this.quantity === 0) {
                this.deletedAut(order.id)
            } else {
                api.post(this.url + 'orders/update', {
                    order_id: order.id,
                    quantity: this.quantity,
                })
                    .then(() => {
                        this.getProductsAuth(this.user.id);
                        this.updateId = null;
                    })
                    .catch(e => {
                        console.log(e)
                    })
            }

        },

        deletedAut(id) {

            api.delete(this.url + 'orders/' + id)
                .then(() => {
                    this.getProductsAuth(this.user.id);
                    let count = localStorage.getItem('count') * 1;
                    if (count > 0) {
                        count -= 1;
                    } else {
                        count = 0
                    }

                    localStorage.setItem('count', count);
                    this.$store.dispatch('setCount');

                })
                .catch(e => {
                    console.log(e);
                })

        },

        setOrderAuth(product) {
            axios.get(this.url + 'products/quantity/' + product.id)
                .then(r => {
                    let quanytty = r.data;
                    if (quanytty >= product.order_quantity) {
                        api.get(this.url + 'orders/set_order/' + product.order_id)
                            .then(() => {
                                this.getProductsAuth(this.user.id);
                                let count = localStorage.getItem('count') * 1;
                                if (count > 0) {
                                    count -= 1;
                                } else {
                                    count = 0
                                }

                                localStorage.setItem('count', count);
                                this.$store.dispatch('setCount');

                            })
                            .catch(e => {
                                console.log(e)
                            })
                    } else if (quanytty < product.order_quantity && quanytty !== 0) {
                        this.orderErr = 'not so much in stock';
                    } else {
                        this.orderErr = 'not available';
                    }

                })
                .catch(err => {
                    console.log(err)
                })

        },

        showPanel(product) {
            axios.get(this.url + 'products/quantity/' + product.id)
                .then(r => {
                    let quanytty = r.data;
                    if (quanytty >= product.quantity) {
                        this.panel_id = product.id;
                        this.guard = !this.guard;
                    } else if (quanytty < product.quantity && quanytty !== 0) {
                        this.orderErr = 'not so much in stock';
                    } else {
                        this.orderErr = 'not available';
                    }

                })
                .catch(err => {
                    console.log(err)
                })
        },

        panel(id) {
            return id === this.panel_id;
        },

        setOrderUAuth(product) {
            this.errC = {
                edge_id: [''],
                region_id: [''],
                city_id: [''],
                address: [''],
            }
            const data = {
                product_id: product.id,
                quantity: product.quantity,
                price: product.price,
                edge_id: this.edge_id,
                city_id: this.city_id,
                address: this.address,
                region_id: this.region_id,
            };
            axios.post(this.url + 'orders/u_auth', data)
                .then(() => {
                    this.deletedUAut(product.id);
                    this.getProductsUAuth();

                })
                .catch(err => {
                    console.log(err)
                    if (err.response.data.errors) {
                        this.errC = Object.assign(this.errC, err.response.data.errors);
                    }
                });
        },

        queryRegions(event) {
            let id = event.target.value;
            this.region_id = '';
            if (id) {
                axios.get(this.url + 'orders/edge_regions/' + id)
                    .then(r => {
                        this.regions = r.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        },

        queryCity(event) {
            let id = event ? event.target.value : this.edge_id;
            let url = '';
            if (this.region_id && id) {
                url += this.url + 'orders/region_cities/' + id;
            } else if (this.edge_id && !this.region_id) {
                url += this.url + 'orders/edge_cities/' + this.edge_id;
            } else {
                return false;
            }
            axios.get(url)
                .then(r => {
                    this.cities = r.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },

        queryEdges() {
            axios.get(this.url + 'orders/edges')
                .then((r) => {
                    this.edges = r.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }

    },

    watch: {
        '$store.state.auth'() {
            this.getUser()
        }
    },

    created() {
        this.getUser();
        this.getProductsUAuth();
        this.queryEdges();
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
