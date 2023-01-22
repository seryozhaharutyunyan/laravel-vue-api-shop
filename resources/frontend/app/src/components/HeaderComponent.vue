<template>
    <header class="row">
        <div class="col-sm-7 col-12 ">
            <h1 class="p-1 text-lg-start text-center">MYAPI.LOC</h1>
        </div>
        <div class="col-sm-4 col-12 ms-auto me-3">
            <nav class="navbar navbar-expand-lg navbar-expand navbar-light">
                <ul class="navbar-nav ms-1 ms-lg-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                 class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                <path
                                    d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu bg-stat" aria-labelledby="navbarDropdownMenuLink">
                            <template v-if="!this.$store.getters.getAuth">
                                <li>
                                    <a class="dropdown-item" @click.prevent="showAut=!showAut">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                            <path fill-rule="evenodd"
                                                  d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" @click.prevent="showReg=!showReg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-person-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                            <path fill-rule="evenodd"
                                                  d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                    </a>
                                </li>
                            </template>
                            <template v-else>
                                <li>
                                    <a class="dropdown-item" @click.prevent="showAccount=!showAccount">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" @click.prevent="logout()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                            <path fill-rule="evenodd"
                                                  d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                        </svg>
                                    </a>
                                </li>
                            </template>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'basket'}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                 class="bi bi-basket" viewBox="0 0 16 16">
                                <path
                                    d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            <span class="text-danger"><strong>{{ this.$store.getters.getCount }}</strong></span>
                        </router-link>
                    </li>
                </ul>


            </nav>
        </div>
        <aut v-if="showAut" @close="closeAut"/>
        <reg v-if="showReg" @close="closeReg"/>
        <account v-if="showAccount" @close="closeAccount"/>


    </header>
</template>

<script>
import ModalRegComponent from "@/components/ModalRegComponent";
import ModalAutComponent from "@/components/ModalAutComponent";
import ModalAccountComponent from "@/components/ModalAccountComponent";
//import axios from "axios";
import api from "../../api";

export default {
    name: "HeaderComponent",
    data() {
        return {
            showReg: false,
            showAut: false,
            showAccount: false,
            auth: false,
        }
    },

    components: {
        reg: ModalRegComponent,
        aut: ModalAutComponent,
        account: ModalAccountComponent
    },

    computed: {
        url() {
            return this.$store.state.URL + '/api/'
        }
    },

    methods: {

        logout() {
            api.post(this.url + 'auth/logout')
                .then(() => {
                    sessionStorage.clear();
                    this.$store.dispatch('setAuth');
                    this.$store.dispatch('setUser');
                    localStorage.clear();
                    this.$store.dispatch('setCount');
                    this.$router.push({name: 'home'})
                })
                .catch(e => {
                    console.log(e)
                })
        },

        closeReg() {
            this.showReg = false;
            this.showAut = false;
        },

        closeAccount() {
            this.showAccount = false;
        },

        closeAut() {
            this.showReg = false;
            this.showAut = false;
        },

    },


}
</script>

<style scoped>
header {
    min-height: 6rem;
    width: 100%;
    margin: 0;
    padding: 0;
    background-color: #708090;
}

nav {
    font-size: 1.5rem;
    background-color: #708090;
}

.bg-stat {
    background-color: #708090;
}
</style>
