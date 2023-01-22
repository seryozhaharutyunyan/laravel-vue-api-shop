<template>
    <div class="modal-backdrop">
        <div class="modal">
            <header class="modal-header">
                <h2>Registration</h2>
                <button type="button" class="btn-close me-4" @click="close"><strong>X</strong></button>
            </header>

            <div class="d-flex col-12 flex-row text-center justify-content-center ">
                <div v-if="success" class="row m-3 p-3 col-10 col-sm-6">
                    <span class="display-6">{{ success }}</span>
                </div>
            </div>
            <div class="d-flex col-12 flex-row text-center justify-content-center ">
                <button class="btn border-warning m-1" @click="showPassword">
                    Password
                    update
                </button>
                <button class="btn border-warning m-1" @click="showAccount">
                    Account
                    update
                </button>
            </div>
            <div v-if="passwordUpdate" class="d-flex col-12 flex-row text-center justify-content-center">
                <div class="m-3 p-3 col-10 col-sm-6">
                    <div class="col-3 m-auto btn">
                        <div class="form-control  mt-2 p-1">
                            <img :src="user.img">
                        </div>
                    </div>

                    <input :type="check ? 'text' : 'password'" class="form-control m-3 mb-0  p-3" name="name"
                           v-model.trim="userData.password"
                           placeholder="Yor password">
                    <div class="text-danger text-start m-o ps-3">{{ err.password[0] }}</div>
                    <div class="mt-2">
                        <label class="pe-2 text-dark" for="password">Show password </label>
                        <input id="password" type="checkbox" v-model="check">
                    </div>

                    <input :type="checkNew ? 'text' : 'password'" class="form-control m-3 mb-0  p-3" name="name"
                           v-model.trim="userData.passwordNew"
                           placeholder="New password">
                    <div class="text-danger text-start m-o ps-3">{{ err.passwordNew[0] }}</div>
                    <input :type="checkNew ? 'text' : 'password'" class="form-control m-3 mb-0  p-3" name="name"
                           v-model.trim="userData.passwordNew_confirmation"
                           placeholder="New password">
                    <div class="mt-2">
                        <label class="pe-2" for="passwordNew">Show password </label>
                        <input id="passwordNew" type="checkbox" v-model="checkNew">
                    </div>


                    <button @click="update()" class="btn btn-info m-3 p-3">
                        Update
                    </button>

                </div>
            </div>
            <div v-if="accountUpdate" class="d-flex col-12 flex-row text-center justify-content-center">

                <div class="m-3 p-3 col-10 col-sm-6">
                    <div class="col-3 m-auto btn">
                        <div class="form-control  mt-2 p-1">
                            <img :src="user.img">
                        </div>
                    </div>

                    <input :type="check ? 'text' : 'password'" class="form-control m-3 mb-0  p-3" name="name"
                           v-model.trim="userData.password"
                           placeholder="Yor password">
                    <div class="text-danger text-start m-o ps-3">{{ err.password[0] }}</div>
                    <div class="mt-2">
                        <label class="pe-2 text-dark" for="password">Show password </label>
                        <input id="password" type="checkbox" v-model="check">
                    </div>

                    <select v-model="userData.edge_id" class="form-select m-3 mb-0  p-3"
                            @change="queryRegions($event); queryCity($event)">
                        <option disabled value="">Edge</option>
                        <option v-for="(e, k) in edges" :value="e.id" :key="k">
                            {{ e.name }}
                        </option>
                    </select>
                    <div class="text-danger text-start m-o ps-3">{{ err.edge_id[0] }}</div>

                    <select v-if="regions" v-model="region_id" class="form-select m-3 mb-0  p-3"
                            @change="queryCity($event)">
                        <option value="">Region</option>
                        <option v-for="(r, k) in regions" :value="r.id" :key="k">
                            {{ r.name }}
                        </option>
                    </select>

                    <select v-if="cities" v-model="userData.city_id" class="form-select m-3 mb-0  p-3">
                        <option disabled value="">City</option>
                        <option v-for="(c, k) in cities" :value="c.id" :key="k">
                            {{ c.name }}
                        </option>
                    </select>
                    <div v-if="cities" class="text-danger text-start m-o ps-3">{{ err.city_id[0] }}</div>

                    <input type="text" class="form-control m-3 mb-0  p-3" name="address" v-model.trim="userData.address"
                           placeholder="Address">
                    <div class="text-danger text-start m-o ps-3">{{ err.address[0] }}</div>


                    <div @click="removeImg()" class="col-3 m-auto btn">
                        <div v-show="image" class="form-control  mt-2 p-1">
                            <img :src="image">
                            <span class="text-danger">Remove image</span>
                        </div>
                    </div>

                    <input ref="image" id="formFile" type="file" class="form-control m-3 mb-0  p-3" accept="image/*"
                           @input="fileUpload($event)" placeholder="Image">
                    <div name="image" class="text-danger text-start m-o ps-3">{{ err.img[0] }}</div>

                    <button @click="update()" class="btn btn-info m-3 p-3">
                        Update
                    </button>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";
