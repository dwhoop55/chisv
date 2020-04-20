import api from "@/api";

const state = {
    columns: ['manage', 'start_at', 'end_at', 'location', 'slots', 'priority', 'description', 'hours'],
    search: "",
    sort: { field: 'start_at', direction: 'asc' },
    page: { items: 10, index: 1 },
    priorities: [1, 2, 3],
    onlyOwnTasks: false,
    day: new Date(),
    tasks: [],
    totalTasks: 0,
    isLoading: false,
};

const getters = {
    columns: state => state.columns,
    search: state => state.search,
    day: state => new Date(state.day),
    sortField: state => state.sort.field,
    sortDirection: state => state.sort.direction,
    perPage: state => parseInt(state.page.items),
    page: state => parseInt(state.page.index),
    priorities: state => state.priorities,
    onlyOwnTasks: state => state.onlyOwnTasks,
    tasks: state => state.tasks,
    totalTasks: state => state.totalTasks,
    isLoading: state => state.isLoading,
};

const actions = {
    async fetchTasks({ commit, rootGetters, getters, state }, key) {
        commit('setIsLoading', true);
        const params = [
            `sort_by=${getters.sortField}`,
            `sort_order=${getters.sortDirection}`,
            `page=${getters.page}`,
            `per_page=${getters.perPage}`,
            `search_string=${getters.search}`,
            `priorities=${getters.priorities}`,
            `day=${getters.day.toMySqlDate()}`,
            `only_own_tasks=${getters.onlyOwnTasks}`
        ].join("&");

        api.getConferenceTasks(
            key || rootGetters['conference/conference'].key,
            params
        )
            .then(({ data }) => {
                commit('setTasks', data.data);
                commit('setTotalTasks', data.total);
            })
            .catch(error => {
                commit('setTasks', null);
                commit('setTotalTasks', 0);
            })
            .finally(() => {
                commit('setIsLoading', false);
            })
    }
};

const mutations = {
    setColumns: (state, columns) => (state.columns = columns),
    setSearch: (state, search) => (state.search = search),
    setDay: (state, day) => (state.day = new Date(day) || new Date()),
    setSortField: (state, field) => (state.sort.field = field || 'start_at'),
    setSortDirection: (state, direction) => (state.sort.direction = direction || 'asc'),
    setPerPage: (state, perPage) => (state.page.items = perPage),
    setPage: (state, page) => (state.page.index = page),
    setPriorities: (state, priorities) => (state.priorities = priorities),
    setOnlyOwnTasks: (state, bool) => (state.onlyOwnTasks = bool),
    setTasks: (state, tasks) => (state.tasks = tasks),
    setTotalTasks: (state, total) => (state.totalTasks = total),
    setIsLoading: (state, bool) => (state.isLoading = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};