import axios from "axios";

const footerSocials = {
    namespaced: true,
    state: {
        footerSocials: []
    },
    actions: {
        async GET_FOOTER_SOCIALS({ commit }) {
            axios
                .get('/api/footer/footerSocials.json')
                .then(response => {
                    const data = response.data
                    commit('SET_FOOTER_SOCIALS', data)
                })
        }
    },
    mutations: {
        SET_FOOTER_SOCIALS(state, data) {
            state.footerSocials = data.footerSocials
        }
    },
}
export default footerSocials