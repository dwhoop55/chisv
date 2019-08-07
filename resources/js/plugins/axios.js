import axios from 'axios'
import { vm } from '@/app.js'

let token = document.head.querySelector('meta[name="csrf-token"]')

if (!token) {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}


const instance = axios.create({
    baseURL: '/api/v1/',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': token.content
    },
})

// Add a response interceptor
instance.interceptors.response.use(
    response => {

        return response;
    },
    error => {

        if (error.response.status === 401) {
            vm.$router.push({ name: 'auth.login' });
            // } else if (error.response.status === 422) {
            //     if (error.response.data.errors) {
            //         for (let key in error.response.data.errors) {
            //             vm.$validator.errors.add({ field: key, msg: error.response.data.errors[key] })
            //         }
            //     }
        } else {
            console.error(error)
        }

        return Promise.reject(error);
    })

export default instance