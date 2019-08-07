/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require("./bootstrap");
require("@/mixins");
window.debounce = require("lodash/debounce");
window.axios = require("@/plugins/axios.js")

import Vue from "vue";
import Buefy from "buefy";
import VueRouter from 'vue-router'

import routes from '@/config/routes.js'
import store from "./store";

import App from "@/App.vue";

import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(Form.name, Form)

//Load Plugins
Vue.use(Buefy)
Vue.use(VueRouter)

//Router configuration
const router = new VueRouter({
    mode: 'history',
    routes
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

export const vm = new Vue({
    el: '#app',
    render: h => h(App),
    router,
    store
});

store.dispatch('fetchUser');
