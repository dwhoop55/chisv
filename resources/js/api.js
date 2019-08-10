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

    revokePermission: function (id) {
        return axios.delete(`permission/${id}`);
    },

    can: function (ability, model, id = null) {
        if (id) {
            return axios.get(`can/${ability}/${model}/${id}`);
        } else {
            return axios.get(`can/${ability}/${model}`);
        }
    }

}