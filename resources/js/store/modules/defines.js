import api from "@/api";

const state = {
    states: null,
    roles: null,
    locales: null,
};

const getters = {
    statesFor: state => filter => {
        if (Number.isInteger(filter)) {
            return state.states?.filter(s => s.id === filter);
        } else if (filter) {
            return state.states?.filter(s => s.for === filter);
        } else {
            return state.states;
        }
    },
    states: state => state.states,
    roles: state => state.roles,
    locales: state => state.locales,
};

const actions = {
    async fetchStates({ commit }) {
        const response = await api.getStates();
        commit('setStates', response.data);
    },
    async fetchRoles({ commit }) {
        const response = await api.getRoles();
        commit('setRoles', response.data);
    },
    async fetchLocales({ commit }) {
        const response = await api.getLocales();
        commit('setLocales', response.data);
    }
};

const mutations = {
    setStates: (state, states) => (state.states = states),
    setRoles: (state, roles) => (state.roles = roles),
    setLocales: (state, locales) => (state.locales = locales),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};