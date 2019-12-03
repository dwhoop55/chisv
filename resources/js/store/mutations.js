
export default {
    TASKS_COLUMNS(state, columns) {
        state.tasks.columns = columns;
    },
    TASKS_SEARCH(state, search) {
        state.tasks.search = search;
    },
    TASKS_DAY(state, day) {
        if (day) {
            state.tasks.day = day;
        }
    },

    SVS_SEARCH(state, search) {
        state.svs.search = search;
    },

    CONFERENCE_TAB(state, tab) {
        state.navigation.conferenceTab = tab;
    },
}