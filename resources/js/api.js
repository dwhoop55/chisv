export default {
    getConferences: function () {
        return axios.get("conference");
    },
    getConference: function (key) {
        return axios.get(`conference/${key}`);
    },
    getConferenceUsers: function (key) {
        return new Promise(function (resolve, reject) {
            axios.get(`conference/${key}/user`)
                .then(data => { resolve(data.data.result) })
                .catch(error => { reject(error) })
        });
    },
    getUser: function (id) {
        return axios.get(`user/${id}`);
    },
    getEnrollment: function (key) {
        return axios.get(`conference/${key}/enrollment`)
    },
    getVersion: function () {
        return axios.get(`version`)
    },
    getRoles: function () {
        return axios.get("role");
    },
    getStates: function () {
        return axios.get("state");
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
    // updateEnrollment: function (action, onConference, forUser = null) {
    //     if (forUser) {
    //         return axios.post(`conference/${onConference}/${action}/${forUser}`)
    //     } else {
    //         return axios.post(`conference/${onConference}/${action}`)
    //     }
    // },

    deleteUser: function (id) {
        return axios.delete(`user/${id}`);
    },
    deleteConference: function (key) {
        return axios.delete(`conference/${key}`);
    },
    deleteImage: function (id) {
        return axios.delete(`image/${id}`);
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

    enroll: function (conference, vform) {
        return vform.post(`conference/${conference}/enroll`)
    },
    unenroll: function (conference) {
        return axios.post(`conference/${conference}/unenroll`)
    },
    can: function (ability, model, id = null) {
        if (id) {
            return axios.get(`can/${ability}/${model}/${id}`);
        } else {
            return axios.get(`can/${ability}/${model}`);
        }
    },


}