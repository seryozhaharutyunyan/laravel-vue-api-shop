<template>
    <header class="row">
        <div class="col-6 text-start pt-3 px-5">
            <router-link to="/">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd"
                              d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    MYAPI
                </h1>
            </router-link>
        </div>
        <div class="col-6 text-end pt-3">
            <a @click.prevent="showAccount=true">
                <span class="pt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-person-square" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                    </svg>
                </span>
            </a>
            <a @click.prevent="logout()">
                <span class="p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                        <path fill-rule="evenodd"
                              d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>
                </span>
            </a>
        </div>
        <account v-if="showAccount" @close="closeAccount"/>
    </header>
</template>

<script>
import api from "../../api";
import ModalAccountComponent from "@/components/ModalAccountComponent";

export default {
    name: "HeaderComponent",

    components:{
        account: ModalAccountComponent,
    },

    data(){
      return {
          showAccount: false,
      }
    },

    computed: {
        url() {
            return this.$store.state.URL + '/api/'
        }
    },

    methods: {
        logout() {
            api.post(this.url + 'auth/logout')
                .then(()=>{
                    sessionStorage.clear();
                    this.$router.push({
                        name: 'login',
                    })
                })
                .catch(e => {
                    console.log(e)
                })
        },

        closeAccount() {
            this.showAccount = false;
        },
    }
}
</script>

<style scoped>
header {
    background-color: darkcyan;
    height: 85px;
    color: antiquewhite;
}

a {
    color: antiquewhite;
    text-decoration: none;
}

a:hover {
    color: antiquewhite;
}

.active {
    color: dimgray;
}
</style>
