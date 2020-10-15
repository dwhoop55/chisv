require("./helpers");

import Vue from "vue";
import Buefy from "buefy";
import { Form, HasError, AlertError } from 'vform'
import JsonCSV from 'vue-json-csv';
import { VueCsvImport } from 'vue-csv-import';
import moment from "moment-timezone";
import vueDebounce from 'vue-debounce';
import VueShowdown from 'vue-showdown'
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'
import pluralize from 'pluralize'

import store from './store';
import router from './router';
import axios from './axios'
import { mapActions, mapGetters, mapMutations } from 'vuex';
import { methods as mixins } from './mixins';

import App from "./App.vue";
import Default from "./layouts/Default.vue";
import NoNav from "./layouts/NoNav.vue";

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
Vue.component('vue-cal', VueCal)
Vue.component("default-layout", Default);
Vue.component("no-nav-layout", NoNav);

Vue.use(Buefy, { defaultNoticeQueue: false, defaultToastPosition: "is-top-right" });
Vue.use(vueDebounce, { defaultTime: '250ms', listenTo: 'input' });
Vue.use(VueShowdown, {
    options: {
        emoji: true,
        flavor: 'github',
        strikethrough: true
    }
})

Vue.prototype.$moment = moment

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
});
Vue.filter('textlimit', function (text, limit, clamp = '...') {
    if (text) {
        return text.length > limit ? text.slice(0, limit) + clamp : text;
    }
});
Vue.filter('pluralize', function (number, value, prefix = true) {
    return pluralize(value, number, prefix);
});
Vue.filter('moment', function (value, format) {
    return moment(value).tz('UTC').format(format);
});
Vue.mixin({ methods: mixins });

export const vm = new Vue({
    el: "#app",
    store,
    router,
    render: h => h(App),
    computed: mapGetters('auth', ['userAcceptsCookies']),
    methods: {
        async refreshNotifications() {
            this.fetchNotifications();
            setTimeout(this.refreshNotifications, 30000);
        },
        ...mapMutations('auth', ['setUserAcceptsCookies']),
        ...mapActions('auth', ['fetchUser']),
        ...mapActions('conferences', ['fetchConferences']),
        ...mapActions('defines', ['fetchStates', 'fetchRoles', 'fetchLocales', 'fetchCountries', 'fetchTimezones', 'fetchShirts', 'fetchDegrees', 'fetchLanguages', 'fetchVersion']),
        ...mapActions('notifications', ['fetchNotifications', 'fetchNumberUnreadNotifications'])
    },

    created() {
        // This will load states as new for every page refresh
        this.fetchLocales();
        this.fetchShirts();
        this.fetchDegrees();
        this.fetchLanguages();
        this.fetchTimezones();
        this.fetchCountries();
        this.fetchUser()
            .then(() => {
                // Will resolve when a user could be fetched,
                // so we're logged in
                this.fetchConferences();
                this.fetchStates();
                this.fetchRoles();
                this.refreshNotifications();
                this.fetchVersion();

            })
            .catch((error) => (null));

        // Check if cookies have been accepted
        if (this.userAcceptsCookies === null) {
            this.$buefy.snackbar.open({
                message: 'This website uses cookies. See our privacy policy for more information',
                type: 'is-info',
                position: 'is-bottom-right',
                actionText: 'I accept cookies',
                indefinite: true,
                onAction: () => {
                    this.setUserAcceptsCookies(true);
                }
            })
        }
    }
});