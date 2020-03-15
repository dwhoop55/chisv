/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./helpers");

window.axios = require("axios");

import Vue from "vue";
import Buefy from "buefy";
import { Form, HasError, AlertError } from 'vform'
import VueMoment from 'vue-moment'
import VueDOMPurifyHTML from 'vue-dompurify-html'
import moment from "moment-timezone";
import JsonCSV from 'vue-json-csv';
import vueDebounce from 'vue-debounce';
import { VueCsvImport } from 'vue-csv-import';
import VueShowdown from 'vue-showdown'
import { mapActions } from 'vuex';

import store from './store';
import router from './router';
import { methods as mixins } from './mixins';

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["Content-Type"] = "application/json";
window.axios.defaults.baseURL = "/api/v1/"
window.axios.defaults.timeout = 60000;
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo'
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(Form.name, Form)
Vue.component('csv-export', JsonCSV)
Vue.component('csv-import', VueCsvImport)

Vue.use(Buefy, { defaultNoticeQueue: false, defaultToastPosition: "is-top-right" });
Vue.use(VueMoment);
Vue.use(VueDOMPurifyHTML);
Vue.use(vueDebounce, { defaultTime: '250ms', listenTo: 'input' });
Vue.use(VueShowdown, {
    options: {
        emoji: true,
        flavor: 'github',
        strikethrough: true
    }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        files(key).default
    )
);

Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
})

Vue.filter('textlimit', function (text, limit, clamp = '...') {
    if (text) {
        return text.length > limit ? text.slice(0, limit) + clamp : text;
    }
})

Vue.mixin({ methods: mixins });

export const vm = new Vue({
    el: "#app",
    store,
    router,
    methods: {
        ...mapActions('auth', ['fetchUser']),
        ...mapActions('conferences', ['fetchConferences']),
        ...mapActions('defines', ['fetchStates', 'fetchRoles'])
    },
    created() {
        // This will load states as new for every page refresh
        this.fetchConferences();
        this.fetchUser();
        this.fetchStates();
        this.fetchRoles();
    }
});