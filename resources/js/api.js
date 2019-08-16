export default {
    getConferences: function () {
        return axios.get("conference");
    },
    getConference: function (key) {
        return axios.get(`conference/${key}`);
    },
    getUser: function (id) {
        return axios.get(`user/${id}`);
    },

    createConference: function (vform) {
        return vform.post(`conference`);
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

    getRoles: function () {
        return axios.get("role");
    },

    getStates: function () {
        return axios.get("state");
    },

    grantPermission: function (vform) {
        return vform.post("permission");
    },
    revokePermission: function (id) {
        return axios.delete(`permission/${id}`);
    },
    updatePermission: function (vform, id) {
        return vform.put(`permission/${id}`);
    },

    can: function (ability, model, id = null) {
        if (id) {
            return axios.get(`can/${ability}/${model}/${id}`);
        } else {
            return axios.get(`can/${ability}/${model}`);
        }
    }

}