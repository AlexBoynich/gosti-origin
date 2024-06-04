import axios from "axios";

const cart = {
    namespaced: true,
    state: {
        cart: [],
        cartItemIsDelete: false
    },
    actions: {
        GET_DISHES({commit}, params) {
            axios
                .get('https://gosti-dev.tomsk-it.ru/api/check-dishes', {
                    params: {
                        arr: params
                    }
                })
                .then(response => {
                    const data = response.data
                    commit('SET_DISHES', data)
                })
        }
    },
    mutations: {
        ADD_IN_CART(state, el) {
            state.cart.push(el)
        },
        SET_CART(state, arr) {
            state.cart = arr
        },
        DELETE_CART(state) {
            state.cart = []
        },
        SET_DISHES(state, data) {
            let onlyId = state.cart.map((el) => el.id.toString())
            if (JSON.stringify(onlyId) !== JSON.stringify(data.data)) {
                for (let i = 0; i < state.cart.length; i++) {
                    if (!data.data.includes(state.cart[i].id.toString())) {
                        state.cart.splice(i, 1);
                        i--;
                    }
                }
                state.cartItemIsDelete = true
                setTimeout(() => {
                    state.cartItemIsDelete = false
                }, 5000)
            }
        }
    },
}
export default cart
