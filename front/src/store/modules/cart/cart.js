const cart = {
    namespaced: true,
    state: {
        cart: []
    },
    mutations: {
        SET_CART(state, arr) {
            state.cart = arr
        },
        DELETE_CART (state) {
            state.cart = []
        }
    },
}
export default cart
