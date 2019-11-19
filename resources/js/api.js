export default {
    getConferences: function () {
        return axios.get("conference");
    },
    getConference: function (key) {
        return axios.get(`conference/${key}`);
    },
    getConferenceSvs: function (key, params) {
        return axios.get(`conference/${key}/sv${params}`)
    },
    getConferenceAcceptedCount: function (key) {
        return axios.get(`conference/${key}/sv/count`)
    },
    getConferenceTasks(key, params) {
        return axios.get(`conference/${key}/task${params}`);
    },
    getConferenceTaskDays(key) {
        return axios.get(`conference/${key}/task/day`);
    },
    getUser: function (id) {
        return axios.get(`user/${id}`);
    },
    getEnrollmentFormTemplates: function () {
        return axios.get(`enrollment_form/template`)
    },
    getEnrollmentForm: function (id) {
        return axios.get(`enrollment_form/${id}`)
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
    getJobs() {
        return axios.get("job");
    },
    getJob(id) {
        return axios.get(`job/${id}`);
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
    createPermission: function (vform) {
        return vform.post("permission");
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
    updateConferenceEnrollmentFormWeights(key, weights) {
        return axios.put(`conference/${key}/update_enrollment_form_weights`, weights);
    },
    updateConferenceResetEnrollmentsToEnrolled(key) {
        return axios.put(`conference/${key}/reset_enrollments_to_enrolled`);
    },
    updatePermission: function (vform, id) {
        return vform.put(`permission/${id}`);
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
    deletePermission: function (id) {
        return axios.delete(`permission/${id}`);
    },

    runLottery(conference) {
        return axios.post(`conference/${conference}/lottery`);
    },
    enroll(conference, vform) {
        return vform.post(`conference/${conference}/enroll`)
    },
    unenroll(conference) {
        return axios.post(`conference/${conference}/unenroll`)
    },
    can(ability, model, id = null, onModel = null, onId = null) {
        if (onModel && onId) {
            return axios.get(`can/${ability}/${model}/${id}/${onModel}/${onId}`);
        } else if (onModel) {
            return axios.get(`can/${ability}/${model}/${id}/${onModel}`);
        } else if (id) {
            return axios.get(`can/${ability}/${model}/${id}`);
        } else {
            return axios.get(`can/${ability}/${model}`);
        }
    },


}