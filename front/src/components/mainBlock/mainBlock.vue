<template>
    <div v-if="oneSlide" class="main-block">
        <SliderWrapper :slides="mainBlockSlides"/>
    </div>
</template>

<script>
import SliderWrapper from "@/components/mainBlock/sliderWrapper.vue";
import {mapActions, mapState} from "vuex";

export default {
    name: "mainBlock",
    components: {
        SliderWrapper
    },
    computed: {
        oneSlide: function () {
            return this.mainBlockSlides.length
        },
        ...mapState('slidesFromMainBlock', ['mainBlockSlides'])
    },
    methods: {
        ...mapActions('slidesFromMainBlock', ['GET_MAIN_SLIDES']),
    },
    created() {
        this.GET_MAIN_SLIDES()
    }
}
</script>

<style scoped lang="scss">
.main-block {
    margin-top: 100px;
}
</style>
