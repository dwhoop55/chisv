import api from "@/api";

const state = {
    data: null,
    columns: null,
    updated: null,
    selected: null,
    page: { items: 20, index: 1, paginated: false, multiSort: false },
    isLoading: false,
};

const getters = {
    data: state => state.data,
    columns: state => state.columns,
    updated: state => state.updated,
    selected: state => state.selected,
    paginated: state => state.page.paginated,
    multiSort: state => state.page.multiSort,
    perPage: state => state.page.items,
    page: state => state.page.index,
    isLoading: state => state.isLoading,
};

const actions = {
    async fetchReport({ commit, rootGetters, getters, state }, { key, name }) {
        commit('setIsLoading', true);
        api.getReport(key || rootGetters['conference/conference'].key, name || getters.selected)
            .then(({ data }) => {
                commit('setData', data.data);
                commit('setColumns', data.columns);
                commit('setUpdated', data.updated);
                commit('setPaginated', data.paginate);
                commit('setPage', 1);
            })
            .catch(error => {
                commit('setData', null);
                commit('setColumns', null);
                commit('setUpdated', null);
            })
            .finally(() => {
                commit('setIsLoading', false);
            })

    },
}

const mutations = {
    setData: (state, data) => (state.data = data),
    setColumns: (state, columns) => (state.columns = columns),
    setUpdated: (state, updated) => (state.updated = updated),
    setSelected: (state, selected) => (state.selected = selected),
    setPaginated: (state, paginated) => (state.page.paginated = paginated),
    setMultiSort: (state, multiSort) => (state.page.multiSort = multiSort),
    setPerPage: (state, perPage) => (state.page.items = perPage),
    setPage: (state, page) => (state.page.index = page),
    setIsLoading: (state, bool) => (state.isLoading = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};