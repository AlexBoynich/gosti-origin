const cart = {
    namespaced: true,
    state: {
        cart: []
    },
    mutations: {
        SET_CART(state, arr) {
            state.cart = arr
        }
    },
}
export default cart
