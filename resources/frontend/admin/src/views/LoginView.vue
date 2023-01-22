<template>
    <div class="modal-backdrop">
        <div class="modal">
            <header class="modal-header">
                <h2>Authentication</h2>
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

export default {
    name: "LoginView",

    data() {
        return {
            err: '',
            email: '',
            password: '',
            show: true,
            captcha: '',
            newCaptcha: '',
            errCaptcha: '',
            emailErr: '',
        }
    },

    computed: {
        url() {
            return this.$store.state.URL + '/api/'
        }
    },

    methods: {

        login() {
            const data = {
                email: this.email,
                password: this.password,
            }

            axios.post(this.url + 'auth/login', data)
                .then(r => {
                    this.err='';
                    let user = r.data.user;

                    if (user.role.role === 'admin' || user.role.role === 'moderator') {
                        sessionStorage.setItem('token', r.data.authorisation.token);
                        this.$store.state.auth = true;
                        this.$store.state.user = r.data.user
                        this.$router.push({name: 'home'})
                    } else {
                        this.err = 'You are not an administrator or moderator';
                    }


                })
                .catch((err) => {
                    console.log(err)
                    this.err = 'Wrong email or password'
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
                        console.log(err)
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
        this.getCaptcha()
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

</style>
