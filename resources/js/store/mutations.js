
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
    TASKS_PER_PAGE(state, perPage) {
        state.tasks.page.items = perPage;
    },
    TASKS_PAGE(state, page) {
        state.tasks.page.index = page;
    },
    TASKS_PRIORITIES(state, priorities) {
        state.tasks.priorities = priorities;
    },

    SVS_SEARCH(state, search) {
        state.svs.search = search;
    },

    CONFERENCE_TAB(state, tab) {
        state.navigation.conferenceTab = tab;
    },
}