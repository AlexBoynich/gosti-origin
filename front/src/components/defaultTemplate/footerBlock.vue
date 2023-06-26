<template>
    <footer>
        <div class="container">
            <div class="footer-top">
                <div class="left-part">
                    <div class="left-part-top">
                        <div class="left-part-top-items"
                            v-for="(item, index) in leftPartFooterItems"
                             :key="index"
                        >
                            <div class="title">{{ item.title }}</div>
                            <div class="desc-box">
                                <div class="desc-item"
                                    v-for="(descItem, i) in item.descItems"
                                    :key="i"
                                >
                                    <img :src="descItem.img" alt="desc-item">
                                    <a
                                        v-if="descItem.isClickable"
                                        :href="descItem.href"
                                        class="desc"
                                    >
                                        {{ descItem.desc }}
                                    </a>
                                    <div v-else class="desc">{{ descItem.desc }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-part-bottom">
                        <a
                           v-for="(item, index) in footerSocials"
                           :key="index"
                           :href="item.link"
                        >
                            <img
                                :src="item.img"
                                alt="footer-social-icon"
                                class="footer-social"
                            >
                        </a>
                    </div>
                </div>
                <div class="right-part">
                    <footerMap />
                </div>
            </div>
            <div class="hr"></div>
            <div class="footer-bottom">
                <router-link to="/" class="footer-link">
                    Политика конфиденциальности
                </router-link>
            </div>
        </div>
    </footer>
</template>

<script>
import footerMap from "@/components/map/footerMap";
import {mapActions, mapState} from "vuex";
export default {
    name: "footerBlock",
    components: {
        footerMap
    },
    computed: {
        ...mapState('leftPartFooterItems', ['leftPartFooterItems']),
        ...mapState('footerSocials', ['footerSocials'])
    },
    methods: {
        ...mapActions('leftPartFooterItems', ['GET_LEFT_PART_FOOTER_ITEMS']),
        ...mapActions('footerSocials', ['GET_FOOTER_SOCIALS'])
    },
    created() {
        this.GET_LEFT_PART_FOOTER_ITEMS()
        this.GET_FOOTER_SOCIALS()
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

footer {
    width: 100%;
    background: rgba(123, 149, 97, 0.65);

    .footer-top {
        padding: 48px 0;
        display: flex;
        justify-content: space-between;

        .left-part {
            max-width: 530px;
            display: flex;
            justify-content: space-between;
            flex-direction: column;

            .left-part-top {
                display: flex;
                justify-content: space-between;
                gap: 0 40px;

                .left-part-top-items {

                    .title {
                        @include comforta-500;
                        margin-bottom: 16px;
                    }
                    .desc-box {
                        display: flex;
                        flex-direction: column;
                        gap: 18px 0;

                        .desc-item {
                            display: flex;
                            align-items: center;

                            img {
                                margin-right: 8px;
                                width: 24px;
                                height: 24px;
                            }

                            .desc {
                                text-decoration: none;
                                @include inter-300;
                                font-size: 20px;
                                line-height: 36px;
                                color: black;
                            }
                        }
                    }
                }
            }
            .left-part-bottom {
                display: flex;
                align-items: center;
                gap: 0 16px;
            }
        }
    }
    .hr {
        width: 100%;
        height: 0.5px;
        background: black;
    }
    .footer-bottom {
        padding: 16px 0;
        display: flex;
        justify-content: center;

        .footer-link {
            @include inter-400;
            line-height: 20px;
            color: black;
        }
    }
}
</style>