import api from "../../api";

export default {
    name: "ModalRegComponent",

    data() {
        return {
            check: false,
            checkNew: false,
            passwordUpdate: false,
            accountUpdate: false,
            user: {},
            err: {
                password: [''],
                passwordNew: [''],
                passwordNew_confirmation: [''],
                edge_id: [''],
                city_id: [''],
                address: [''],
                img: [''],
            },
            userData: {
                password: '',
                passwordNew: '',
                passwordNew_confirmation: '',
                city_id: '',
                edge_id: '',
                address: '',
                img: '',

            },
            edges: {},
            regions: '',
            region_id: '',
            cities: '',
            success: '',
            image: '',
        }
    },

    computed: {
        url() {
            return this.$store.state.URL + '/api'
        }
    },

    methods: {
        close() {
            this.$emit('close');
        },

        showPassword() {
            this.err = {
                password: [''],
                passwordNew: [''],
                passwordNew_confirmation: [''],
                edge_id: [''],
                city_id: [''],
                address: [''],
                img: [''],
            };
            this.userData = {
                password: '',
                passwordNew: '',
                passwordNew_confirmation: '',
                city_id: '',
                edge_id: '',
                address: '',
                img: '',

            };

            this.passwordUpdate=!this.passwordUpdate;
            this.accountUpdate=false

        },

        showAccount() {
            this.err = {
                password: [''],
                passwordNew: [''],
                passwordNew_confirmation: [''],
                edge_id: [''],
                city_id: [''],
                address: [''],
                img: [''],
            };
            this.userData = {
                password: '',
                passwordNew: '',
                passwordNew_confirmation: '',
                city_id: '',
                edge_id: '',
                address: '',
                img: '',

            };

            this.accountUpdate=!this.accountUpdate;
            this.passwordUpdate=false
        },

        fileUpload(event) {
            this.userData.img = event.target.files[0];

            const reader = new FileReader();

            reader.addEventListener("load", function () {

                this.image = reader.result;

            }.bind(this), false);

            if (this.userData.img) {
                if (this.userData.img.name) {
                    reader.readAsDataURL(this.userData.img);
                }
            }
        },

        removeImg() {
            this.image = '';
            this.userData.img = '';
            this.$refs.image.value = '';
        },

        update() {
            this.err = {
                password: [''],
                passwordNew: [''],
                passwordNew_confirmation: [''],
                edge_id: [''],
                region_id: [''],
                city_id: [''],
                address: [''],
                img: [''],
            }
            let url = '';
            const data = new FormData();

            if (this.passwordUpdate) {
                data.append('password', this.userData.password);
                data.append('passwordNew', this.userData.passwordNew);
                data.append('passwordNew_confirmation', this.userData.passwordNew_confirmation);
                url = this.url + '/registration/password';
            } else if (this.accountUpdate) {
                data.append('password', this.userData.password);
                data.append('city_id', this.userData.city_id);
                data.append('edge_id', this.userData.edge_id);
                data.append('address', this.userData.address);
                data.append('img', this.userData.img);
                url = this.url + '/registration/account';
            } else {
                return;
            }

            axios.post(url,
                data,
                {
                    headers: {
                        authorization: `Bearer ${sessionStorage.getItem('token')}`
                    }
                })
                .then(() => {
                    this.userData = {
                        password: '',
                        passwordNew: '',
                        passwordNew_confirmation: '',
                        city_id: '',
                        edge_id: '',
                        address: '',
                        img: '',
                    };

                    this.getUser();
                    this.passwordUpdate=false;
                    this.accountUpdate=false;

                    this.success = 'You successfully upgraded';
                })
                .catch((err) => {
                    if (err.response) {
                        this.err = Object.assign(this.err, err.response.data.errors);
                        this.removeImg();
                    }
                });

        },


        queryRegions(event) {
            let id = event.target.value;
            this.region_id = '';
            if (id) {
                axios.get(this.url + '/registration/edge_regions/' + id)
                    .then(r => {
                        this.regions = r.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        },

        queryCity(event) {
            let id = event.target.value;
            let url = ''
            if (this.region_id && id) {
                url += this.url + '/registration/region_cities/' + id;
            } else if (this.userData.edge_id && !this.region_id) {
                url += this.url + '/registration/edge_cities/' + this.userData.edge_id;
            } else {
                return false;
            }
            axios.get(url)
                .then(r => {
                    this.cities = r.data;
                })
                .catch(err => {
                    console.log(err)
                })
        },

        queryEdges() {
            axios.get(this.url + '/registration/edges')
                .then(r => {
                    this.edges = r.data
                })
                .catch(err => {
                    console.log(err);
                });
        },

        getUser() {
            if (sessionStorage.getItem('token')) {
                api.post(this.url + '/auth/me')
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
        this.queryEdges();
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


.btn-close {
    border: none;
    font-size: 40px;
    padding: 0;
    cursor: pointer;
    font-weight: bold;
    color: #4AAE9B;
    background: transparent;
}

img {
    border-radius: 5px;
    width: 100%;
    max-height: 170px;
}
</style>
