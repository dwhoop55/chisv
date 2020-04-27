import api from "@/api";

const state = {
    columns: ['manage', 'bid', 'date', 'start_at', 'end_at', 'location', 'slots', 'priority', 'description', 'hours'],
    search: "",
    sort: { field: 'start_at', direction: 'asc' },
    page: { items: 10, index: 1 },
    priorities: [1, 2, 3],
    onlyOwnTasks: false,
    days: [],
    interval: [null, null],
    tasks: [],
    totalTasks: 0,
    isLoading: false,
    warnBeforeMultiBid: true,
};

const getters = {
    columns: state => state.columns,
    search: state => state.search,
    days: state => state.days.map(day => new Date(day)),
    interval: state => state.interval,
    sortField: state => state.sort.field,
    sortDirection: state => state.sort.direction,
    perPage: state => parseInt(state.page.items),
    page: state => parseInt(state.page.index),
    priorities: state => state.priorities,
    onlyOwnTasks: state => state.onlyOwnTasks,
    tasks: state => state.tasks,
    totalTasks: state => state.totalTasks,
    isLoading: state => state.isLoading,
    warnBeforeMultiBid: state => state.warnBeforeMultiBid,
};

const actions = {
    async fetchTasks({ commit, rootGetters, getters, state }, key) {
        commit('setIsLoading', true);
        const conferenceKey = key || rootGetters['conference/conference'].key;
        var params = [
            `sort_by=${getters.sortField}`,
            `sort_order=${getters.sortDirection}`,
            `page=${getters.page}`,
            `per_page=${getters.perPage}`,
        ]

        // If the user is admin, chair or captain we display the
        // priorities so we should add them to the query
        // (what is actually more important is that they are not there
        // when the user cannot see the picker in the UI or we would
        // limit tasks for bidding when a user is no captain anymore (e.g))
        if (rootGetters['auth/userIs']('admin') ||
            rootGetters['auth/userIs']('chair', conferenceKey) ||
            rootGetters['auth/userIs']('captain', conferenceKey)
        ) {
            params.push(`priorities=${JSON.stringify(getters.priorities)}`);
        }

        if (getters.days?.length > 0) {
            params.push(`days=${JSON.stringify(getters.days.map(day => day.toMySqlDate()))}`);
        }

        if (getters.interval[0] || getters.interval[1]) {
            params.push(`interval=${JSON.stringify(getters.interval)}`);
        }

        if (getters.search) {
            params.push(`search=${getters.search}`);
        }

        if (getters.onlyOwnTasks && rootGetters['auth/userIs']('sv', conferenceKey)) {
            params.push(`only_own_tasks=${getters.onlyOwnTasks ? 1 : 0}`);
        }

        api.getConferenceTasks(
            conferenceKey,
            params.join("&")
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
    setDays: (state, days) => (state.days = days || [new Date()]),
    setInterval: (state, interval) => (state.interval = interval || [null, null]),
    setSortField: (state, field) => (state.sort.field = field || 'start_at'),
    setSortDirection: (state, direction) => (state.sort.direction = direction || 'asc'),
    setPerPage: (state, perPage) => (state.page.items = perPage),
    setPage: (state, page) => (state.page.index = page),
    setPriorities: (state, priorities) => (state.priorities = priorities),
    setOnlyOwnTasks: (state, bool) => (state.onlyOwnTasks = bool),
    setTasks: (state, tasks) => (state.tasks = tasks),
    setTotalTasks: (state, total) => (state.totalTasks = total),
    setIsLoading: (state, bool) => (state.isLoading = bool),
    setWarnBeforeMultiBid: (state, bool) => (state.warnBeforeMultiBid = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};