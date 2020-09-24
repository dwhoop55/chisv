import api from "@/api";
import { methods as mixins } from "@/mixins"

const state = {
    notifications: [],
    lastFetch: new Date(0),
    isLoading: false,
};

const getters = {
    notifications: state => state.notifications,
    unread: (state, getters) => getters.notifications?.filter(n => !n.read_at),
    hasUnread: (state, getters) => (getters.unread && getters.unread?.length > 0),
    numberUnread: (state, getters) => (parseInt(getters.unread?.length)),
    lastFetch: state => state.lastFetch,
    isLoading: state => state.isLoading,
};

const actions = {
    async fetchNotifications({ commit, rootGetters, getters, state }, since = null) {
        var timestamp = getters.lastFetch.toMySqlDateTime();
        commit('setIsLoading', true);

        if (since && since instanceof Date) {
            timestamp = since.toMySqlDateTime();
        }
        api.getNotifications(timestamp)
            .then(({ data }) => {
                if (data.data.length > 0) {
                    var newNotifications = data.data.map((n) => {
                        n.created_at = new Date(n.created_at);
                        n.read_at = n.read_at ? new Date(n.read_at) : null;
                        return n;
                    })
                    var newArray = (since === 0) ? newNotifications : [...newNotifications, ...getters.notifications];
                    newArray.sort((a, b) => b.created_at - a.created_at);
                    commit('setNotifications', newArray);
                    commit('setLastFetch', mixins.dateFromMySql(data.clearUntil));

                }
            })
            .catch(error => {
                console.error(error);
                commit('setLastFetch', new Date(0));
            }).finally(() => commit('setIsLoading', false))

    },
};

const mutations = {
    setIsLoading: (state, bool) => state.isLoading = bool,
    setNotifications: (state, notifications) => state.notifications = notifications,
    setLastFetch: (state, date) => (state.lastFetch = date),
    markRead: (state, id) => {
        state.notifications.forEach(notification => {
            if (notification.id === id) {
                notification.read_at = new Date();
            }
        });
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};