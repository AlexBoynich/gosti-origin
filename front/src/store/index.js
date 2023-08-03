import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate';
import slidesFromMainBlock from "./modules/mainBlock/slidesFromMainBlock";
import leftPartFooterItems from "./modules/footer/leftPartFooterItems";
import categories from "./modules/catalog/categories";
import catalogItems from "./modules/catalog/catalogItems";
import cart from "./modules/cart/cart";

Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [createPersistedState()],
    modules: {
        slidesFromMainBlock,
        leftPartFooterItems,
        categories,
        catalogItems,
        cart
    }
})
