export default {
    getConferences() {
        return axios.get("conference");
    },
    getConference(key) {
        return axios.get(`conference/${key}`);
    },
    getConferenceSvs(key, params) {
        return axios.get(`conference/${key}/sv${params}`)
    },
    getConferenceAcceptedCount(key) {
        return axios.get(`conference/${key}/sv/count`)
    },
    getConferenceTasks(key, params) {
        return axios.get(`conference/${key}/task${params}`);
    },
    getConferenceAssignments(key, params) {
        return axios.get(`conference/${key}/assignment${params}`);
    },
    getConferenceTaskDays(key) {
        return axios.get(`conference/${key}/task/day`);
    },
    getUser(id) {
        return axios.get(`user/${id}`);
    },
    getEnrollmentFormTemplates() {
        return axios.get(`enrollment_form/template`)
    },
    getEnrollmentForm(id) {
        return axios.get(`enrollment_form/${id}`)
    },
    getEnrollment(key) {
        return axios.get(`conference/${key}/enrollment`)
    },
    getVersion() {
        return axios.get(`version`)
    },
    getRoles() {
        return axios.get("role");
    },
    getStates() {
        return axios.get("state");
    },
    getJobs() {
        return axios.get("job");
    },
    getJob(id) {
        return axios.get(`job/${id}`);
    },

    createAssignment(svId, taskId) {
        return axios.post(`assignment`, { user_id: svId, task_id: taskId });
    },
    createConference(vform) {
        return vform.post(`conference`);
    },
    createImage(form) {
        return axios.post(`image`, form, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    },
    createConferenceImage(conference, type, image) {
        let form = new FormData();
        form.append('image', image);
        form.append('type', type);
        form.append('owner_type', "App\\Conference");
        form.append('owner_id', conference.id);
        form.append("name", conference.key + "-" + type);
        return this.createImage(form);
    },
    createUserImage(user, type, image) {
        let form = new FormData();
        form.append('image', image);
        form.append('type', type);
        form.append('owner_type', "App\\User");
        form.append('owner_id', user.id);
        form.append("name", type + "-" + user.id);
        return this.createImage(form);
    },
    createPermission(vform) {
        return vform.post("permission");
    },
    createBid(bid) {
        return axios.post(`bid`, bid);
    },
    createTask(vform) {
        return vform.post(`task`);
    },

    updateAssignment(id, payload) {
        return axios.put(`assignment/${id}`, payload);
    },
    updateUser(id, vform) {
        return vform.put(`user/${id}`);
    },
    updateConference(key, vform) {
        return vform.put(`conference/${key}`);
    },
    updateImage(id, image) {
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
    updatePermission(vform, id) {
        return vform.put(`permission/${id}`);
    },
    updateBid(bid) {
        return axios.put(`bid/${bid.id}`, bid);
    },
    updateTask(vform, id) {
        return vform.put(`task/${id}`);
    },

    deleteAssignment(id) {
        return axios.delete(`assignment/${id}`);
    },
    deleteUser(id) {
        return axios.delete(`user/${id}`);
    },
    deleteConference(key) {
        return axios.delete(`conference/${key}`);
    },
    deleteImage(id) {
        return axios.delete(`image/${id}`);
    },
    deletePermission(id) {
        return axios.delete(`permission/${id}`);
    },
    deleteTask(id) {
        return axios.delete(`task/${id}`);
    },

    runAuction(conference, day) {
        return axios.post(`conference/${conference}/auction/${day}`);
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
    hasPermission(role, conferenceKey = null, state = null) {
        if (role && conferenceKey && state) {
            return axios.get(`has_permission/${role}/${conferenceKey}/${state}`);
        } else if (role && conferenceKey) {
            return axios.get(`has_permission/${role}/${conferenceKey}`);
        } else if (role) {
            return axios.get(`has_permission/${role}`);
        } else {
            console.error("No role given");
        }
    },


}