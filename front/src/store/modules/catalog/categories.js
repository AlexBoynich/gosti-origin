import axios from "axios";

const categories = {
    namespaced: true,
    state: {
        categories: []
    },
    actions: {
        async GET_CATEGORIES({ commit }) {
            axios
                .get('/requests/catalog/categories.json')
                .then(response => {
                    const data = response.data
                    commit('SET_CATEGORIES', data)
                })
        }
    },
    mutations: {
        SET_CATEGORIES(state, data) {
            state.categories = data.data
        }
    },
}
export default categories
