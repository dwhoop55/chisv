import api from "@/api";
require("@/helpers");

const state = {
    data: null,
    interval: { start: null, end: null }
};

const getters = {
    data: state => state.data,
    interval: state => state.interval,
};

const actions = {
    async fetchEvents({ commit, state }) {
        const data = await api.getEvents(state.interval.start, state.interval.end).data;
        commit('setData', data ? data : null);
    }
};

const mutations = {
    setData: (state, data) => state.data = data,
    setInterval: (state, interval) => state.interval = interval,
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};