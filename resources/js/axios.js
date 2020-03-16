window.axios = require("axios");
import { NotificationProgrammatic as Notification } from 'buefy';

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["Content-Type"] = "application/json";
window.axios.defaults.baseURL = "/api/v1/"
window.axios.defaults.timeout = 5000;

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
    const { status } = error.response

    if (status >= 500) {
        Notification.open({
            duration: 5000,
            message: `Could not save. ${error}`,
            type: 'is-danger',
            hasIcon: true
        });
    } else if (status == 422) {
        var message = error.response.data?.message;
        message += (error.response.data?.errors) ? '<br>' : '';
        for (const [key, value] of Object.entries(error.response.data?.errors)) {
            message += `<br>${key}: ${value}`
        }
        Notification.open({
            duration: 10000,
            message,
            type: 'is-danger',
            hasIcon: true
        });
    }

    if (status === 401) {
        document.location = '/login';
    }

    return Promise.reject(error)
})