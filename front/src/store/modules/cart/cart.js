const cart = {
    namespaced: true,
    state: {
        cart: []
    },
    mutations: {
        ADD_IN_CART(state, el) {
            state.cart.push(el)
        },
        SET_CART(state, arr) {
            state.cart = arr
        },
        DELETE_CART (state) {
            state.cart = []
        }
    },
}
export default cart
