import api from "@/api";

const state = {
    notifications: null,
    isLoading: false,
};

const getters = {
    notifications: state => state.notifications,
    unread: state => state.notifications?.filter(n => !n.read_at),
    hasUnread: (state, getters) => (getters.unread && getters.unread?.length > 0),
};

const actions = {
    async fetchNotifications({ commit, rootGetters, getters, state }) {
        commit('setIsLoading', true);
        api.getOwnNotifications()
            .then(({ data }) => commit('setNotifications', data))
            .catch(error => commit('setNotifications', null))
            .finally(() => commit('setIsLoading', false))
    }
};

const mutations = {
    setNotifications: (state, notifications) => (state.notifications = notifications),
    setIsLoading: (state, bool) => (state.isLoading = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};