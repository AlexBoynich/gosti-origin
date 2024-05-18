
const filters = {
    state: {
        filters: [true, true, true]
    },
    getters: {
        GET_SUGAR(state) {
            return state.filters[0];
        },
        GET_GLUTEN(state) {
            return state.filters[1];
        },
        GET_LACTOSE(state) {
            return state.filters[2];
        }
    },
    actions: {
        CHANGE_FILTER({commit}, data) {
            commit('SET_FILTER', data )
          },
    },
    mutations: {
        SET_FILTER(state, index) {
            state.filters.splice(index, 1, !state.filters[index])
        }
    },
}
export default filters
