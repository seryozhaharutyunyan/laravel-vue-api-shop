import {createStore} from 'vuex'
import api from "../../api";
//import axios from "axios";

export default createStore({
    state: {
        URL: "http://api.loc",
        auth: false,
        user: {},
        count: localStorage.getItem('count') | 0,
    },
    getters: {
        getUrl(state) {
          return state.URL;
        },

        getCount(state){
            return state.count;
        },

        getAuth(state){
            return state.auth;
        },

        getUser(state) {
            return state.user;
        },

        getCategories(){
            return this.state.categories;
        }

    },
    mutations: {
        updateCount(state){
           state.count=localStorage.getItem('count') | 0;
        },

        updateAuth(state){
            if(sessionStorage.getItem('token')){
                state.auth=true;
            }else {
                state.auth=false;
            }

        },

        updateUser(state){
            if(sessionStorage.getItem('token')){
                api.post(state.URL+'/api/auth/me')
                    .then(r=>{
                        state.user=r.data;
                        state.auth=true;
                    })
                    .catch(e=>{
                        console.log(e);
                    });
            }else {
                state.user={};
                state.auth=false;
            }

        }
    },
    actions: {
        setCount(context){
            context.commit('updateCount');
        },

        setAuth(context){
            context.commit('updateAuth');
        },

        setUser(context){
            context.commit('updateUser');
        }
    },
    modules: {}
})
