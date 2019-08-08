import axios from "@/plugins/axios.js"

export default {
    getConference: function (key) {
        return axios.get(`conference/${key}`);
    },
    getUser: function (id) {
        return axios.get(`user/${id}`);
    },

    updateUser: function (id, vform) {
        return vform.put(`user/${id}`);
    },
    updateConference: function (key, vform) {
        return vform.put(`conference/${key}`);
    },

    destroyUser: function (id) {
        return axios.delete(`user/${id}`);
    },
    destroyConference: function (key) {
        return axios.delete(`conference/${key}`);
    },


}