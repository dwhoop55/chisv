import api from "@/api";

const state = {
    data: null,
    search: "",
    sort: { field: 'firstname', direction: 'asc' },
    page: { items: 10, index: 1 },
    states: null,
    isLoading: false,
};

const getters = {
    data: state => state.data,
    search: state => state.search,
    sortField: state => state.sort.field,
    sortDirection: state => state.sort.direction,
    perPage: state => parseInt(state.page.items),
    page: state => parseInt(state.page.index),
    states: state => state.states,
    isLoading: state => state.isLoading,
};

const actions = {
    async fetchSvs({ commit, rootGetters, getters }, key) {
        commit('setIsLoading', true);
        const params = [
            `sort_by=${getters.sortField}`,
            `sort_order=${getters.sortDirection}`,
            `page=${getters.page}`,
            `per_page=${getters.perPage}`,
            `search_string=${getters.search}`,
            `selected_states=${getters.states}`
        ].join("&");

        const response = await api.getConferenceSvs(
            key || rootGetters['conference/conference'].key,
            params
        );

        commit('setData', response.data);
        commit('setIsLoading', false);
    }
};

const mutations = {
    setData: (state, data) => (state.data = data),
    setSearch: (state, search) => (state.search = search),
    setSortField: (state, field) => (state.sort.field = field || 'firstname'),
    setSortDirection: (state, direction) => (state.sort.direction = direction || 'asc'),
    setPerPage: (state, perPage) => (state.page.items = perPage),
    setPage: (state, page) => (state.page.index = page),
    setStates: (state, states) => (state.states = states),
    setIsLoading: (state, bool) => (state.isLoading = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};