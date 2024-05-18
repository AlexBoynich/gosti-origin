<template>
    <div class="home">
        <CookieModal
            v-if="cookieModal"
            @closeModal="closeModal"
        />
        <mainBlock/>
        <aboutUsBlock id="about-us-block"/>
        <deliveryBlock id="delivery"/>
    </div>
</template>

<script>

import mainBlock from "@/components/mainBlock/mainBlock.vue";
import aboutUsBlock from "@/components/aboutUs/aboutUsBlock.vue";
import CookieModal from "../../components/cookieModal/cookieModal";
import deliveryBlock from "@/components/deliveryBlock/deliveryBlock.vue";

export default {
    name: 'HomeView',
    data() {
        return {
            cookieModal: true,
        }
    },
    methods: {
        closeModal() {
            this.cookieModal = false
        }
    },
    components: {
        CookieModal,
        aboutUsBlock,
        mainBlock,
        deliveryBlock
    },
    created() {
        if (!localStorage.getItem('cookieModal')) {
            localStorage.setItem('cookieModal', true);
            this.cookieModal = true;
        } else {
            localStorage.setItem('cookieModal', false);
            this.cookieModal = false;
        }
    }
}
</script>
<style scoped lang="scss">
.about-us-block {
    margin-top: -5px;
}
</style>
