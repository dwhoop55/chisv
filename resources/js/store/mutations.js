
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
    TASKS_SORT_FIELD(state, field) {
        if (field) {
            state.tasks.sort.field = field;
        }
    },
    TASKS_SORT_DIRECTION(state, direction) {
        if (direction) {
            state.tasks.sort.direction = direction;
        }
    },

    SVS_SEARCH(state, search) {
        state.svs.search = search;
    },

    CONFERENCE_TAB(state, tab) {
        state.navigation.conferenceTab = tab;
    },
}