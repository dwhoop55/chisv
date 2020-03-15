import api from "@/api";
import { methods as mixins } from '@/mixins';

const state = {
    conference: null,
    last: { key: null, name: null },
    isLoading: false,
    tab: 0,
    taskDays: {},
    acceptedCount: null,
};

const getters = {
    isLoading: state => state.isLoading,
    last: state => state.last,
    conference: state => state.conference,
    tab: state => state.tab,
    conferenceDays: state => {
        if (!state.conference.start_date || !state.conference.end_date) {
            return null;
        }
        var days = [];
        var start = mixins.dateFromMySql(state.conference.start_date);
        var end = mixins.dateFromMySql(state.conference.end_date);

        for (var d = start; d <= end; d.setDate(d.getDate() + 1)) {
            days.push({
                date: new Date(d),
                type: "is-primary"
            });
        }

        return days;
    },
    taskDays: state => {
        var days = [];
        Object.keys(state.taskDays).forEach(function (day) {
            days.push({
                date: mixins.dateFromMySql(day),
                type: "is-warning"
            });
        });
        return days;
    },
    acceptedCount: state => state.acceptedCount

};

const actions = {
    async fetchConference({ commit, dispatch, state }, conferenceKey) {
        const key = conferenceKey || state.conference.key;
        commit('setIsLoading', true);
        const response = await api.getConference(key);
        commit('setConference', response.data);
        commit('setLast', response.data);

        var p1 = dispatch('fetchTaskDays', key);
        var p2 = dispatch('fetchAcceptedCount', key);
        var p3 = dispatch('tasks/fetchTasks', key, { root: true });
        var p4 = dispatch('svs/fetchSvs', key, { root: true });
        var p4 = dispatch('assignments/fetchAssignments', key, { root: true });
        Promise.all([p1, p2, p3]).finally(() => {
            commit('setIsLoading', false);
        });
    },
    async fetchTaskDays({ commit, state }, key) {
        const response = await api.getConferenceTaskDays(key || state.conference.key);
        commit('setTaskDays', response.data);

    },
    async fetchAcceptedCount({ commit, state }, key) {
        const response = await api.getConferenceAcceptedCount(key || state.conference.key);
        commit('setAcceptedCount', response.data.result);

    }
};

const mutations = {
    setLast: (state, conference) => (state.last = { key: conference.key, name: conference.name }),
    setConference: (state, conference) => (state.conference = conference),
    setTab: (state, tab) => (state.tab = tab),
    setTaskDays: (state, days) => (state.taskDays = days),
    setAcceptedCount: (state, count) => (state.acceptedCount = count),
    setIsLoading: (state, bool) => (state.isLoading = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};