import api from "@/api";
import { methods as mixins } from '@/mixins';

const state = {
    conference: null,
    last: { key: null, name: null },
    tab: 0,
};

const getters = {
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
        Object.keys(state.conference.task_days).forEach(function (day) {
            days.push({
                date: mixins.dateFromMySql(day),
                type: "is-warning"
            });
        });
        return days;
    },
    acceptedCount: state => state.conference.number_accepted_svs

};

const actions = {
    async fetchConference({ commit, dispatch, state }, key) {
        const response = await api.getConference(key || state.conference.key)
        commit('setConference', response.data);
    },
    async fetchTaskDays({ commit, state }, key) {
        const response = await api.getConferenceTaskDays(key || state.conference.key);
        commit('setTaskDays', response.data);
    },
    async fetchAcceptedCount({ commit, state }, key) {
        const response = await api.getConferenceNumberAcceptedSvs(key || state.conference.key);
        commit('setAcceptedCount', response.data);

    }
};

const mutations = {
    setConference: (state, conference) => {
        state.conference = conference
        state.last = { key: conference.key, name: conference.name };
    },
    setTab: (state, tab) => (state.tab = tab),
    setTaskDays: (state, days) => (state.conference.task_days = days),
    setAcceptedCount: (state, count) => (state.conference.number_accepted_svs = count),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};