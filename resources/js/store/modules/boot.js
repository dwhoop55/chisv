import api from "@/api";


const actions = {
    async bootstrapRessources({ commit }, ressources) {
        return new Promise((resolve, reject) => {
            api.bootstrapRessources(ressources)
                .then(({ data }) => {
                    data.self && commit('auth/setUser', data.self, { root: true });
                    data.locales && commit('defines/setLocales', data.locales, { root: true });
                    data.shirts && commit('defines/setShirts', data.shirts, { root: true });
                    data.degrees && commit('defines/setDegrees', data.degrees, { root: true });
                    data.languages && commit('defines/setLanguages', data.languages, { root: true });
                    data.countries && commit('defines/setCountries', data.countries, { root: true });
                    data.states && commit('defines/setStates', data.states, { root: true });
                    data.roles && commit('defines/setRoles', data.roles, { root: true });
                    data.timezones && commit('defines/setTimezones', data.timezones, { root: true });
                    data.version && commit('defines/setVersion', data.version, { root: true });
                    resolve(data);
                })
                .catch(error => reject(error));
        });
    },
};

export default {
    namespaced: true,
    actions,
};