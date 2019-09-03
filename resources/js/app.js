/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./helpers");
require("./bootstrap");

import Vue from "vue";
import Buefy from "buefy";
import { Form, HasError, AlertError } from 'vform'
import VueMoment from 'vue-moment'
import VueDOMPurifyHTML from 'vue-dompurify-html'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(Form.name, Form)

Vue.use(Buefy, { defaultNoticeQueue: false });
Vue.use(VueMoment);
Vue.use(VueDOMPurifyHTML);

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

Vue.mixin({
    methods: {
        conferenceArtworkBackground: function (conference) {
            if (conference && conference.artwork) {
                return `background-image:url(${conference.artwork.web_path})`;
            } else {
                return "background-image:url('/images/conference-default.jpg')";
            }
        },
        conferenceArtwork: function (conference) {
            if (conference.artwork && conference.artwork.web_path) {
                return conference.artwork.web_path;
            } else {
                return "/images/conference-default.jpg";
            }
        },
        conferenceIcon: function (conference) {
            if (conference.icon && conference.icon.web_path) {
                return conference.icon.web_path;
            } else {
                return `https://avatars.dicebear.com/v2/jdenticon/${conference.key}.svg?options[background]=%23f0f0f0`;
            }
        },
        userAvatar: function (user) {
            if (user.avatar && user.avatar.web_path) {
                return user.avatar.web_path;
            } else {
                return `https://avatars.dicebear.com/v2/jdenticon/${user.id}.svg`;
            }
        },
        goTo: function (path) {
            window.location.href = path;
        },
        goBack: function () {
            window.history.back();
        },
        stateType: function (state) {
            switch (state.name) {
                // states for users
                case "accepted":
                    return "is-success";
                    break;
                case "dropped":
                    return "is-danger";
                    break;
                case "enrolled":
                    return "is-success";
                    break;
                case "waitlisted":
                    return "is-warning";
                    break;
                // states for conferences
                case "planning":
                    return "is-danger";
                    break;
                case "enrollment":
                    return "is-warning";
                    break;
                case "registration":
                    return "is-warning";
                    break;
                case "running":
                    return "is-success";
                    break;
                case "over":
                    return "is-danger";
                    break;
            }
        },
        roleType: function (role) {
            if (role.name) {
                switch (role.name) {
                    case "sv":
                        return "is-light";
                        break;
                    case "chair":
                        return "is-dark";
                        break;
                    case "captain":
                        return "is-primary";
                        break;
                }
            }
        },
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

export const vm = new Vue({
    el: "#app",
    data: {
        showMobileNav: false,
    }
});