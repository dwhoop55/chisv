
export default {
    INIT(state) {
        return
    },
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
    SVS_PER_PAGE(state, perPage) {
        state.svs.page.items = perPage;
    },
    SVS_PAGE(state, page) {
        state.svs.page.index = page;
    },

    USER_INDEX_SEARCH(state, search) {
        state.userIndex.search = search;
    },
    USER_INDEX_UNIVERSITY(state, university) {
        state.userIndex.university = university;
    },
    USER_INDEX_PER_PAGE(state, perPage) {
        state.userIndex.page.items = perPage;
    },
    USER_INDEX_PAGE(state, page) {
        state.userIndex.page.index = page;
    },
    USER_INDEX_SORT_FIELD(state, field) {
        if (field) {
            state.userIndex.sort.field = field;
        }
    },
    USER_INDEX_SORT_DIRECTION(state, direction) {
        if (direction) {
            state.userIndex.sort.direction = direction;
        }
    },
    USER_INDEX_DATA(state, data) {
        state.userIndex.data = data;
    },

    REPORT_DATA(state, data) {
        state.report.data = data;
    },
    REPORT_COLUMNS(state, columns) {
        state.report.columns = columns;
    },
    REPORT_UPDATED(state, date) {
        state.report.updated = date;
    },
    REPORT_SELECTED(state, selected) {
        state.report.selected = selected;
    },
    REPORT_PAGINATED(state, bool) {
        state.report.page.paginated = bool;
    },
    REPORT_PER_PAGE(state, perPage) {
        state.report.page.items = perPage;
    },
    REPORT_PAGE(state, page) {
        state.report.page.index = page;
    },


    CONFERENCE_TAB(state, tab) {
        state.navigation.conferenceTab = tab;
    },
    PROFILE_TAB(state, tab) {
        state.navigation.profileTab = tab;
    },
    LAST_CONFERENCE(state, key) {
        state.navigation.lastConference = key;
    }
}