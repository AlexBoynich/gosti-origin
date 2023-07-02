import axios from "axios";

const catalogContent = {
    namespaced: true,
    state: {
        catalogContent: {},
        catalogItems: []
    },
    actions: {
        async GET_CATALOG_CONTENT({ commit }) {
            axios
                .get('/requests/catalog/catalogContent.json')
                .then(response => {
                    const data = response.data
                    commit('SET_CATALOG_CONTENT', data)
                })
        },
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
        SET_CATALOG_CONTENT(state, data) {
            state.catalogContent = data
        },
        SET_CATALOG_ITEMS(state, data) {
            state.catalogItems = data.catalogItems
        }
    },
}
export default catalogContent
