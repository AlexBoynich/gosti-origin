<template>
    <div class="home">
        <CookieModal
            v-if="cookieModal"
            @closeModal="closeModal"
        />
        <mainBlock/>
        <aboutUsBlock id="about-us-block"/>
        <deliveryBlock/>
        <EngineeringWorks
            v-if="engineeringWorks"
            @closeModal="closeModal"
        />
    </div>
</template>

<script>

import mainBlock from "@/components/mainBlock/mainBlock.vue";
import aboutUsBlock from "@/components/aboutUs/aboutUsBlock.vue";
import deliveryBlock from "@/components/deliveryBlock/deliveryBlock.vue";
import CookieModal from "../../components/cookieModal/cookieModal";
import EngineeringWorks from "../../components/engineeringWorks/engineeringWorks";

export default {
    name: 'HomeView',
    data() {
        return {
            cookieModal: true,
            engineeringWorks: true
        }
    },
    methods: {
        closeModal() {
            this.cookieModal = false
            this.engineeringWorks = false
        }
    },
    components: {
        EngineeringWorks,
        CookieModal,
        deliveryBlock,
        aboutUsBlock,
        mainBlock
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
