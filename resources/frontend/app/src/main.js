import * as Vue from 'vue';
import App from './App.vue';
import './registerServiceWorker';
import router from './router';
import store from './store';
import VueAxios from "vue-axios";
import axios from "axios";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap"

const app=Vue.createApp(App);

app.use(VueAxios, axios)
    .use(store)
    .use(router)
    .mount('#app');
