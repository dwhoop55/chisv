import api from "@/api";
import defines from "./defines";

const state = {
    svs: null,
    search: "",
    sort: { field: 'firstname', direction: 'asc' },
    page: { items: 10, index: 1 },
    states: [],
    isLoading: false,
    showWaitlistPosition: true,
    showSvAvatar: true,
    columns: [
        'firstname',
        'lastname',
        'university',
        'hours',
        'lottery_position',
        'state',
        'enrolled_at'
    ]
};

const getters = {
    svs: state => state.svs,
    search: state => state.search,
    sortField: state => state.sort.field,
    sortDirection: state => state.sort.direction,
    perPage: state => parseInt(state.page.items),
    page: state => parseInt(state.page.index),
    states: state => state.states,
    isLoading: state => state.isLoading,
    showWaitlistPosition: state => state.showWaitlistPosition,
    showSvAvatar: state => state.showSvAvatar,
    columns: state => state.columns,
};

const actions = {
    async fetchSvs({ commit, rootGetters, getters }, hideLoading) {
        !hideLoading && commit('setIsLoading', true);

        var params = [];
        if (getters.search) {
            params.push(`search=${getters.search}`);
        }

        if (getters.states.length > 0) {
            params.push(`only_states=${JSON.stringify(getters.states)}`);
        }

        params.push(`columns=${JSON.stringify(getters.columns)}`);

        api.getConferenceSvs(
            rootGetters['conference/conference'].key,
            params.join("&")
        )
            .then(({ data }) => {
                commit('setSvs', data);
            })
            .catch(error => {
                commit('setSvs', null);
            })
            .finally(() => {
                !hideLoading && commit('setIsLoading', false);
            })
    }
};

const mutations = {
    setSvs: (state, data) => (state.svs = data),
    setSearch: (state, search) => (state.search = search),
    setSortField: (state, field) => (state.sort.field = field || 'firstname'),
    setSortDirection: (state, direction) => (state.sort.direction = direction || 'asc'),
    setPerPage: (state, perPage) => (state.page.items = perPage),
    setPage: (state, page) => (state.page.index = page),
    setStates: (state, states) => (state.states = [...new Set(states)]),
    setIsLoading: (state, bool) => (state.isLoading = bool),
    setShowWaitlistPosition: (state, bool) => (state.showWaitlistPosition = bool),
    setShowSvAvatar: (state, bool) => (state.showSvAvatar = bool),
    setColumns: (state, columns) => (state.columns = columns),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};