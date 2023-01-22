import axios from "axios";

const api = axios.create();
api.interceptors.request.use(
    (config) => {
        if (sessionStorage.getItem('token')) {
            config.headers.authorization = `Bearer ${sessionStorage.getItem('token')}`;
        }

        return config;
    },
    (error) => {
        console.log(error)
    });

api.interceptors.response.use(
    (response)=>{
        return response;
    },
    async (error) => {

        if (error.response.data.message === 'Token has expired') {
            return axios.post('http://api.loc/api/auth/refresh',{},{
                headers:{
                    authorization: `Bearer ${sessionStorage.getItem('token')}`
                }
            }).then(r => {
                    sessionStorage.setItem('token', r.data.authorisation.token);

                    error.config.headers.authorization = `Bearer ${sessionStorage.getItem('token')}`
                    return api.request(error.config);
                });
        }else{
            return error;
        }
    })

export default api;
