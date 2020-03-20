import moment from "moment-timezone";
import Form from "vform";


export { methods }

let methods = {
    timeFormat(date, format, options = {}) {
        var locale = 'en_US';
        var timezone = 'UTC';
        if (options.tz && this.$store.getters['auth/usersTimezone']?.name) {
            timezone = this.$store.getters['auth/usersTimezone']?.name;
        }
        if (this.$store.getters['auth/usersLocale']?.code) {
            locale = this.$store.getters['auth/usersLocale']?.code
        }
        var m = new moment(date).tz(timezone).locale(locale);
        if (options.fromNow) {
            return m.fromNow(options.withoutSuffix ? true : false);
        }
        return m.format(format);
    },
    abilityString(ability, model, id = null, onModel = null, onId = null) {
        return `${ability},${model},${id},${onModel},${onId}`;
    },
    isEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    },
    dateFromMySql(string) {
        // regular expression split that creates array with: year, month, day, hour, minutes, seconds values
        let dateTimeParts = string.split(/[- :]/);
        // monthIndex begins with 0 for January and ends with 11 for December so we need to decrement by one
        dateTimeParts[1]--;
        return new Date(...dateTimeParts);
    },
    decimalFormat(decimal) {
        return parseFloat(parseFloat(decimal).toFixed(2));
    },
    hoursFromTime(time) {
        var d = new moment(time, "HH:mm:ss");
        return d.format("HH:mm");
    },
    decimalFromTime(time) {
        var hoursMinutes = time.split(/[:]/);
        var hours = parseInt(hoursMinutes[0], 10);
        var minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
        return hours + minutes / 60;
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
        return new Date(this.dateFromMySql(`1970-01-01 ${time}`));
        return new Date();
    },
    filterStates: function (states, filter) {
        return states.filter((value, index) => {
            return value.for == filter;
        });
    },
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
            return `https://avatars.dicebear.com/v2/jdenticon/${conference.key}.svg?options[background]=%23f0f0f0&options[radius]=10`;
        }
    },
    userAvatar: function (user) {
        if (user.avatar && user.avatar.web_path) {
            return user.avatar.web_path;
        } else {
            return `https://avatars.dicebear.com/v2/jdenticon/${user.id}.svg?options[radius]=25`;
        }
    },
    goTo: function (path) {
        window.location.href = path;
    },
    preferenceString(preference) {
        if (preference == undefined) return "Unknown";
        switch (preference) {
            case 0:
                return "Unavailable";
            case 1:
                return "Low";
            case 2:
                return "Medium";
            case 3:
                return "High";
            default:
                return "Unknown";
        }
    },
    preferenceId(string) {
        if (string == undefined) return -1;
        let lowered = string.toLowerCase();
        switch (lowered) {
            case "unavailable":
                return 0;
            case "low":
                return 1;
            case "medium":
                return 2;
            case "high":
                return 3;
            default:
                return -1;
        }
    },
    preferenceType(preference) {
        if (preference == undefined) return "is-dark";
        switch (preference) {
            case 0:
                return "is-danger";
            case 1:
                return "is-info";
            case 2:
                return "is-warning";
            case 3:
                return "is-success";
            default:
                return "is-dark";
        }
    },
    stateType: function (state) {
        if (!state || !state.name) return "is-light";

        switch (state.name) {
            // states for users
            case "accepted":
                return "is-success";
            case "dropped":
                return "is-danger";
            case "enrolled":
                return "is-light";
            case "waitlisted":
                return "is-warning";
            // states for conferences
            case "planning":
                return "is-danger";
            case "enrollment":
                return "is-warning";
            case "registration":
                return "is-warning";
            case "running":
                return "is-success";
            case "over":
                return "is-danger";
            // Jobs
            case "planned":
                return "is-light";
            case "processing":
                return "is-primary";
            case "successful":
                return "is-success";
            case "failed":
                return "is-danger";
            case "softfail":
                return "is-warning";
            // Assignments
            case "assigned":
                return "is-light";
            case "checked-in":
                return "is-warning";
            case "done":
                return "is-success";
            // Bids
            case "unsuccessful":
                return "is-danger";
            case "conflict":
                return "is-danger";
            case "placed":
                return "is-white";
            case "unavailable":
                return "is-danger";
        }
    },
    roleType: function (role) {
        if (role?.name) {
            switch (role.name) {
                case "sv":
                    return "is-light";
                case "chair":
                    return "is-dark";
                case "captain":
                    return "is-primary";
            }
        }
    },

}