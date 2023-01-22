import {createStore} from 'vuex'
import api from "../../api";

export default createStore({
    state: {
        URL: "http://api.loc",
        user: {},
    },
    getters: {
        getUser(state) {
            return state.user;
        },
    },
    mutations: {
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
                state.auth=false;
            }

        }
    },
    actions: {
        setUser(context){
            context.commit('updateUser');
        }
    },
    modules: {}
})
