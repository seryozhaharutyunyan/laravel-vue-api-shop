<template>

    <div class="col-9 mt-5 m-auto">
        <div class="d-flex col-12 text-center justify-content-center">
            <button @click="showSent=false; showNoSent=true" class="btn border-warning p-2 m-2">Show not sent orders</button>
            <button @click="showSent=true; showNoSent=false" class="btn border-warning p-2 m-2">Show sent orders</button>
        </div>
        <div v-if="showNoSent" class="d-flex col-12 text-center justify-content-center">
            <div class="col-12">
                <table class="table">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">PRODUCT</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">USER</th>
                        <th scope="col">PONE/EMAIL</th>
                        <th scope="col">ADDRESS</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">DELETE</th>
                    </tr>
                    </thead>

                    <tbody>

                    <template v-for="(order, key) in orderNoSent.data" v-bind:key="key">
                        <tr>
                            <td>{{ key + 1 }}</td>
                            <td>{{ order.product.title }}</td>
                            <td>{{ order.product.category.title }}</td>
                            <td>{{ order.quantity }}</td>
                            <td>{{ order.price * order.quantity }}</td>
                            <td>{{ order.order.user_id ? order.order.user.name : '' }}</td>
                            <td><p
                                v-html="order.order.user_id ? order.order.user.pone+'<br>'+order.order.user.email : ''"></p>
                            </td>
                            <td><p v-html="fullAddress(order.order)"></p></td>
                            <td>
                                <button class="btn btn-info" @click="sent(order.id)">{{ order.status }}</button>
                            </td>
                            <td>
                                <a class="text-danger" @click.prevent="deleted(order.id)">
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
                    <pagination :pagination="orderNoSent" :callback="getResults" :size="'small'">

                    </pagination>
                </div>
            </div>
        </div>
        <div v-if="showSent" class="d-flex col-12 text-center justify-content-center">
            <div class="col-12">
                <table class="table">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">PRODUCT</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">USER</th>
                        <th scope="col">PONE/EMAIL</th>
                        <th scope="col">ADDRESS</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">DELETE</th>
                    </tr>
                    </thead>

                    <tbody>

                    <template v-for="(order, key) in orderSent.data" v-bind:key="key">
                        <tr>
                            <td>{{ key + 1 }}</td>
                            <td>{{ order.product.title }}</td>
                            <td>{{ order.product.category.title }}</td>
                            <td>{{ order.quantity }}</td>
                            <td>{{ order.price * order.quantity }}</td>
                            <td>{{ order.order.user_id ? order.order.user.name : '' }}</td>
                            <td><p
                                v-html="order.order.user_id ? order.order.user.pone+'<br>'+order.order.user.email : ''"></p>
                            </td>
                            <td><p v-html="fullAddress(order.order)"></p></td>
                            <td>{{ order.status }}</td>
                            <td>
                                <a class="text-danger" @click.prevent="deleted(order.id)">
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
                    <pagination :pagination="orderSent" :callback="getResults" :size="'small'">

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
    name: "OrdersViews",

    components: {
        Pagination: PaginationComponent,
    },

    data() {
        return {
            orderSent: {},
            orderNoSent: [],


            showSent: false,
            showNoSent: true,
            url: this.$store.state.URL + '/api/admin/orders'
        }
    },
    methods: {
        fullAddress(order) {
            let address = 'Edge: ' + order.city.edge.name;
            if (order.city.region_id) {
                address += '<br> Region: ' + order.city.region.name;
            }
            address += '<br> City: ' + order.city.name + '<br> Address: ' + order.address;
            return address
        },

        sent(id) {
            api.post(this.url + '/' + id)
                .then((r)=>{
                    console.log(r);
                    this.query();
                })
                .catch(e=>{
                    console.log(e);
                })
        },

        deleted(id){
            api.post(this.url + '/' + id)
                .then((r)=>{
                    console.log(r);
                    this.query();
                })
                .catch(e=>{
                    console.log(e);
                })
        },

        query() {
            api.get(this.url)
                .then((r) => {
                    console.log(r);
                    this.orderNoSent = r.data.orderNoSent;
                    this.orderSent = r.data.orderSent;
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
                    this.orderNoSent = r.data.orderNoSent;
                    this.orderSent = r.data.orderSent;
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
