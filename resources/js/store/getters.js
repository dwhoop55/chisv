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

    svsSearch: state => {
        return state.svs.search;
    },
    conferenceTab: state => {
        return state.navigation.conferenceTab;
    }
}