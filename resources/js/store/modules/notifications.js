import api from "@/api";
import { methods as mixins } from "@/mixins"

const state = {
    notifications: [],
    lastFetch: new Date(0),
};

const getters = {
    notifications: state => state.notifications,
    unread: (state, getters) => getters.notifications?.filter(n => !n.read_at),
    hasUnread: (state, getters) => (getters.unread && getters.unread?.length > 0),
    numberUnread: (state, getters) => (parseInt(getters.unread?.length)),
    lastFetch: state => state.lastFetch,
};

const actions = {
    async fetchNotifications({ commit, rootGetters, getters, state }, since = null) {
        var timestamp = getters.lastFetch.toMySqlDateTime();
        if (since && since instanceof Date) {
            timestamp = since.toMySqlDateTime();
        }
        api.getNotifications(timestamp)
            .then(({ data }) => {
                if (data.data.length > 0) {
                    if (since === 0) {
                        //reset all
                        commit('setNotifications', data.data);
                    } else {
                        // add new ones
                        commit('setNotifications', [...data.data, ...getters.notifications]);
                    }
                    commit('setLastFetch', mixins.dateFromMySql(data.clearUntil));
                }
            })
            .catch(error => commit('setLastFetch', new Date(0)))

    },
};

const mutations = {
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