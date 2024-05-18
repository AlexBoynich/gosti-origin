import axios from "axios";

const slidesFromMainBlock = {
    namespaced: true,
    state: {
        mainBlockSlides: []
    },
    actions: {
        async GET_MAIN_SLIDES({ commit }) {
            axios
                .get('/api/main-block')
                .then(response => {
                    const data = response.data
                    commit('SET_MAIN_SLIDES', data)
                })
        }
    },
    mutations: {
        SET_MAIN_SLIDES(state, data) {
            state.mainBlockSlides = data.data
        }
    },
}
export default slidesFromMainBlock
