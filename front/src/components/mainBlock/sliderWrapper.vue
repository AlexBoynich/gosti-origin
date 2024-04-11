<template>
    <div class="slider-box">
        <div class="arrow-box">
            <button
                v-if="slides.length > 1"
                :class="['arrows arrow_prev main']"
            >
                <img src="/images/homePage/mainBlock/slider-button-next.svg" alt="arrow"/>
            </button>
            <button
                v-if="slides.length > 1"
                :class="['arrows arrow_next main']"
            >
                <img src="/images/homePage/mainBlock/slider-button-next.svg" alt="arrow"/>
            </button>
        </div>
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
                    <img
                        :src="slide"
                        alt="slide"
                    />
                </swiper-slide>
            </swiper>
        </div>
        <div class="pagination-position">
            <div v-if="slides.length > 1" :class="['swiper-pagination main']"></div>
        </div>
    </div>
</template>

<script>

import {Swiper, SwiperSlide} from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'
import '@/assets/styles/slider.scss'

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
                pagination: {
                    el: '.swiper-pagination.main',
                    type: 'bullets',
                    clickable: true
                },
                navigation: {
                    nextEl: '.arrow_next.main',
                    prevEl: '.arrow_prev.main',
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
        Swiper,
        SwiperSlide,
    },
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.slider-box {
    width: 100%;

    .arrow-box {
        position: absolute;
        max-width: 1240px;
        width: 100%;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;
        @include mobile {
            display: none;
        }

        .arrows {
            position: absolute;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 1px solid #CECECE4D;
            background: rgba(255, 255, 255, 0.3);
            padding: 28px;
            border-radius: 42px;
            top: 50%;

            &.arrow_prev {
                left: 0;
                transform: rotate(180deg);
            }

            &.arrow_next {
                right: 0;
            }

            img {
                width: 15px;
                height: 15px;
            }
        }
    }

    .slider-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;

        .swiper {
            display: flex;

            img {
                width: 100%;
                height: 100vh;
                @include mobile {
                    aspect-ratio: 360/200;
                    height: auto;
                }
            }
        }
    }
}

</style>
