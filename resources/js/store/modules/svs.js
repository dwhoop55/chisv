import api from "@/api";
import defines from "./defines";

const state = {
    data: {},
    search: "",
    sort: { field: 'firstname', direction: 'asc' },
    page: { items: 10, index: 1 },
    states: [],
    isLoading: false,
    showWaitlistPosition: true,
    showSvAvatar: true,
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
    showWaitlistPosition: state => state.showWaitlistPosition,
    showSvAvatar: state => state.showSvAvatar,
};

const actions = {
    async fetchSvs({ commit, rootGetters, getters }, key) {
        commit('setIsLoading', true);
        var params = [
            `sort_by=${getters.sortField}`,
            `sort_order=${getters.sortDirection}`,
            `page=${getters.page}`,
            `per_page=${getters.perPage}`
        ];

        if (getters.search) {
            params.push(`search=${getters.search}`);
        }

        if (getters.states.length > 0) {
            params.push(`only_states=${JSON.stringify(getters.states)}`);
        }


        api.getConferenceSvs(
            key || rootGetters['conference/conference'].key,
            params.join("&")
        )
            .then(({ data }) => {
                commit('setData', data);
            })
            .catch(error => {
                commit('setData', null);
            })
            .finally(() => {
                commit('setIsLoading', false);
            })
    }
};

const mutations = {
    setData: (state, data) => (state.data = data),
    setSearch: (state, search) => (state.search = search),
    setSortField: (state, field) => (state.sort.field = field || 'firstname'),
    setSortDirection: (state, direction) => (state.sort.direction = direction || 'asc'),
    setPerPage: (state, perPage) => (state.page.items = perPage),
    setPage: (state, page) => (state.page.index = page),
    setStates: (state, states) => (state.states = [...new Set(states)]),
    setIsLoading: (state, bool) => (state.isLoading = bool),
    setShowWaitlistPosition: (state, bool) => (state.showWaitlistPosition = bool),
    setShowSvAvatar: (state, bool) => (state.showSvAvatar = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};