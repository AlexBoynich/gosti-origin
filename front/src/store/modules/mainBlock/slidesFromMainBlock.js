import axios from "axios";

const slidesFromMainBlock = {
    namespaced: true,
    state: {
        mainBlockSlides: []
    },
    actions: {
        async GET_MAIN_SLIDES({ commit }) {
            axios
                .get('/requests/mainBlock/slidesForMainBlock.json')
                .then(response => {
                    const data = response.data
                    commit('SET_MAIN_SLIDES', data)
                })
        }
    },
    mutations: {
        SET_MAIN_SLIDES(state, data) {
            state.mainBlockSlides = data.slides
        }
    },
}
export default slidesFromMainBlock
