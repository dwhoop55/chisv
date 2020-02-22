export default {
    tasksColumns: state => {
        return state.tasks.columns;
    },
    tasksSearch: state => {
        return state.tasks.search;
    },
    tasksDay: state => {
        return state.tasks.day;
    },
    tasksSortField: state => {
        return state.tasks.sort.field;
    },
    tasksSortDirection: state => {
        return state.tasks.sort.direction;
    },
    tasksPerPage: state => {
        return parseInt(state.tasks.page.items);
    },
    tasksPage: state => {
        return parseInt(state.tasks.page.index);
    },
    tasksPriorities: state => {
        return state.tasks.priorities;
    },
    tasksOnlyOwnTasks: state => {
        return state.tasks.onlyOwnTasks;
    },

    assignmentsColumns: state => {
        return state.assignments.columns;
    },
    assignmentsSearch: state => {
        return state.assignments.search;
    },
    assignmentsDay: state => {
        return state.assignments.day;
    },
    assignmentsSortField: state => {
        return state.assignments.sort.field;
    },
    assignmentsSortDirection: state => {
        return state.assignments.sort.direction;
    },
    assignmentsPerPage: state => {
        return parseInt(state.assignments.page.items);
    },
    assignmentsPage: state => {
        return parseInt(state.assignments.page.index);
    },

    svsSearch: state => {
        return state.svs.search;
    },
    svsPerPage: state => {
        return parseInt(state.svs.page.items);
    },
    svsPage: state => {
        return parseInt(state.svs.page.index);
    },

    reportData: state => {
        return state.report.data;
    },
    reportColumns: state => {
        return state.report.columns;
    },
    reportUpdated: state => {
        return state.report.updated;
    },
    reportSelected: state => {
        return state.report.selected;
    },
    reportPaginated: state => {
        return state.report.page.paginated;
    },
    reportPerPage: state => {
        return parseInt(state.report.page.items);
    },
    reportPage: state => {
        return parseInt(state.report.page.index);
    },

    userIndexSearch: state => {
        return state.userIndex.search;
    },
    userIndexUniversity: state => {
        return state.userIndex.university;
    },
    userIndexPerPage: state => {
        return parseInt(state.userIndex.page.items);
    },
    userIndexPage: state => {
        return parseInt(state.userIndex.page.index);
    },
    userIndexSortField: state => {
        return state.userIndex.sort.field;
    },
    userIndexSortDirection: state => {
        return state.userIndex.sort.direction;
    },
    userIndexData: state => {
        return state.userIndex.data;
    },

    conferenceTab: state => {
        return state.navigation.conferenceTab;
    },
    profileTab: state => {
        return state.navigation.profileTab;
    },
    lastConference: state => {
        return state.navigation.lastConference;
    }
}