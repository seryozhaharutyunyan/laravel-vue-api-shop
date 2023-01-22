<template>
    <div class="col-12 p-1">
        <div v-if="!user.name">
            <input class="form-control mt-2" v-model="user.name" placeholder="Name">
            <div class="text-danger text-start m-o ps-1">{{ err.name[0] }}</div>
            <input class="form-control mt-2" v-model="user.email" placeholder="Email">
            <div class="text-danger text-start m-o ps-1">{{ err.email[0] }}</div>
        </div>
        <div v-else>
            <div class="p-3"><h4>Name: {{ user.name }}</h4></div>
            <div class="p-3"><h4>Email: {{ user.email }}</h4></div>
        </div>


        <div class="d-block form-control h-i h-v mt-2 p-1">
            <editor toolbar="essential" v-model:content="message" contentType="html" theme="snow"
                    placeholder="Message" class="col-12  h-50">

            </editor>
        </div>
        <div class="text-danger text-start m-o ps-1">{{ err.message[0] }}</div>
        <div class="col-11 m-3 text-center">
            <button class="btn btn-light" @click="send">Send</button>
        </div>
    </div>
</template>

<script>
import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import api from "../../api";
import axios from "axios";

export default {
    name: "FeedbackComponent",

    components: {
        Editor: QuillEditor,
    },

    data() {
        return {
            message: '',
            err: {
                name: [''],
                email: [''],
                message: [''],
            },
            user: {
                name: '',
                email: '',
            }
        }
    },

    computed: {
        url() {
            return this.$store.getters.getUrl + '/api/';
        },
    },

    methods: {
        send() {
            const data = {
                name: this.user.name,
                email: this.user.email,
                message: this.message,
            }
            axios.post(this.url + 'feedback', data)
                .then(() => {
                    this.message='';
                    this.$router.go(0);
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
                    })
                    .catch(e => {
                        console.log(e);
                    });
            } else {
                this.user = {
                    name: '',
                    email: '',
                }
            }

        },
    },

    watch: {
        '$store.state.auth'() {
            this.getUser()
        }
    },

    created() {
        this.getUser();
    }
}
</script>

<style scoped>
.h-i {
    height: 200px;
}

</style>
