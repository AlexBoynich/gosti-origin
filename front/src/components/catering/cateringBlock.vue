<template>
    <div class="catering-block">
        <h2 class="title">Кейтеринг</h2>
        <div class="message">
            <div class="txt">Вы можете ознакомиться с меню нашего кейтеринга и позвонить по номеру телефона
                <a
                    :href="leftPartFooterItems[0].descItems[1].href"
                    class="phone"
                >
                    {{ phoneNumber }}
                </a>
                .
            </div>
        </div>
        <div class="catering-sliders">
            <MainSlider :slides="cateringSlides"/>
        </div>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import MainSlider from "./sliderWrapper";

export default {
    name: "cateringBlock",
    components: {MainSlider},
    computed: {
        ...mapState('leftPartFooterItems', ['leftPartFooterItems']),
        ...mapState('catering', ['cateringSlides']),
        phoneNumber: function () {
            return this.leftPartFooterItems[0].descItems[1].desc
        }
    },
    methods: {
        ...mapActions('catering', ['GET_CATERING'])
    },
    created() {
        this.GET_CATERING()
    }
}
</script>

<style scoped lang="scss">
@import "src/assets/styles/global";

.container {

    .title {
        @include h2;
        margin-bottom: 16px;
    }

    .message {
        border-radius: 16px;
        padding: 40px 93px 40px 88px;
        margin-bottom: 72px;
        background: #DFE8D7;
        border-left: solid 5px $olive;

        .txt {
            @include inter-400;
            color: #000;
            font-size: 20px;
            line-height: 140%;
            letter-spacing: -0.4px;

            .phone {
                text-decoration: none;
                color: black;
            }
        }
    }
}
</style>
