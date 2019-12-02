
export default {
    TASKS_COLUMNS(state, columns) {
        state.taskColumns = columns;
    },
    TASKS_SEARCH(state, search) {
        state.tasksSearch = search;
    },
    SVS_SEARCH(state, search) {
        state.svsSearch = search;
    },
    SVS_STATES(state, svsStates) {
        state.svsStates = svsStates;
    },
    CONFERENCE_TAB(state, tab) {
        state.conferenceTab = tab;
    },
}