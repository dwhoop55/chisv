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
    createImage: function (form) {
        return axios.post(`image`, form, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    },
    createConferenceImage: function (conference, type, image) {
        let form = new FormData();
        form.append('image', image);
        form.append('type', type);
        form.append('owner_type', "App\\Conference");
        form.append('owner_id', conference.id);
        form.append("name", conference.key + "-" + type);
        return this.createImage(form);
    },

    updateUser: function (id, vform) {
        return vform.put(`user/${id}`);
    },
    updateConference: function (key, vform) {
        return vform.put(`conference/${key}`);
    },
    updateImage: function (id, image) {
        let form = new FormData();
        form.append('image', image);
        form.append('_method', 'PUT');
        return axios.post(`image/${id}`, form, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    },

    deleteUser: function (id) {
        return axios.delete(`user/${id}`);
    },
    deleteConference: function (key) {
        return axios.delete(`conference/${key}`);
    },
    deleteImage: function (id) {
        return axios.delete(`image/${id}`);
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