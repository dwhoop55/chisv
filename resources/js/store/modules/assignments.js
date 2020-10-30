import api from "@/api";

const state = {
    columns: ['start_at', 'end_at', 'hours', 'name', 'location', 'description', 'slots', 'priority', 'bids'],
    search: "",
    sort: { field: 'start_at', direction: 'asc' },
    page: { items: 10, index: 1 },
    day: new Date(),
    interval: [null, null],
    data: {},
    showAssignmentsAvatar: true,
};

const getters = {
    columns: state => state.columns,
    search: state => state.search,
    day: state => new Date(state.day),
    interval: state => state.interval,
    sortField: state => state.sort.field,
    sortDirection: state => state.sort.direction,
    perPage: state => parseInt(state.page.items),
    page: state => parseInt(state.page.index),
    data: state => state.data,
    users: state => state.data?.users,
    tasks: state => state.data?.tasks,
    totalTasks: state => state.data?.total,
    showAssignmentsAvatar: state => state.showAssignmentsAvatar,
};

const actions = {
    async fetchAssignments({ commit, rootGetters, getters, state }) {
        return new Promise((resolve, reject) => {
            const conferenceKey = rootGetters['conference/conference'].key;
            var params = [
                `sort_by=${getters.sortField}`,
                `sort_order=${getters.sortDirection}`,
                `page=${getters.page}`,
                `per_page=${getters.perPage}`,
                `day=${getters.day.toMySqlDate()}`,
            ];

            if (getters.interval[0] || getters.interval[1]) {
                params.push(`interval=${JSON.stringify(getters.interval)}`);
            }

            if (getters.search) {
                params.push(`search=${getters.search}`);
            }

            api.getConferenceAssignments(
                conferenceKey,
                params.join("&")
            )
                .then(({ data }) => {
                    commit('setData', data);
                    resolve(data);
                })
                .catch(error => {
                    commit('setData', null);
                    reject(error);
                })

        });

    }
};

const mutations = {
    setColumns: (state, columns) => (state.columns = columns),
    setSearch: (state, search) => (state.search = search),
    setDay: (state, day) => (state.day = new Date(day) || new Date()),
    setInterval: (state, interval) => (state.interval = interval),
    setSortField: (state, field) => (state.sort.field = field || 'start_at'),
    setSortDirection: (state, direction) => (state.sort.direction = direction || 'asc'),
    setPerPage: (state, perPage) => (state.page.items = perPage),
    setPage: (state, page) => (state.page.index = page),
    setData: (state, data) => (state.data = data),
    setShowAssignmentsAvatar: (state, bool) => (state.showAssignmentsAvatar = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};