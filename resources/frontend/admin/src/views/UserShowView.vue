<template>
    <div class="col-9">
        <div class="m-3 col-12 mt-5 p-3 user d-flex">
            <div class="col-3">
                <img :src="user.img" class="m-4">
            </div>
            <div class="col-9 p-3">
                <span><h2>User name:</h2> <i>{{ fullName }}</i></span><br>
                <span><h2>User email:</h2> <i>{{ user.email }}</i></span><br>
                <span><h2>User pone:</h2> <i>{{ user.pone }}</i></span><br>
                <span><h2>User address:</h2> <i>{{ address }}</i></span><br>
                <span><h2>User role:</h2> <i>{{ user.role.role }}</i></span><br>
            </div>
        </div>

    </div>
</template>

<script>
import api from "../../api";


export default {
    name: "UserShowView",

    data() {
        return {
            id: this.$route.params.id,
            user: {},
            url: this.$store.state.URL + '/api/admin/users/show',
        }
    },

    computed: {
        fullName() {
            return this.user.name + " " + this.user.last_name
        },

        address() {
            let region = '';
            if (this.user.city.region) {
                region += 'region:' + this.user.city.region.name
            }
            return this.user.address + ' city:'
                + this.user.city.name +
                ' ' + region
                + ' edge:' + this.user.city.edge.name;
        },
    },

    methods: {
        query() {
            api.get(this.url + '/' + this.id)
                .then(r => {
                    this.user = r.data;
                })
                .catch(err => {
                    console.log(err);
                })
        }
    },
    created() {
        this.query();
    },

}
</script>

<style scoped>
span {
    font-size: 24px;
}

.user {
    border: 1px solid #42b983;
    border-radius: 5px;
    background-color: #4a5568;
    color: #cbd5e0;
}

h2 {
    display: inline;
}
img{
    border-radius: 3px;
    height: 190px;
    width: 90%
}
</style>
