import axios from 'axios';

const state = {
    user: null
};

const getters = {
    user: state => state.user
};

const actions = {
    async fetchUser({ commit }) {
        const response = await axios.get('user/self');

        commit('setUser', response.data);
    }
};

const mutations = {
    setUser: (state, user) => (state.user = user)
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};