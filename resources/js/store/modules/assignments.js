import api from "@/api";

const state = {
    columns: ['start_at', 'end_at', 'hours', 'name', 'location', 'description', 'slots', 'priority', 'bids', 'assignments'],
    search: "",
    sort: { field: 'start_at', direction: 'asc' },
    page: { items: 10, index: 1 },
    day: new Date(),
    data: {},
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
    data: state => state.data,
    users: state => state.data?.users,
    tasks: state => state.data?.tasks,
    totalTasks: state => state.data?.total,
    isLoading: state => state.isLoading,
};

const actions = {
    async fetchAssignments({ commit, rootGetters, getters, state }, key) {
        commit('setIsLoading', true);
        const params = [
            `sort_by=${getters.sortField}`,
            `sort_order=${getters.sortDirection}`,
            `page=${getters.page}`,
            `per_page=${getters.perPage}`,
            `search_string=${getters.search}`,
            `day=${getters.day.toMySqlDate()}`,
        ].join("&");

        const response = await api.getConferenceAssignments(
            key || rootGetters['conference/conference'].key,
            params
        );

        commit('setData', response.data);
        commit('setIsLoading', false);
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
    setData: (state, data) => (state.data = data),
    setIsLoading: (state, bool) => (state.isLoading = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};