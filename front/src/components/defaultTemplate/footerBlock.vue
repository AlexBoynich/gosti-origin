<template>
    <footer id="footer">
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
                                        <span v-html="descItem.desc"></span>
                                    </a>
                                    <div v-else class="desc"><span v-html="descItem.desc"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-part-bottom">
                        <a
                            v-for="(item, index) in footerSocials"
                            :key="index"
                            :href="item.link"
                            target="_blank"
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
                    <footerMap/>
                </div>
            </div>
            <div class="hr"></div>
            <div class="footer-bottom">
                <a class="footer-link" target="_blank" href="/documents/politika.pdf">
                    Политика конфиденциальности
                </a>
            </div>
        </div>
    </footer>
</template>

<script>
import footerMap from "@/components/map/footerMap";
import {mapActions, mapState} from "vuex";

export default {
    name: "footerBlock",
    data () {
        return {
            footerSocials: [
                { img: "images/footer/footer-social-vk.png", link: "https://vk.com/cafegostitomsk" },
                { img: "images/footer/footer-social-wa.png", link: "https://wa.me/79138209990" },
                { img: "images/footer/footer-social-2g.png", link: "https://2gis.ru/tomsk/firm/70000001029574004" }
            ],
        leftPartFooterItems: [
        {
          title: "Контакты",
          descItems: [
            { img: "/images/footer/footer-left-part-map-icon.svg", desc: "г.Томск, пр.Фрунзе 90" },
            { img: "/images/footer/footer-left-part-phone-icon.svg", desc: "8(3822)50-99-90", "href": "tel:+73822509990", "isClickable": true },
            { img: "/images/footer/footer-left-part-mail-icon.svg", desc: "gosti_cafe@mail.ru", "href": "mailto:gosti_cafe@mail.ru", "isClickable": true }
          ]
        },
        {
          title: "Режим работы в праздники",
          descItems: [
            { img: "/images/footer/footer-left-part-time-icon.svg", desc: "31 декабря - 08.00 - 18.00" },
            { img: "/images/footer/footer-left-part-time-icon.svg", desc: "1 января - выходной" },
            { img: "/images/footer/footer-left-part-time-icon.svg", desc: "2 января - 8 января <br> 10.00 - 23.00" },
            { img: "/images/footer/footer-left-part-time-icon.svg", desc: "с 9 января в обычном режиме" }
          ]
        }
      ]
      }
    },
    components: {
        footerMap
    },
    computed: {
        ...mapState('leftPartFooterItems', ['leftPartFooterItems']),
    },
    methods: {
        ...mapActions('leftPartFooterItems', ['GET_LEFT_PART_FOOTER_ITEMS']),
    },
    created() {
        this.GET_LEFT_PART_FOOTER_ITEMS()
    },
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
                                line-height: 22px;
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
            cursor: pointer;
        }
    }
}
</style>
