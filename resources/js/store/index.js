import Vue from 'vue'
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

import defines from './modules/defines';
import auth from './modules/auth';
import svs from './modules/svs';
import tasks from './modules/tasks';
import conference from './modules/conference';
import userIndex from './modules/userIndex';

// import mutations from './mutations'; // Setters
// import getters from './getters'; // Getters
// import { tasks, assignments, svs, report, navigation, userIndex } from './stateObjects'; // Statemodels

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        defines,
        auth,
        svs,
        tasks,
        conference,
        userIndex
    },
    plugins: [createPersistedState({
        paths: [
            'auth.user',
            'conference.tab',
            // 'conference.conference',
            // 'conference.acceptedCount',
            'conference.taskDays',
            'svs',
            'tasks',
            'userIndex',
        ]
    })]
})

// const store = new Vuex.Store({
//     state: {
//         tasks: tasks,
//         assignments: assignments,
//         svs: svs,
//         report: report,
//         navigation: navigation,
//         userIndex: userIndex
//     },
//     plugins: [createPersistedState()],
//     mutations: mutations,
//     getters: getters,
// });

// export default store;