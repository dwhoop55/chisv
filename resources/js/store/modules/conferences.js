import api from "@/api";
import { methods as mixins } from '@/mixins';

const state = {
    conferences: [],
    isLoading: false,
};

const getters = {
    conferences: state => state.conferences,
    isLoading: state => state.isLoading,
    conferenceDays: state => {
        var allDays = [];
        state.conferences.forEach(conference => {
            if (!conference.start_date || !conference.end_date) {
                return null;
            }
            var start = mixins.dateFromMySql(conference.start_date);
            var end = mixins.dateFromMySql(conference.end_date);

            var dayNumber = 1;
            for (var d = start; d <= end; d.setDate(d.getDate() + 1)) {
                allDays.push({
                    date: new Date(d),
                    type: "is-primary",
                    dayNumber,
                    name: conference.name,
                    key: conference.key
                });
                dayNumber++;
            }
        });
        return allDays;
    },
};

const actions = {
    async fetchConferences({ commit }) {
        commit('setIsLoading', true);
        api.getConferences()
            .then(({ data }) => {
                commit('setConferences', data);
            })
            .catch(error => {
                commit('setConferences', null);
            })
            .finally(() => {
                commit('setIsLoading', false);
            })
    }
};

const mutations = {
    setConferences: (state, conferences) => (state.conferences = conferences),
    setIsLoading: (state, bool) => (state.isLoading = bool),
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};