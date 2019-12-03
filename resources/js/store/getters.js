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

    svsSearch: state => {
        return state.svs.search;
    },
    conferenceTab: state => {
        return state.navigation.conferenceTab;
    }
}