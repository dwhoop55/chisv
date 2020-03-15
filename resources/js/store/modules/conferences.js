import api from "@/api";

const state = {
    conferences: [],
    isLoading: false,
};

const getters = {
    conferences: state => state.conferences,
    isLoading: state => state.isLoading,
};

const actions = {
    async fetchConferences({ commit }) {
        commit('setIsLoading', true);
        api.getConferences()
            .then(({ data }) => {
                commit('setConferences', data);
            })
            .catch(error => {
                commit('setConferences', null);
            })
            .finally(() => {
                commit('setIsLoading', false);
            })
    }
};

const mutations = {
    setConferences: (state, conferences) => (state.conferences = conferences),
    setIsLoading: (state, bool) => (state.isLoading = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};