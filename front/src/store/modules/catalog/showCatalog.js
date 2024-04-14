
const showCatalog = {
    state: {
        showCatalog: true
    },
    getters: {
        GET_SHOW_CATALOG(state) {
            return state.showCatalog;
        }
    },
    actions: {
        CHANGE_SHOW_CATALOG({commit}, data) {
            commit('SET_SHOW_CATALOG', data )
          },
    },
    mutations: {
        SET_SHOW_CATALOG(state, data) {
            state.showCatalog = data
        }
    },
}
export default showCatalog;