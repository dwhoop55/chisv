window.axios = require("axios");
import { NotificationProgrammatic as Notification } from 'buefy';
import store from "@/store"

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["Content-Type"] = "application/json";
window.axios.defaults.baseURL = "/api/v1/"
window.axios.defaults.timeout = 10000;

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}


// Response interceptor
window.axios.interceptors.response.use(response => response, error => {
    var type = "is-warning";
    var method = error.config.method;
    var verb = "create";
    if (method == 'delete') {
        verb = "delete";
    } else if (method == 'put') {
        verb = 'update';
    } else if (method == 'get') {
        verb = 'load';
    }

    if (error.response) {
        const { status } = error.response
        // The request was made and the server responded with a status code
        // that falls out of the range of 2xx
        var message = error
        if (status >= 500 || status === 400) {
            // Server (likely PHP error)
            if (error.response.data.message) {
                message = error.response.data.message;
            }
            type = 'is-danger';
        } else if (status === 401 && !store.getters['auth/user']) {
            console.log(401, 'Not logged in', error);
            return Promise.reject(error)
        } else if (status === 403) {
            console.log(403, "No permission to ressource", error);
            return Promise.reject(error)
        } else if (status === 404) {
            console.log(404, "Not found", error);
            return Promise.reject(error)
        } else if (status == 422) {
            // Validation error
            message = error.response.data.message
                ? error.response.data.message
                : error.message;
            message += (error.response.data?.errors) ? '<br>' : '';
            for (const [key, value] of Object.entries(error.response.data?.errors)) {
                message += `<br>${key}: ${value}`
            }
        } else if (status === 429) {
            message = "To many requests. Slow down.";
        }

        Notification.open({
            duration: 10000,
            message: `Couldn't ${verb}: ${message}`,
            type,
            hasIcon: true
        });
        // console.log(error.response.data);
        // console.log(error.response.status);
        // console.log(error.response.headers);
    } else if (error.request) {
        // The request was made but no response was received
        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
        // http.ClientRequest in node.js
        if (error.response?.status === 408 || error.code === 'ECONNABORTED') {
            Notification.open({
                duration: 10000,
                message: `Couldn't ${verb}: Timeout happened on url ${error.config.url}`,
                type: 'is-warning',
                hasIcon: true
            });
        }
        // console.log(error.request);
    } else {
        // Something happened in setting up the request that triggered an Error
        console.log('Error', error.message);
    }
    // console.log(error.config);


    return Promise.reject(error)
})