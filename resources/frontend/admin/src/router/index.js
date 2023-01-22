import {createRouter, createWebHistory} from 'vue-router'
import CategoriesView from "../views/CategoriesView";
import TagsView from "@/views/TagsView";
import HomeView from "@/views/HomeView";
import EdgesView from "@/views/EdgesView";
import RegionsView from "@/views/RegionsView";
import CitiesView from "@/views/CitiesView";
import UsersView from "@/views/UsersView";
import UserShowView from "@/views/UserShowView";
import ProductsView from "@/views/ProductsView";
import ProductShowView from "@/views/ProductShowView";
import LoginView from "@/views/LoginView";
import OrdersView from "@/views/OrdersView";


const routes = [
    {
        path: '/categories',
        name: 'categories',
        component: CategoriesView,

    },

    {
        path: '/tags',
        name: 'tags',
        component: TagsView,

    },

    {
        path: '/login',
        name: 'login',
        component: LoginView,
    },

    {
        path: '/edges',
        name: 'edges',
        component: EdgesView,
    },

    {
        path: '/regions',
        name: 'regions',
        component: RegionsView,
    },

    {
        path: '/cities',
        name: 'cities',
        component: CitiesView,
    },

    {
        path: '/users',
        name: 'users',
        component: UsersView,
    },

    {
        path: '/user_show/:id',
        name: 'user_show',
        component: UserShowView,
    },

    {
        path: '/products',
        name: 'products',
        component: ProductsView,
    },

    {
        path: '/product_show/:id',
        name: 'product_show',
        component: ProductShowView,
    },

    {
        path: '/orders',
        name: 'orders',
        component: OrdersView,
    },

    {
        path: '/',
        name: 'home',
        component: HomeView
    },

    {
        path: "/:pathMatch(.*)*",
        redirect: '/'
    },

]

const router = createRouter({
    history: createWebHistory("/admin/"),
    routes,
});

router.beforeEach((to) => {
    const token = sessionStorage.getItem('token');
    if (to.name !== 'login') {
        if (!token) {
            return {
                name: 'login'
            };
        }
    }

    if (to.name === 'login') {
        if (token) {
            return {
                name: 'home'
            };
        }
    }

});

export default router
