import api from "@/api";
import moment from 'moment-timezone'
import { methods as mixins } from '@/mixins';

const state = {
    user: null,
    userAcceptsCookies: null,
    abilities: [],
};

const getters = {
    userAcceptsCookies: state => state.userAcceptsCookies,
    usersLocale: state => state.user?.locale,
    usersTimezone: state => state.user?.timezone,
    user: state => state.user,
    userCan: (state, getters) => a => {
        return getters.ability(a)?.value;
    },
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
                    } else if (permission.state &&
                        stateName &&
                        stateName === permission.state.name) {
                        found = true;
                    }
                } // conferenceOk
            } // forEach
        });
        return found;
    },
    userIsAdminOrChairOrCaptain: (state, getters) => key => getters.userIs('admin') || getters.userIs('chair', key) || getters.userIs('captain', key),
    ability: state => a => {
        // Get the first ability from the array where is matches
        // Use shift() to take first object from the filtered array
        // which should only contain one or no item at all
        return state.abilities.filter(current => {
            return a.ability === current.ability &&
                a.model === current.model &&
                a.id || null === current.id &&
                a.onModel || null === current.onModel &&
                a.onId || null === current.onId
        }).shift();
    },
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
    async logout({ commit, dispatch }) {
        var p = new Promise((resolve, reject) => {
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
    async fetchUser({ commit }) {
        var p = new Promise((resolve, reject) => {
            api.getSelf()
                .then(({ data }) => {
                    commit('setUser', data);

                    // If the user has a timezone,
                    // set it on our moment instance
                    // so all moment instances will render
                    // the correct timezone
                    if (data.timezone?.name) {
                        moment.tz.setDefault(data.timezone.name);
                    }
                    resolve(data);
                })
                .catch(error => {
                    commit('setUser', null);
                    reject();
                });

        })
        return p;
    },
    async fetchCan({ commit, getters }, { ability, model, id, onModel, onId }) {
        const response = await api.can(ability, model, id, onModel, onId);
        const fetchedAbility = {
            ability,
            model: model || null,
            id: id || null,
            onModel: onModel || null,
            onId: onId || null,
            value: response.data.result || null
        };

        // Check if the ability exists and if we need to update
        // it or add it to the array as a new item
        if (getters.ability(ability, model, id, onModel, onId)) {
            commit('updateAbility', fetchedAbility);
        } else {
            commit('addAbility', fetchedAbility);
        }
    }
};

const mutations = {
    setPastConferences: (state, { past_conferences, past_conferences_sv }) => {
        state.user.past_conferences = past_conferences;
        state.user.past_conferences_sv = past_conferences_sv;
    },
    setUserAcceptsCookies: (state, bool) => state.userAcceptsCookies = bool,
    setUser: (state, user) => state.user = user,
    addAbility: (state, ability) => state.abilities.push(ability),
    updateAbility: (state, ability) => {
        state.abilities = state.abilities.map(a => {
            // If the ability is the one we are looking for
            // we replace its value
            if (a.ability === ability &&
                a.model === model &&
                a.id === id &&
                a.onModel === onModel &&
                a.onId === onId) {
                a.value = ability.value;
                return a;
            } else {
                // Otherwise we just give back the
                // unaltered item
                return ability;
            }
        });
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};