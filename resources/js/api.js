export default {
    getFaq(id) {
        return axios.get(`faq/${id}`);
    },
    getFaqs() {
        return axios.get(`faq`);
    },
    getNotification(id) {
        return axios.get(`notification/${id}`);
    },
    getNotifications(since) {
        if (since) {
            return axios.get(`notification?since=${since}`)
        } else {
            return axios.get(`notification`)
        }
    },
    getSelf() {
        return axios.get(`user/self`);
    },
    getUsers(params) {
        return axios.get(`user?${params}`);
    },
    getConferences() {
        return axios.get("conference");
    },
    getConferencesPreview() {
        return axios.get("conference/preview");
    },
    getConference(key) {
        return axios.get(`conference/${key}`);
    },
    getConferenceSvs(key, params) {
        return axios.get(`conference/${key}/sv?${params}`)
    },
    getConferenceSvsForTaskAssignment(key, taskId, params) {
        return axios.get(`conference/${key}/sv_for_task_assignment/${taskId}?${params}`)
    },
    getConferenceAcceptedCount(key) {
        return axios.get(`conference/${key}/sv/count`)
    },
    getConferenceTasks(key, params) {
        return axios.get(`conference/${key}/task?${params}`);
    },
    getConferenceAssignments(key, params) {
        return axios.get(`conference/${key}/assignment?${params}`);
    },
    getConferenceTaskDays(key) {
        return axios.get(`conference/${key}/task/day`);
    },
    getUser(id) {
        return axios.get(`user/${id}`);
    },
    getUserBidsForConference(id, conferenceKey) {
        return axios.get(`user/${id}/bid/${conferenceKey}`);
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
    getLocales() {
        return axios.get("locale");
    },
    getCountries() {
        return axios.get("country");
    },
    getStates() {
        return axios.get("state");
    },
    getDegrees() {
        return axios.get("degree");
    },
    getShirts() {
        return axios.get("shirt");
    },
    getTimezones() {
        return axios.get("timezone");
    },
    getLanguage(name) {
        return axios.get(`language/name/${name}`);
    },
    getCityInCountry(countryId, cityName) {
        return axios.get(`country/${countryId}/city/${cityName}`);
    },
    getUniversity(name) {
        return axios.get(`university/name/${name}`);
    },
    getJobs() {
        return axios.get("job");
    },
    getJob(id) {
        return axios.get(`job/${id}`);
    },
    getReport(conferenceKey, name) {
        return axios.get(`conference/${conferenceKey}/report/${name}`);
    },
    getDestinations(conferenceKey) {
        return axios.get(`conference/${conferenceKey}/destination`);
    },
    getNotificationTemplates() {
        return axios.get(`notification_template`);
    },
    getCalendarEvents(start, end) {
        return axios.get(`calendar_event?start=${start}&end=${end}`);
    },

    createAssignment(svId, taskId) {
        return axios.post(`assignment`, { user_id: svId, task_id: taskId });
    },
    createConference(vform) {
        return vform.post(`conference`);
    },
    createImage(model, type, image) {
        let form = new FormData();
        let owner = (type == "avatar") ? "App\\User" : "App\\Conference";
        form.append('image', image);
        form.append('type', type);
        form.append('owner_type', owner);
        form.append('owner_id', model.id);
        form.append("name", model.id + "-" + type);

        return axios.post(`image`, form, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
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
    createNotificationTemplate(name, data, conference) {
        let template = { name: name, data: data, conference_id: conference.id };
        return axios.post(`notification_template`, template);
    },
    createFaq(vform) {
        return vform.post(`faq`);
    },

    updateFaq(id, vform) {
        return vform.put(`faq/${id}`);
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
    updatePastConferences(userId, array, type) {
        return axios.put(`user/${userId}`, { [type]: array });
    },

    deleteFaq(id) {
        return axios.delete(`faq/${id}`);
    },
    deleteAllTasksOfConference(key, date) {
        return axios.delete(`conference/${key}/tasks/${date}`);
    },
    deleteAllAssignmentsOfConference(key, date) {
        return axios.delete(`conference/${key}/assignments/${date}`);
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
    deleteBid(id) {
        return axios.delete(`bid/${id}`);
    },
    deleteNotificationTemplate(id) {
        return axios.delete(`notification_template/${id}`);
    },

    postNotification(conferenceKey, vform) {
        return vform.post(`conference/${conferenceKey}/notification`);
    },
    importTasks(tasks, conference) {
        return axios.post(`conference/${conference}/task`, tasks)
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
        return axios.delete(`conference/${conference}/enroll`)
    },
    logout() {
        return axios.post(`logout`, undefined, { baseURL: '/', maxRedirects: 0 })
    }



}