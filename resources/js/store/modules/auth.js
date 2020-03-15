import api from "@/api";
import { methods as mixins } from '@/mixins';

const state = {
    user: null,
    abilities: [],
};

const getters = {
    user: state => state.user,
    userCan: (state, getters) => a => {
        return getters.ability(a)?.value;
    },
    userIs: state => (roleName, conferenceKey = null, stateName = null) => {
        var found = false;
        state.user?.permissions?.forEach(permission => {
            // Caution: we match undefined == null here!
            // === will obviously not work
            if (permission.role?.name == roleName &&
                permission?.conference?.key == conferenceKey &&
                permission?.state?.name == stateName) {
                found = true;
            }
        });
        return found;
    },
    userIsAdmin: (state, getters) => getters.userIs('admin'),
    userIsChair: (state, getters, rootState, rootGetters) => key => getters.userIsAdmin || getters.userIs('chair', key || rootGetters['conference/conference'].key),
    userIsCaptain: (state, getters, rootState, rootGetters) => key => getters.userIsAdmin || getters.userIs('captain', key || rootGetters['conference/conference'].key),
    userIsChairOrCaptain: (state, getters) => key => getters.userIsAdmin || getters.userIsChair(key) || getters.userIsCaptain(key),
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
    async fetchUser({ commit }) {
        const response = await api.getSelf();

        commit('setUser', response.data);
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
    setUser: (state, user) => (state.user = user),
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