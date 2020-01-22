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