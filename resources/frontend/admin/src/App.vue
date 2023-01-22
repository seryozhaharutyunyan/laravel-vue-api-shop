<template>
    <header-component></header-component>
    <div class="row">

            <nav-component></nav-component>


            <router-view/>


    </div>

</template>

<script>
import HeaderComponent from "@/components/HeaderComponent";
import NavComponent from "@/components/NavComponent";

export default {
    name: 'app',
    components: {
        HeaderComponent,
        NavComponent,
    },

    computed: {
        url() {
            return this.$store.state.URL + '/api/'
        }
    },

    methods: {
        /*auth() {
            if (!sessionStorage.getItem('token')) {
                this.$router.push({name: 'login'})
            }
        }*/
    },

    created() {
        //this.auth();
    },


}
</script>

<style>
a {
    color: antiquewhite;
    text-decoration: none;
}

a:hover {
    color: antiquewhite;
}

</style>
