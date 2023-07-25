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
                    <div class="slide">
                        <img
                            :src="slide"
                            alt="slide"
                        />
                    </div>
                </swiper-slide>
            </swiper>

        </div>
        <div class="arrows-box">
            <button
                v-if="slides.length > 1"
                class="arrows arrow_prev catering"
            >
                <img src="/images/homePage/aboutUs/about-us-button-next.svg" alt="arrow"/>
            </button>
            <button
                v-if="slides.length > 1"
                class="arrows arrow_next catering"
            >
                <img src="/images/homePage/aboutUs/about-us-button-next.svg" alt="arrow"/>
            </button>
        </div>
    </div>
</template>

<script>
import {Swiper, SwiperSlide} from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'

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
                spaceBetween: 20,
                loop: this.oneSlide,
                navigation: {
                    nextEl: '.arrow_next.catering',
                    prevEl: '.arrow_prev.catering',
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
    components: {
        SwiperSlide,
        Swiper
    },
    props: ['slides'],
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/global";

.slider-box {
    max-width: 827px;
    margin: 0 auto;
    width: 100%;

    .slider-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .swiper {
        display: flex;
        width: 100%;
        height: 1550px;

        .slide {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 16px;
        }
    }

    .arrows-box {
        display: flex;
        align-items: center;
        margin: 32px auto 120px;
        width: 280px;
        height: 48px;
        color: $olive;


        .arrows {
            z-index: 2;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 108px;
            height: 48px;
            color: $olive;

            &.arrow_prev {
                transform: rotate(180deg);
                margin-right: 64px;
                margin-top: -4px;
            }
        }
    }
}
</style>
