import axios from "axios";

const slidesFromAboutUsBlock = {
    namespaced: true,
    state: {
        aboutUsSlides: []
    },
    actions: {
        async GET_ABOUT_US_SLIDES({ commit }) {
            axios
                .get('/requests/aboutUs/slidesForAboutUsBlock.json')
                .then(response => {
                    const data = response.data
                    commit('SET_ABOUT_US_SLIDES', data)
                })
        }
    },
    mutations: {
        SET_ABOUT_US_SLIDES(state, data) {
            state.aboutUsSlides = data.slides
        }
    },
}
export default slidesFromAboutUsBlock
