import Vue from 'vue'
import Vuex from 'vuex'
import slidesFromMainBlock from "@/store/modules/mainBlock/slidesFromMainBlock";
import slidesFromAboutUsBlock from "@/store/modules/aboutUs/slidesFromAboutUsBlock";
import leftPartFooterItems from "@/store/modules/footer/leftPartFooterItems";
import footerSocials from "@/store/modules/footer/footerSocials";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        slidesFromMainBlock,
        slidesFromAboutUsBlock,
        leftPartFooterItems,
        footerSocials
    }
})
