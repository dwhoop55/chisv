import api from "@/api";

const state = {
    states: null,
    roles: null,
    locales: null,
    countries: null,
    timezones: null,
    shirts: null,
    degrees: null,
    languages: null,
    priorities: [1, 2, 3],
    version: null,
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
    countries: state => state.countries,
    timezones: state => state.timezones,
    shirts: state => state.shirts,
    degrees: state => state.degrees,
    languages: state => state.languages,
    priorities: state => state.priorities,
    version: state => state.version,
};

const actions = {
    async fetchVersion({ commit }) {
        const response = await api.getVersion();
        commit('setVersion', response.data);
    },
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
    },
    async fetchCountries({ commit }) {
        const response = await api.getCountries();
        commit('setCountries', response.data);
    },
    async fetchTimezones({ commit }) {
        const response = await api.getTimezones();
        commit('setTimezones', response.data);
    },
    async fetchShirts({ commit }) {
        const response = await api.getShirts();
        commit('setShirts', response.data);
    },
    async fetchDegrees({ commit }) {
        const response = await api.getDegrees();
        commit('setDegrees', response.data);
    },
    async fetchLanguages({ commit }) {
        const response = await api.getLanguages();
        commit('setLanguages', response.data);
    }
};

const mutations = {
    setStates: (state, states) => (state.states = states),
    setRoles: (state, roles) => (state.roles = roles),
    setLocales: (state, locales) => (state.locales = locales),
    setCountries: (state, countries) => (state.countries = countries),
    setTimezones: (state, timezones) => (state.timezones = timezones),
    setShirts: (state, shirts) => (state.shirts = shirts),
    setDegrees: (state, degrees) => (state.degrees = degrees),
    setLanguages: (state, languages) => (state.languages = languages),
    setVersion: (state, version) => (state.version = version),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};