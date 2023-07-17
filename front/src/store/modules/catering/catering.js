import axios from "axios";

const catering = {
    namespaced: true,
    state: {
        cateringSlides: []
    },
    actions: {
        async GET_CATERING({ commit }) {
            axios
                .get('/requests/catering/cateringSlides.json')
                .then(response => {
                    const data = response.data
                    commit('SET_CATERING', data)
                })
        }
    },
    mutations: {
        SET_CATERING(state, data) {
            state.cateringSlides = data.data
        }
    },
}
export default catering
