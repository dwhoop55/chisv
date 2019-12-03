import Vue from 'vue'
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

import mutations from './mutations'; // Setters
import getters from './getters'; // Getters
import { tasks, svs, navigation } from './stateObjects'; // Statemodels

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        tasks: tasks,
        svs: svs,
        navigation: navigation
    },
    plugins: [createPersistedState()],
    mutations: mutations,
    getters: getters,
});

export default store;