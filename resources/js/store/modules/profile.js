const state = {
    tab: 0,
};

const getters = {
    tab: state => state.tab,
};

const actions = {
};

const mutations = {
    setTab: (state, tab) => (state.tab = tab),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};