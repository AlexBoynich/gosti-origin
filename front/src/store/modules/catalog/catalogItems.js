import axios from "axios";

const catalogItems = {
    namespaced: true,
    state: {
        catalogItems: []
    },
    actions: {
        async GET_CATALOG_ITEMS({ commit }, payload) {
            axios
                .get('https://gosti-dev.tomsk-it.ru/api/dishes?subcategory=' + payload.subcategoryId + '&' + payload.requestFilter)
                .then(response => {
                    const data = response.data
                    commit('SET_CATALOG_ITEMS', data)
                })
        }
    },
    mutations: {
        SET_CATALOG_ITEMS(state, data) {
            state.catalogItems = data.data
            for (let i = 0; i < state.catalogItems.length; i++) {
                if (!state.catalogItems[i].count) {
                    state.catalogItems[i].count = 0
                }
            }
        }
    },
}
export default catalogItems
