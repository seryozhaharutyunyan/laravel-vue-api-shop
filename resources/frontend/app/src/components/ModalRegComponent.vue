<template>
    <div class="modal-backdrop">
        <div class="modal">
            <header class="modal-header">
                <h2>Registration</h2>
                <button type="button" class="btn-close me-4" @click="close"><strong>X</strong></button>
            </header>

            <div class="d-flex col-12 flex-row text-center justify-content-center">
                <div v-if="success" class="m-3 p-3 col-10 col-sm-6">
                    <span class="display-6">{{ success }}</span>

                </div>
                <div v-else class="m-3 p-3 col-10 col-sm-6">
                    <input type="text" class="form-control m-3 mb-0  p-3" name="name" v-model.trim="userData.name"
                           placeholder="Name">
                    <div class="text-danger text-start m-o ps-3">{{ err.name[0] }}</div>
                    <input type="text" class="form-control m-3 mb-0  p-3" name="last_name"
                           v-model.trim="userData.last_name"
                           placeholder="Last name">
                    <div class="text-danger text-start m-o ps-3">{{ err.last_name[0] }}</div>
                    <input type="email" class="form-control m-3 mb-0  p-3" name="email" v-model.trim="userData.email"
                           placeholder="Email">
                    <div class="text-danger text-start m-o ps-3">{{ err.email[0] }}</div>
                    <input type="tel" class="form-control m-3 mb-0  p-3" name="pone" v-model.trim="userData.pone"
                           placeholder="Pone">
                    <div class="text-danger text-start m-o ps-3">{{ err.pone[0] }}</div>

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

                    <input type="date" class="form-control m-3 mb-0  p-3" v-model="userData.age"
                           max="2006-01-01">
                    <div class="text-danger text-start m-o ps-3">{{ err.age[0] }}</div>

                    <div @click="removeImg()" class="col-3 m-auto btn">
                        <div v-show="image" class="form-control  mt-2 p-1">
                            <img :src="image">
                            <span class="text-danger">Remove image</span>
                        </div>
                    </div>

                    <input ref="image" id="formFile" type="file" class="form-control m-3 mb-0  p-3" accept="image/*"
                           @input="fileUpload($event)" placeholder="Image">
                    <div name="image" class="text-danger text-start m-o ps-3">{{ err.img[0] }}</div>


                    <div>
                        <label class="p-3">Gender</label><br>
                        <input class="form-check-input" type="radio" name="gender" v-model="userData.gender"
                               value="male">
                        <label class="form-check-label p-3 pt-0">Male</label><br>
                        <input class="form-check-input" type="radio" name="gender" v-model="userData.gender"
                               value="female">
                        <label class="form-check-label p-3 pt-0">Female</label>
                    </div>
                    <div class="text-danger text-start m-o ps-3">{{ err.gender[0] }}</div>
                    <button @click="registration()" class="btn btn-info m-3 p-3">
                        Registration
                    </button>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";

export default {
    name: "ModalRegComponent",

    data() {
        return {
            err: {
                name: [''],
                last_name: [''],
                email: [''],
                pone: [''],
                edge_id: [''],
                city_id: [''],
                address: [''],
                age: [''],
                gender: [''],
                img: [''],
            },
            userData: {
                name: '',
                last_name: '',
                email: '',
                pone: '',
                city_id: '',
                edge_id: '',
                address: '',
                age: '',
                gender: '',
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
            return this.$store.state.URL + '/api/registration'
        }
    },

    methods: {
        close() {
            this.$emit('close');
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

        removeImg(){
            this.image='';
            this.userData.img='';
            this.$refs.image.value='';
        },

        registration() {
            this.err = {
                name: [''],
                last_name: [''],
                email: [''],
                pone: [''],
                edge_id: [''],
                region_id: [''],
                city_id: [''],
                address: [''],
                age: [''],
                gender: [''],
                img: [''],
            }

            const data = new FormData();
            data.append('name', this.userData.name);
            data.append('last_name', this.userData.last_name);
            data.append('email', this.userData.email);
            data.append('pone', this.userData.pone);
            data.append('city_id', this.userData.city_id);
            data.append('edge_id', this.userData.edge_id);
            data.append('address', this.userData.address);
            data.append('img', this.userData.img);
            data.append('gender', this.userData.gender);
            data.append('age', this.userData.age);

            axios.post(this.url,
                data)
                .then((r) => {

                    this.userData = {
                        name: '',
                        last_name: '',
                        email: '',
                        pone: '',
                        city_id: '',
                        edge_id: '',
                        address: '',
                        age: '',
                        img: '',
                        gender: '',
                    };

                    this.success = r.data;
                })
                .catch((err) => {

                    if (err.response) {
                        this.err = Object.assign(this.err, err.response.data.errors);
                    }
                });

        },


        queryRegions(event) {
            let id = event.target.value;
            this.region_id = '';
            if (id) {
                axios.get(this.url + '/edge_regions/' + id)
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
                url += this.url + '/region_cities/' + id;
            } else if (this.userData.edge_id && !this.region_id) {
                url += this.url + '/edge_cities/' + this.userData.edge_id;
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

        query() {
            axios.get(this.url + '/edges')
                .then(r => {
                    this.edges = r.data
                })
                .catch(err => {
                    console.log(err);
                });
        },
    },

    created() {
        this.query();
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
