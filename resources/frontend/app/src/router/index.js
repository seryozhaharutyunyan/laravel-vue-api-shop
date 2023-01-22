import {createRouter, createWebHistory} from 'vue-router';
import HomeView from '../views/HomeView.vue';
import ShowProductsView from "@/views/ShowProductsView";
import InfoView from "@/views/InfoView";
import ShowProductView from "@/views/ShowProductView";
import BasketView from "@/views/BasketView";


const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },

    {
        path: '/showProducts/:id',
        name: 'showProducts',
        component: ShowProductsView,
    },



    {
        path: '/showProduct/:id',
        name: 'showProduct',
        component: ShowProductView,
    },

    {
        path: '/basket',
        name: 'basket',
        component: BasketView,
    },

    {
        path: '/info',
        name: 'info',
        component: InfoView,
    },

    {
        path: "/:pathMatch(.*)*",
        redirect: '/'
    },

]

const router = createRouter({
    history: createWebHistory("/"),
    routes
})

export default router
