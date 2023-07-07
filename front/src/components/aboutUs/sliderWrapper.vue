<template>
    <div class="slider-box">
        <div class="slider-wrapper">
            <swiper
                    class="swiper"
                    :options="swiperOption"
                    :slides="slides"
            >
                <swiper-slide
                        v-for="(slide, index) in slides"
                        :key="index"
                >
                    <aboutUsSlide
                            value="slide"
                            :slide="slide"
                    />
                </swiper-slide>
            </swiper>

        </div>
        <div class="arrows-box">
            <button
                    v-if="slides.length > 1"
                    class="arrows arrow_prev about-us"
            >
                <img src="/images/aboutUs/about-us-button-next.svg" alt="arrow"/>
            </button>
            <button
                    v-if="slides.length > 1"
                    class="arrows arrow_next about-us"
            >
                <img src="/images/aboutUs/about-us-button-next.svg" alt="arrow"/>
            </button>
        </div>
    </div>
</template>

<script>

import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'
import '@/assets/styles/slider.scss'
import aboutUsSlide from "@/components/aboutUs/aboutUsSlide.vue";

export default {
    name: "sliderWrapper",
    computed: {
        oneSlide() {
            return this.slides.length > 1
        },
        swiperOption() {
            return {
                slidesPerView: 1,
                slidesPerGroup: 1,
                allowTouchMove: false,
                loop: this.oneSlide,
                navigation: {
                    nextEl: '.arrow_next.about-us',
                    prevEl: '.arrow_prev.about-us',
                },
                autoplay: {
                    delay: 10000,
                    disableOnInteraction: false
                },
                on: {
                    init() {
                        this.el.addEventListener('mousedown', () => {
                            this.autoplay.stop();
                        });

                        this.el.addEventListener('mouseup', () => {
                            this.autoplay.start();
                        });
                    }
                }
            }
        },
    },
    props: ['slides'],
    components: {
        SwiperSlide,
        aboutUsSlide,
        Swiper
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
.slider-box {
    max-width: 1240px;
    width: 100%;

    .slider-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .swiper {
        display: flex;

        img {
            width: 100%;
            height: 800px;
        }
    }
    .arrows-box {
        display: flex;
        align-items: center;
        margin-top: 24px;
        margin-right: 156px;
        margin-left: auto;
        width: 280px;
        height: 48px;
        color: $greenBackground;


        .arrows {
            z-index: 2;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 108px;
            height: 48px;
            color: $greenBackground;

            &.arrow_prev {
                transform: rotate(180deg);
                margin-right: 64px;
                margin-top: -4px;
            }
        }
    }
}
</style>
