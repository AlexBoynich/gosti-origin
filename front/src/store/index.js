import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate';
import slidesFromMainBlock from "./modules/mainBlock/slidesFromMainBlock";
import slidesFromAboutUsBlock from "./modules/aboutUs/slidesFromAboutUsBlock";
import leftPartFooterItems from "./modules/footer/leftPartFooterItems";
import footerSocials from "./modules/footer/footerSocials";
import categories from "./modules/catalog/categories";
import catalogItems from "./modules/catalog/catalogItems";
import cart from "./modules/cart/cart";
import catering from "./modules/catering/catering";

Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [createPersistedState()],
    modules: {
        slidesFromMainBlock,
        slidesFromAboutUsBlock,
        leftPartFooterItems,
        footerSocials,
        categories,
        catalogItems,
        cart,
        catering
    }
})
