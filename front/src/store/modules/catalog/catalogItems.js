import axios from "axios";

const catalogItems = {
    namespaced: true,
    state: {
        catalogItems: []
    },
    actions: {
        async GET_CATALOG_ITEMS({ commit }) {
            axios
                .get('/requests/catalog/catalogItems.json')
                .then(response => {
                    const data = response.data
                    commit('SET_CATALOG_ITEMS', data)
                })
        }
    },
    mutations: {
        SET_CATALOG_ITEMS(state, data) {
            state.catalogItems = data.catalogItems
        }
    },
}
export default catalogItems
