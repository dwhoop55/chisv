
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
    TASKS_ONLY_OWN_TASKS(state, bool) {
        state.tasks.onlyOwnTasks = bool;
    },


    ASSIGNMENTS_COLUMNS(state, columns) {
        state.assignments.columns = columns;
    },
    ASSIGNMENTS_SEARCH(state, search) {
        state.assignments.search = search;
    },
    ASSIGNMENTS_DAY(state, day) {
        if (day) {
            state.assignments.day = day;
        }
    },
    ASSIGNMENTS_SORT_FIELD(state, field) {
        if (field) {
            state.assignments.sort.field = field;
        }
    },
    ASSIGNMENTS_SORT_DIRECTION(state, direction) {
        if (direction) {
            state.assignments.sort.direction = direction;
        }
    },
    ASSIGNMENTS_PER_PAGE(state, perPage) {
        state.assignments.page.items = perPage;
    },
    ASSIGNMENTS_PAGE(state, page) {
        state.assignments.page.index = page;
    },


    SVS_SEARCH(state, search) {
        state.svs.search = search;
    },


    CONFERENCE_TAB(state, tab) {
        state.navigation.conferenceTab = tab;
    },
    PROFILE_TAB(state, tab) {
        state.navigation.profileTab = tab;
    },
}