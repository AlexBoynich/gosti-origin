import axios from "axios";

const leftPartFooterItems = {
    namespaced: true,
    state: {
        leftPartFooterItems: []
    },
    actions: {
        async GET_LEFT_PART_FOOTER_ITEMS({ commit }) {
            axios
                .get('requests/footer/leftPartFooterItems.json')
                .then(response => {
                    let data = response.data
                    commit('SET_LEFT_PART_FOOTER_ITEMS', data)
                })
        }
    },
    mutations: {
        SET_LEFT_PART_FOOTER_ITEMS(state, data) {
            state.leftPartFooterItems = data.leftPartFooterItems
        }
    },
}
export default leftPartFooterItems
