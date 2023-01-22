<template>
    <div class="modal-backdrop">
        <div class="modal">
            <header class="modal-header">
                <h2>Authentication</h2>
                <button type="button" class="btn-close display-6 me-4" @click="close"><strong>X</strong></button>
            </header>

            <div v-if="show" class="d-flex col-12 flex-row text-center justify-content-center">
                <div class="m-3 p-3 col-10 col-sm-6">
                    <div :v-show="err" class="col-12 text-center text-danger">{{ err }}</div>
                    <input type="email" class="form-control p-3 mt-3" v-model="email" placeholder="Email">
                    <input type="password" class="form-control p-3 mt-3" v-model="password" placeholder="Password">
                    <div class="p-3 ">
                        <button class="btn btn-info p-3 m-3" @click="login()">Login</button>
                        <button class="btn btn-info p-3 m-3" @click="show=!show">Reset password</button>
                    </div>


                </div>
            </div>

            <div v-else class="d-flex col-12 flex-row text-center justify-content-center">
                <div class="m-3 p-3 col-10 col-sm-6">
                    <div v-if="success">
                        <span class="display-6">{{ success }}</span>
                        <div class="p-3 ">
                            <button class="btn btn-info p-3 m-3" @click="show=!show">Close</button>
                        </div>
                    </div>
                    <div v-else>
                        <input type="email" class="form-control p-3 mt-3" v-model="email" placeholder="Email">
                        <div class="text-danger">{{ emailErr }}</div>
                        <div class="col-3 m-3 p-3 bg-light">{{ captcha }}</div>
                        <input type="text" class="form-control p-3 mt-3" v-model="newCaptcha" placeholder="Captcha">
                        <div class="text-danger">{{ errCaptcha }}</div>
                        <div class="p-3 ">
                            <button class="btn btn-info p-3 m-3" @click="reset()">Reset password</button>
                            <button class="btn btn-info p-3 m-3" @click="show=!show">Close</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import api from "../../api";

export default {
    name: "ModalAutComponent",

    data() {
        return {
            email: '',
            password: '',
            show: true,
            captcha: '',
            newCaptcha: '',
            errCaptcha: '',
            success: '',
            emailErr: '',
            err: '',
            products: {},
        }
    },

    computed: {
        url() {
            return this.$store.state.URL + '/api/'
        }
    },

    methods: {

        getProducts() {
            if (localStorage.getItem('basket')) {
                this.products = JSON.parse(localStorage.getItem('basket'));
            }
        },

        getCount() {

            api.get(this.url + 'orders/count')
                .then(r => {
                    localStorage.clear()
                    localStorage.setItem('count', r.data);
                    this.$store.dispatch('setCount');
                    this.$router.push({name: 'home'});
                    this.close();
                })
                .catch(e => {
                    console.log(e)
                })
        },

        setOrder(product, user) {
            const data = {
                product_id: product.id,
                quantity: product.quantity,
                price: product.price,
                city_id: user.city_id,
                address: user.address,
                region_id: user.region_id,
            };
            api.post(this.url + 'orders/auth', data)
                .then(() => {
                    this.deleted(product.id);
                    this.getProducts();

                })
                .catch(err => {
                    console.log(err)
                });
        },

        deleted(id) {
            let data = JSON.parse(localStorage.getItem('basket'));

            let newData = data.filter((item) => {
                return item.id !== id;

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
            this.getProducts();
        },

        close() {
            this.$emit('close');
        },

        login() {
            const data = {
                email: this.email,
                password: this.password,
            }

            axios.post(this.url + 'auth/login', data)
                .then(r => {
                    sessionStorage.setItem('token', r.data.authorisation.token);
                    this.$store.dispatch('setAuth');
                    this.$store.dispatch('setUser');
                    if (localStorage.getItem('basket')) {
                        this.products.forEach(item => {
                            this.setOrder(item);
                        });
                    }

                    this.getCount();

                })
                .catch((e) => {
                    console.log(e);
                    if(e.response.data==='You are blocked'){
                        this.err = 'You are blocked';
                    }else{
                        this.err = 'Wrong email or password';
                    }

                });
        },

        reset() {
            if (this.captcha === this.newCaptcha) {
                this.errCaptcha = '';
                this.emailErr = '';
                axios.post(this.url + 'registration/reset_password', {
                    email: this.email,
                })
                    .then(() => {
                        this.success = 'Your password has been sent to your email address';
                    })
                    .catch(err => {
                        if (err.response) {
                            this.emailErr = err.response.data.errors.email[0];
                        }
                    });
            } else {
                this.captcha = '';
                this.newCaptcha = '';
                this.emailErr = '';
                this.errCaptcha = 'Not correct captcha!!!!';
                this.getCaptcha();
            }
        },

        setCaptcha() {
            let result = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for (let i = 0; i < 7; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        },

        getCaptcha() {
            this.captcha = this.setCaptcha();
        }
    },

    created() {
        this.getCaptcha();
        this.getProducts();
    }
}
</script>

<style scoped>
.modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #DCDCDC;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal {
    background-color: #DCDCDC;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
}

.modal-header {
    padding: 15px;
    display: flex;
}

.modal-header {
    border-bottom: 3px solid #696969;
    color: #4AAE9B;
    justify-content: space-between;
}


.btn-close {
    border: none;
    font-size: 40px;
    padding: 0;
    cursor: pointer;
    font-weight: bold;
    color: #4AAE9B;
    background: transparent;
}
</style>
