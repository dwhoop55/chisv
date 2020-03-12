import api from "@/api";

const state = {
    data: null,
    search: "",
    university: null,
    sort: { field: 'firstname', direction: 'asc' },
    page: { items: 25, index: 1 },
    isLoading: false,
};

const getters = {
    search: state => state.search,
    university: state => state.university,
    perPage: state => parseInt(state.page.items),
    page: state => parseInt(state.page.index),
    sortField: state => state.sort.field,
    sortDirection: state => state.sort.direction,
    data: state => state.data,
    isLoading: state => state.isLoading
};

const actions = {
    async fetchUsers({ commit, getters }) {
        commit('setIsLoading', true);
        var params = [
            `sort_by=${getters.sortField}`,
            `sort_order=${getters.sortDirection}`,
            `page=${getters.page}`,
            `per_page=${getters.perPage}`,
            `search=${getters.search}`
        ];

        if (getters.university && getters.university.id) {
            params.push(`university_id=${getters.university.id}`);
        } else if (getters.university) {
            params.push(`university_fallback=${getters.university.name}`);
        }
        params = params.join("&");

        const response = await api.getUsers(params);

        commit('setData', response.data);
        commit('setIsLoading', false);
    },
};

const mutations = {
    setData: (state, data) => state.data = data,
    setUniversity: (state, university) => state.university = university,
    setSearch: (state, search) => (state.search = search),
    setSortField: (state, field) => (state.sort.field = field || 'start_at'),
    setSortDirection: (state, direction) => (state.sort.direction = direction || 'asc'),
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