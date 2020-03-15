import api from "@/api";

const state = {
    data: null,
    columns: null,
    updated: null,
    selected: null,
    page: { items: 10, index: 1, paginated: false, multiSort: false },
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
};

const actions = {
    async fetchReport({ commit, rootGetters, getters, state }, { key, name }) {
        const response = await api.getReport(key || rootGetters['conference/conference'].key, name || getters.selected);
        commit('setData', response.data.data);
        commit('setColumns', response.data.columns);
        commit('setUpdated', response.data.updated);
        commit('setPaginated', response.data.paginate);
        commit('setPage', 1);
    }
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
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};