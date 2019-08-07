import Vue from 'vue'
import Vuex from 'vuex'
import axios from '@/plugins/axios';
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

// root state object.
// each Vuex instance is just a single state tree.
const state = {
    user: null
}

// mutations are operations that actually mutates the state.
// each mutation handler gets the entire state tree as the
// first argument, followed by additional payload arguments.
// mutations must be synchronous and can be recorded by plugins
// for debugging purposes.
const mutations = {
    setUser(state, user) {
        state.user = user;
    },
}


// actions are functions that cause side effects and can involve
// asynchronous operations.
const actions = {
    fetchUser({ commit }) {
        axios.get('user/self')
            .then(data => { commit('setUser', data.data) })
            .catch(error => { throw error });
    },
    checkUser() {
        if (!state.user) {
            console.log("No user in vuex, fetching from backend..");
            dispatch('fetchUser');
        } else {
            console.log("Vuex has user in store");
        }
    },
    clearUser({ commit }) {
        commit('setUser', null);
    }
}

// getters are functions
const getters = {
    user: state => {
        return state.user;
    },
}

// A Vuex instance is created by combining the state, mutations, actions,
// and getters.
export default new Vuex.Store({
    plugins: [createPersistedState()],
    state,
    getters,
    actions,
    mutations
})