import axios from "axios";

const catalogItems = {
    namespaced: true,
    state: {
        catalogItems: []
    },
    actions: {
        async GET_CATALOG_ITEMS({ commit }, payload) {
            console.log(payload)
            axios
                .get('https://gosti-cafe.ru/api/dishes?subcategory=' + payload.subcategoryId + '&' + payload.requestFilter)
                .then(response => {
                    const data = response.data
                    commit('SET_CATALOG_ITEMS', data)
                })
        }
    },
    mutations: {
        SET_CATALOG_ITEMS(state, data) {
            state.catalogItems = data.data
        }
    },
}
export default catalogItems
