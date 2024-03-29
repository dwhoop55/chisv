import moment from "moment-timezone";
import NotesModalVue from "@/components/modals/NotesModal"
import api from "@/api.js"
import Form from "vform";


export { methods }

let methods = {
    deleteNote(id) {
        this.$buefy.dialog.confirm({
            message: 'Delete this note?',
            type: 'is-danger',
            onConfirm: (text) => {
                api
                    .deleteNote(id)
                    .then(({ data }) => {
                        this.$buefy.toast.open({
                            message: data.message,
                            type: 'is-success'
                        });
                        this.$store.dispatch('svs/fetchSvs');
                        this.$store.dispatch('assignments/fetchAssignments');
                    })
                    .catch(error => { });
            }
        })

    },
    showNotes(notes) {
        this.$buefy.modal.open({
            component: NotesModalVue,
            props: { notes },
            hasModalCard: true,
        })
    },
    loginAs(id) {
        localStorage.removeItem("vuex");
        document.location = `/loginAs?id=${id}`;
    },
    downloadText(text, filename) {
        let blob = new Blob([text], { type: 'text/txt' });
        let link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = filename;
        link.click();
    },
    createVCalendar(events) {
        const cal = [
            `BEGIN:VCALENDAR`,
            `VERSION:2.0`,
            `CALSCALE:GREGORIAN`,
            `${events.join("\n")}`,
            `END:VCALENDAR`];
        return cal.join("\n");
    },
    createVEvent(title, timezone, start, end, location, description) {
        let startDate = this.dateFromMySql(start).toMySqlDate().replace(/[^\d]/gm, '');
        let startTime = this.dateFromMySql(start).toMySqlTime().replace(/[^\d]/gm, '');
        let endDate = this.dateFromMySql(end).toMySqlDate().replace(/[^\d]/gm, '');
        let endTime = this.dateFromMySql(end).toMySqlTime().replace(/[^\d]/gm, '');
        const elements = [
            `BEGIN:VEVENT`,
            `SUMMARY:${title}`,
            `DTSTART;TZID=${timezone}:${startDate}T${startTime}`,
            `DTEND;TZID=${timezone}:${endDate}T${endTime}`
        ];
        if (location) {
            elements.push(`LOCATION:${location.replace(',', "\,")}`);
        }
        if (description) {
            elements.push(`DESCRIPTION:${description.replace(',', "\,")}`);
        }
        elements.push("STATUS:CONFIRMED");
        elements.push("SEQUENCE:0");
        elements.push("END:VEVENT");
        return elements.join("\n");
    },
    localeIsAmPm() {
        const localizedTime = this.momentize(new Date(), { format: "LT" }) + " ";
        if (localizedTime.includes(' AM ') || localizedTime.includes(' PM ')) {
            return true;
        } else {
            return false;
        }
    },
    momentize(date, options) {
        var localTz = moment.tz.guess(true);
        var fromTz = options?.fromToTz || options?.fromTz || localTz;
        var toTz = options?.fromToTz || options?.toTz || localTz;
        var withoutSuffix = options?.withoutSuffix ? true : false;
        var fromNow = options?.fromNow ? true : false;
        var format = options?.format;

        if (typeof date == "string") {
            if (date.match(/^(\d{2}:\d{2})($|:\d{2})/)) {
                date = `2000-01-01 ${date}`;
            } else if (date.match(/^(\d{1}:\d{2})($|:\d{2})/)) {
                date = `2000-01-01 0${date}`;
            }
        }

        if (typeof options?.toTz == "string") {
            toTz = options.toTz;
        }

        var m = new moment.tz(date, fromTz).tz(toTz);

        try {
            if (fromNow) {
                var result = m.fromNow(withoutSuffix ? true : false);
            } else if (format) {
                var result = m.format(format);
            } else {
                var result = m;
            }
        } catch (error) {
            console.error(error, { m, date, fromTz, toTz, format, withoutSuffix, options });
        }

        return result;
    },
    abilityString(ability, model, id = null, onModel = null, onId = null) {
        return `${ability},${model},${id},${onModel},${onId}`;
    },
    isEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    },
    dateFromMySql(string) {
        if (string instanceof Date) return string;

        if (typeof string != "string") console.error("Invalid input: no string!");

        if (string.match(/^\d{2}:\d{2}:\d{2}$/)) {
            // Missing day
            string = `0000-00-00 ${string}`;
        } else if (string.match(/^\d{4}-\d{2}-\d{2}\ \d{2}:\d{2}$/)) {
            // Missing seconds
            string = `${string}:00`;
        } else if (string.match(/^\d{4}-\d{2}-\d{2}$/)) {
            // Missing time
            string = `${string} 00:00:00`;
        } else if (!string.match(/^\d{4}-\d{2}-\d{2}\ \d{2}:\d{2}:\d{2}$/)) {
            // Not in correct format
            console.error("Invalid input: Not in YYYY-MM-DD HH:MM:SS format");
        }
        // regular expression split that creates array with: year, month, day, hour, minutes, seconds values
        let dateTimeParts = string.split(/[- :]/);
        // monthIndex begins with 0 for January and ends with 11 for December so we need to decrement by one
        dateTimeParts[1]--;
        return new Date(...dateTimeParts);
    },
    dateTimeFromTime(time) {
        return this.dateFromTime(time).toMySqlDateTime();
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
    },
    filterStates: function (states, filter) {
        return states.filter((value, index) => {
            return value.for == filter;
        });
    },
    parseEnrollmentForm: function (jsonForm) {
        if (!jsonForm) {
            console.log('Given enrollment form is null!');
            return;
        }

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
                case "integer":
                    vform[key] = value.value ? value.value : 0;
                    break;
            }
        }

        return { vform, meta, header, agreement, name, id };
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
    stateBackground(state) {
        if (!state || !state.name) {
            return "background: grey;";
        }
        let start = "#3ABD77";
        let end = "#37B37E";
        switch (state.name) {
            case "planning":
            case "over":
                start = "#e74c3c";
                end = "#E84E3C";
                break;
            case "enrollment":
                start = "#F39C12";
                end = "#DB8004";
                break;
            case "registration":
                start = "#2d4262";
                end = "#316078";
                break;
        }
        return `background: linear-gradient(.31deg,${start} .7%,${end} 99.3%);`;
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
                return "is-primary";
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
                case "admin":
                    return "is-light";
            }
        }
    },

}