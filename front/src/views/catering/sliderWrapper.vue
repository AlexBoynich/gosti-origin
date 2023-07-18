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
                            @click="openSecondSlider"
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
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'
export default {
    name: "mainSlider",
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
    methods: {
        openSecondSlider () {
            console.log(1)
        }
    },
    components: {
        SwiperSlide,
        Swiper
    },
    props: ['slides'],
}
</script>

<style scoped lang="scss">
@import "src/assets/styles/global";
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
        width: 100%;
        height: 1100px;

        .slide {
            position: relative;
            overflow:hidden;
            width: 100%;
            height: 1071px;
            border-radius: 16px;

            img {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                object-fit: cover;
                width: 100%;
                height: 100%;
            }
        }
    }
    .arrows-box {
        display: flex;
        align-items: center;
        margin: 32px auto 120px;
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
