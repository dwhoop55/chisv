import Vue from 'vue'
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import mutations from './mutations';
import getters from './getters';

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        tasksColumns: ['manage', 'location', 'slots', 'priority', 'description'],
        tasksSearch: "",
        svsSearch: "",
        conferenceTab: 0,
    },
    plugins: [createPersistedState()],
    mutations: mutations,
    getters: getters,
});

export default store;