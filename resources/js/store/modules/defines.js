import api from "@/api";

const state = {
    states: null,
};

const getters = {
    states: state => filter => {
        if (Number.isInteger(filter)) {
            return state.states?.filter(s => s.id === filter);
        } else if (filter) {
            return state.states?.filter(s => s.for === filter);
        } else {
            return state.states;
        }
    },
};

const actions = {
    async fetchStates({ commit }) {
        const response = await api.getStates();
        commit('setStates', response.data.data);
    }
};

const mutations = {
    setStates: (state, states) => (state.states = states),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};