<template>
    <section v-if="oneSlide" class="about-us-block">
        <div class="container">
            <SliderWrapper :slides="aboutUsSlides" class="slider"/>
            <img src="/images/aboutUs/about-us-block-background.png" alt="about-us-block-decor" class="about-us-decor">
        </div>
    </section>
</template>

<script>
import SliderWrapper from "@/components/aboutUs/sliderWrapper.vue";
import {mapActions, mapState} from "vuex";

export default {
    name: "aboutUsBlock",
    components: {
        SliderWrapper
    },
    computed: {
        oneSlide: function () {
            return this.aboutUsSlides.length
        },
        ...mapState('slidesFromAboutUsBlock', ['aboutUsSlides'])
    },
    methods: {
        ...mapActions('slidesFromAboutUsBlock', ['GET_ABOUT_US_SLIDES']),
    },
    created() {
        this.GET_ABOUT_US_SLIDES()
    }
}
</script>

<style scoped lang="scss">
@import "src/assets/styles/global";
    .about-us-block {
        padding: 96px 0;
        background: rgba(123, 149, 97, 0.52);
        position: relative;

        .slider {
            z-index: 2;
        }
        .about-us-decor {
            position: absolute;
            left: -100px;
            bottom: -44px;
            width: 810px;
            height: 408px;
        }
    }
</style>
