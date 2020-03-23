import Vue from 'vue'
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

import defines from './modules/defines';
import auth from './modules/auth';
import svs from './modules/svs';
import tasks from './modules/tasks';
import assignments from './modules/assignments';
import conferences from './modules/conferences';
import conference from './modules/conference';
import userIndex from './modules/userIndex';
import profile from './modules/profile';
import reports from './modules/reports';
import notifications from './modules/notifications';
import calendar from './modules/calendar';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        defines,
        auth,
        svs,
        tasks,
        assignments,
        conference,
        conferences,
        userIndex,
        profile,
        reports,
        notifications,
        calendar
    },
    plugins: [createPersistedState({
        paths: [
            'auth.user',
            'profile.tab',
            'conference.last',
            'conference.tab',
            'conference.conference',
            'conference.taskDays',
            'svs',
            'tasks',
            'assignments',
            'userIndex.data',
            'userIndex.search',
            'userIndex.university',
            'userIndex.sort',
            'userIndex.page',
            'reports',
            'calendar',
        ]
    })]
});