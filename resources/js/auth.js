import api from "@/api.js";
import axios from "axios";

export default {
    logout() {
        axios.post(`logout`, undefined, { baseURL: '/', maxRedirects: 0 })
            .finally(() => {
                window.location.href = '/';
            });
    },
    can(ability, model, id = null, onModel = null, onId = null) {
        return new Promise(function (resolve, reject) {
            api.can(ability, model, id, onModel, onId)
                .then(data => { resolve(data.data.result) })
                .catch(error => { reject(error) })
        });
    },
    hasPermission(roleName, conferenceKey = null, state = null) {
        var roleId = null;
        switch (roleName) {
            case 'admin':
                roleId = 1;
                break;
            case 'chair':
                roleId = 2;
                break;
            case 'captain':
                roleId = 3;
                break;
            case 'sv':
                roleId = 10;
                break;
            default:
                break;
        }
        return new Promise(function (resolve, reject) {
            api.hasPermission(roleId, conferenceKey, state)
                .then(data => { resolve(data.data.result) })
                .catch(error => { reject(error) })
        });
    },

}