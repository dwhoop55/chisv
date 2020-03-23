import api from "@/api";

const state = {
    events: [],
    startDate: null,
    endDate: null,
    calView: "week",
};

const getters = {
    events: state => state.events,
    startDate: state => state.startDate,
    endDate: state => state.endDate,
    calView: state => state.calView
};

const actions = {
    async fetchEvents({ commit, state }) {
        const data = await api.getCalendarEvents(state.startDate, state.endDate);
        commit('setEvents', data.data ? data.data : null);
    }
};

const mutations = {
    setEvents: (state, events) => state.events = events,
    setStartDate: (state, start) => state.startDate = start,
    setEndDate: (state, end) => state.endDate = end,
    setCalView: (state, calView) => state.calView = calView,
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};