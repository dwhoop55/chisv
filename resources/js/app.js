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
import moment from "moment-timezone";

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
        hoursFromTime(time) {
            var d = new moment(time, "HH:mm:ss");
            return d.format("HH:mm");
        },
        timeFromDecimal(decimal) {
            var n = new Date(0, 0);
            n.setSeconds(+decimal * 60 * 60);
            return n.toTimeString().slice(0, 8);
        },
        dateFromDecimal(decimal) {
            var n = new Date(0, 0);
            n.setSeconds(+decimal * 60 * 60);
            return n;
        },
        dateFromTime(time) {
            return new Date(`1970-01-01 ${time}`);
        },
        stringInObject: function (searchInput, object) {
            if (!object) return false;
            let search = searchInput.toLowerCase();
            var found = false;
            // We first get the keys of the object
            // to loop through them. When the key
            // is a string we compare it (and return true on match)
            // or recusively go into the object if the key
            // points to one and do matching there again
            var keys = Object.keys(object);
            keys.forEach(key => {
                // Only compare strings
                if (typeof object[key] === "string" || object[key] instanceof String) {
                    let value = object[key].toLowerCase();
                    if (value.indexOf(search) >= 0) {
                        // console.log("Found in " + key + " (" + value + ")");
                        found = true;
                    }
                }

                // Recursively go into the objects
                if (typeof object[key] === "object" || object[key] instanceof Object) {
                    if (this.stringInObject(searchInput, object[key])) found = true;
                }
            });

            return found;
        },
        filterStates: function (states, filter) {
            return states.filter((value, index) => {
                return value.for == filter;
            });
        },
        /**
         * 
         * @param {Object} jsonForm Form with object and key body which is a json-string
         */
        parseEnrollmentForm: function (jsonForm) {
            var vform = new Form();
            var meta = {};
            var header = null;
            var agreement = null;
            var name = jsonForm.name;
            var id = jsonForm.id;

            let body = JSON.parse(jsonForm.body);
            if (body.header) {
                header = body.header;
            }
            if (body.agreement) {
                agreement = body.agreement;
            }


            let fields = body.fields;
            vform['id'] = jsonForm.id;
            for (const [key, value] of Object.entries(fields)) {
                meta[key] = value;
                switch (value.type) {
                    case "boolean":
                        vform[key] = value.value ? value.value : false;
                        break;
                    case "string":
                        vform[key] = value.value ? value.value : "";
                        break;
                }
            }

            return { vform: vform, meta: meta, header: header, agreement: agreement, name: name, id: id };
        },
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
                    return "is-light";
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
                case "planned":
                    return "is-warning";
                    break;
                case "processing":
                    return "is-primary";
                    break;
                case "successful":
                    return "is-success";
                    break;
                case "failed":
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
        showJobsOverview: false,
    }
});