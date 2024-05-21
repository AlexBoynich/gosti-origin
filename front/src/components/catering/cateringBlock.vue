<template>
    <div class="catering-block">
        <div class="message">
            <div class="txt">Вы можете ознакомиться с меню нашего кейтеринга и позвонить по номеру телефона
                <a
                    :href="leftPartFooterItems[0].descItems[1].href"
                    class="phone"
                >
                    {{ phoneNumber }}
                </a>
            </div>
        </div>
        <div class="catering-sliders">
            <MainSlider 
            :slides="cateringSlidesMobile"
            v-if="width<=800"
            />
            <MainSlider 
            :slides="cateringSlides"
            v-else
            />
        </div>
    </div>
</template>

<script>
import {mapState} from "vuex";
import MainSlider from "./sliderWrapper";

export default {
    name: "cateringBlock",
    data () {
        return {
            cateringSlides: [
                '/images/catering/keit-page-1.png',
                '/images/catering/keit-page-2.png'
            ],
            cateringSlidesMobile: [
                '/images/catering/keit-page-mobile-1.svg',
                '/images/catering/keit-page-mobile-2.svg'
            ],
            width: 0
        }
    },
    components: {MainSlider},
    computed: {
        ...mapState('leftPartFooterItems', ['leftPartFooterItems']),
        phoneNumber: function () {
            return this.leftPartFooterItems[0].descItems[1].desc
        }
    },
    created() {
        const onResize = () => this.width = window.innerWidth;
        onResize();
        window.addEventListener('resize', onResize);
        this.$on('hook:beforeDestroy', () => window.removeEventListener('resize', onResize));
    },
}
</script>

<style scoped lang="scss">

@import "@/assets/styles/global";

.container {

    .title {
        @include h2;
        margin-bottom: 16px;
        @include mobile {
            display: none;
        }
    }

    .message {
        border-radius: 5px;
        padding: 40px 93px 40px 88px;
        margin-bottom: 72px;
        background: #FFFFFF;
        border: 1px solid #7B9561;
    
        @include mobile {
            padding: 18px 20px;
            margin-bottom: 30px;
        }

        .txt {
            @include inter-400;
            color: #000;
            font-size: 20px;
            line-height: 140%;
            letter-spacing: -0.4px;
            @include mobile {  
                font-size: 14px;
                font-weight: 400;
                line-height: 18.9px;
                text-align: center;

            }

            .phone {
                text-decoration: none;
                color: black;
            }
        }
    }
}
</style>
