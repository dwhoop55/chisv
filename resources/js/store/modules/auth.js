import api from "@/api";
import moment from 'moment-timezone'
import { methods as mixins } from '@/mixins';

const state = {
    user: null,
    userAcceptsCookies: null,
};

const getters = {
    userAcceptsCookies: state => state.userAcceptsCookies,
    usersLocale: state => state.user?.locale,
    user: state => state.user,
    userIs: state => (roleName, conferenceKey, stateName) => {
        var found = false;
        state.user?.permissions?.forEach(permission => {
            // Caution: we match undefined == null here!
            // === will obviously not work
            var conferenceOk = false;
            if (roleName && permission.role && roleName === permission?.role?.name) {
                if (conferenceKey === undefined) { // So not given
                    // conferenceKey can be anything!
                    conferenceOk = true;
                } else if (
                    conferenceKey === null &&
                    // conferenceKey is set to null, so it is
                    // required to be null
                    permission.conference === null) {
                    conferenceOk = true;
                } else if (permission.conference &&
                    conferenceKey &&
                    conferenceKey === permission.conference.key) {
                    conferenceOk = true;
                }

                if (conferenceOk) {
                    if (stateName === undefined) { // So not given
                        // stateName can be anything!
                        found = true;
                    } else if (stateName === null &&
                        permission.stateName === null) {
                        found = true;
                    } else if (stateName &&
                        permission.state &&
                        stateName === permission.state.name) {
                        found = true;
                    }
                } // conferenceOk
            } // forEach
        });
        return found;
    },
    userIsAdminOrChairOrCaptain: (state, getters) => key => getters.userIs('admin') || getters.userIs('chair', key) || getters.userIs('captain', key),
};

const actions = {
    async updatePastConferences({ commit, state }, { array, type }) {
        return new Promise((resolve, reject) => {
            api.updatePastConferences(state.user.id, array, type)
                .then(({ data }) => {
                    // Update successful, update store
                    commit('setPastConferences', data.result);
                    resolve();
                })
                .catch(error => reject(error));
        });
    },
    async resetStore() {
        return new Promise((resolve, reject) => {
            if (localStorage.removeItem("vuex")) {
                resolve();
            } else {
                reject();
            }
        });
    },
    async logout({ commit }) {
        return new Promise((resolve, reject) => {
            api.logout()
                .then(data => commit('setUser', null))
                .catch(error => reject(error))
                .finally(() => {
                    commit('setUser', null);
                    resolve();
                    window.location.href = '/login';
                })
        })
    },
    async login({ commit }, credentials) {
        return new Promise((resolve, reject) => {
            api.login(credentials)
                .then(({ data }) => {
                    commit('setUser', data);
                    resolve(data);
                    window.location.href = '/';
                })
                .catch(error => reject(error))
        });
    },
    async passwordReset({ commit }, data) {
        return new Promise((resolve, reject) => {
            api.passwordReset(data)
                .then(({ data }) => {
                    commit('setUser', data);
                    resolve(data);
                    window.location.href = '/';
                })
                .catch(error => reject(error))
        });
    },
    async fetchUser({ commit }) {
        return new Promise((resolve, reject) => {
            api.getSelf()
                .then(({ data }) => {
                    commit('setUser', data);

                    if (data.locale?.code) {
                        moment.locale(data.locale.code);
                    }
                    resolve(data);
                })
                .catch(error => {
                    commit('setUser', null);
                    reject();
                });

        })
    },
};

const mutations = {
    setPastConferences: (state, { past_conferences, past_conferences_sv }) => {
        state.user.past_conferences = past_conferences;
        state.user.past_conferences_sv = past_conferences_sv;
    },
    setUserAcceptsCookies: (state, bool) => state.userAcceptsCookies = bool,
    setUser: (state, user) => state.user = user,
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};