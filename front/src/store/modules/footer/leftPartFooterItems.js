import axios from "axios";

const leftPartFooterItems = {
    namespaced: true,
    state: {
        leftPartFooterItems: []
    },
    actions: {
        async GET_LEFT_PART_FOOTER_ITEMS({ commit }) {
            axios
                .get('/requests/footer/leftPartFooterItems.json')
                .then(response => {
                    let data = response.data
                    commit('SET_LEFT_PART_FOOTER_ITEMS', data)
                })
        }
    },
    mutations: {
        SET_LEFT_PART_FOOTER_ITEMS(state, data) {
            data.leftPartFooterItems[1].descItems.push({img: '/images/footer/footer-left-part-time-icon.svg', desc: 'Воскресенье 08.00 - 22.00'})
            console.log( data.leftPartFooterItems[1].descItems)

            state.leftPartFooterItems = data.leftPartFooterItems
        }
    },
}
export default leftPartFooterItems
