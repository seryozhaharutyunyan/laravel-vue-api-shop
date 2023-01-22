<template>
    <nav class="col-2 flex-nowrap col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark h-auto">
        <div
            class="d-flex col-12 justify-content-center flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <ul class="text-center nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                id="menu">
                <li class="nav-item pt-3">
                    <router-link :to="{name: 'categories'}" active-class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-card-list" viewBox="0 0 16 16">
                            <path
                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                        </svg>
                        <span class="ms-1 d-none d-sm-inline"> Categories</span>
                    </router-link>
                </li>
                <li class="nav-item pt-3">
                    <router-link :to="{name: 'tags'}" active-class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-tags-fill" viewBox="0 0 16 16">
                            <path
                                d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                            <path
                                d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"/>
                        </svg>
                        <span class="ms-1 d-none d-sm-inline"> Tags</span>
                    </router-link>
                </li>
                <li class="nav-item pt-3">
                    <router-link :to="{name: 'edges'}" active-class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-egg-fried" viewBox="0 0 16 16">
                            <path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path
                                d="M13.997 5.17a5 5 0 0 0-8.101-4.09A5 5 0 0 0 1.28 9.342a5 5 0 0 0 8.336 5.109 3.5 3.5 0 0 0 5.201-4.065 3.001 3.001 0 0 0-.822-5.216zm-1-.034a1 1 0 0 0 .668.977 2.001 2.001 0 0 1 .547 3.478 1 1 0 0 0-.341 1.113 2.5 2.5 0 0 1-3.715 2.905 1 1 0 0 0-1.262.152 4 4 0 0 1-6.67-4.087 1 1 0 0 0-.2-1 4 4 0 0 1 3.693-6.61 1 1 0 0 0 .8-.2 4 4 0 0 1 6.48 3.273z"/>
                        </svg>
                        <span class="ms-1 d-none d-sm-inline"> Edges</span>
                    </router-link>
                </li>
                <li class="nav-item pt-3">
                    <router-link :to="{name: 'regions'}" active-class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-r-square-fill" viewBox="0 0 16 16">
                            <path
                                d="M6.835 5.092v2.777h1.549c.995 0 1.573-.463 1.573-1.36 0-.913-.596-1.417-1.537-1.417H6.835Z"/>
                            <path
                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm3.5 4.002h3.11c1.71 0 2.741.973 2.741 2.46 0 1.138-.667 1.94-1.495 2.24L11.5 12H9.98L8.52 8.924H6.836V12H5.5V4.002Z"/>
                        </svg>
                        <span class="ms-1 d-none d-sm-inline"> Regions</span>
                    </router-link>
                </li>
                <li class="nav-item pt-3">
                    <router-link :to="{name: 'cities'}" active-class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-building" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                            <path
                                d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                        </svg>
                        <span class="ms-1 d-none d-sm-inline"> Cities</span>
                    </router-link>
                </li>
                <li v-if="admin()" class="nav-item pt-3">
                    <router-link :to="{name: 'users'}" active-class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd"
                                  d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                        </svg>
                        <span class="ms-1 d-none d-sm-inline"> Users</span>
                    </router-link>
                </li>
                <li class="nav-item pt-3">
                    <router-link :to="{name: 'products'}" active-class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-cart-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <span class="ms-1 d-none d-sm-inline"> Products</span>
                    </router-link>
                </li>
                <li class="nav-item pt-3">
                    <router-link :to="{name: 'orders'}" active-class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-list-ul" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                        <span class="ms-1 d-none d-sm-inline"> Orders</span>
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>

</template>

<script>
import api from "../../api";

export default {
    name: "NavComponent",

    data() {
        return {
            user: {},
            url: this.$store.state.URL + '/api/'
        }
    },

    methods: {
        admin() {
            if (this.user.role_id === 1) {
                return true;
            } else {
                return false;
            }
        },

        getUser() {

            if (sessionStorage.getItem('token')) {
                api.post(this.url + 'auth/me')
                    .then(r => {
                        console.log(r);
                        this.user = r.data;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            } else {
                this.user = {};
            }

        },
    },

    created() {
        this.getUser();
    }
}
</script>

<style scoped>

nav {
    font-size: xx-large;
}

a {
    color: antiquewhite;
    text-decoration: none;
}

a:hover {
    color: antiquewhite;
}
</style>
