<template>
    <header :class="{'zIndex' : isBurgerShow}" >
        <div 
        class="burger-menu-layout"
        v-show="isBurgerShow"
        @click.self="toggleBurgerMenu"
        >
        <div class="opacity" @click="clickOnMenuItem('smooth')"></div>
            <div 
            class='burger-menu'          
            >
            <div class="burger-menu_top">
                <div class="burger-menu_top-part">
                    <div class="burger-menu_right-part">
                        <div 
                        class="close-burger-menu"
                        @click="clickOnMenuItem('smooth')"
                        >

                        </div>
                    </div>
                    <router-link to="/">
                        <img
                            src="/images/header/header-logo-black.svg"
                            alt="Логотип Гости"
                            class="logo"
                            @click="clickOnMenuItem('smooth')"
                        >
                    </router-link>
                </div>
                <nav class="right-part">
                    <template v-for="(navItem, index) in itemsMobile">

                        <router-link
                            v-if="!navItem.onAnotherSite"
                            :key="index"
                            :class="['nav-item', {'text' : navItem.isText}]"
                            :to="{path: navItem.link, hash: navItem.hash}"
                        >
                            <p v-if="navItem.title" @click="clickOnMenuItem('auto')">
                                {{ navItem.title }}
                            </p>
                            <div v-else class="cart-icon">
                                <img :src="navItem.img" :alt="navItem.alt" @click="onTop('auto')">
                                <div v-show="cart.length > 0" class="cart-counter">{{ productCounter }}</div>
                            </div>

                        </router-link>

                        <a
                            v-else
                            :key="index"
                            :href="navItem.link"
                            :class="['nav-item', {'text' : navItem.isText}]"
                            target="_blank"
                        >
                            {{ navItem.title }}
                        </a>
                    </template>
                </nav>
            </div>
            <div class="burger-menu_bottom">
                <a
                 href="tel:++7 (3822) 50-99-90"
                 class="phoneNumber"
                 >+7 (3822) 50-99-90</a>
                 <button class="button">
                    <a href="https://wa.me/79138209990" style="color: white;">Забронировать стол</a>
                 </button>
            </div>
            </div>
        </div>
        <div class="container header-content">
            <div class="left-part">
                <router-link to="/">
                    <img
                        src="/images/header/header-logo.svg"
                        alt="header-logo"
                        class="header-logo"
                        @click="onTop('smooth')"
                    >
                </router-link>
            </div>
            <nav class="right-part">
                <template v-for="(navItem, index) in items">

                    <router-link
                        v-if="!navItem.onAnotherSite"
                        :key="index"
                        :class="['nav-item', {'text' : navItem.isText}]"
                        :to="navItem.link"
                    >
                        <p v-if="navItem.title" @click="onTop('auto')">
                            {{ navItem.title }}
                        </p>
                        <div v-else class="cart-icon">
                            <img :src="navItem.img" :alt="navItem.alt" @click="onTop('auto')">
                            <div v-show="cart.length > 0" class="cart-counter">{{ productCounter }}</div>
                        </div>

                    </router-link>

                    <a
                        v-else
                        :key="index"
                        :href="navItem.link"
                        :class="['nav-item', {'text' : navItem.isText}]"
                        target="_blank"
                    >
                        {{ navItem.title }}
                    </a>
                </template>
                <img 
                src="images/header/header-burger.svg" 
                alt="header-burger"
                :class="['header-burger',]"
                @click="toggleBurgerMenu"
                >
            </nav>
        </div>
    </header>
</template>

<script>
import {onTop} from '@/utils/helpers.js'
import {mapState} from "vuex";

export default {
    name: "headerBlock",
    data() {
        return {
            items: [
                {
                    title: 'Меню',
                    link: '/catalog',
                    isText: true
                },
                {
                    title: 'Кейтеринг',
                    link: '/catering',
                    isText: true
                },
                {
                    title: 'Вакансии',
                    link: 'https://hr-torta.ru/',
                    onAnotherSite: true,
                    isText: true
                },
                {
                    title: 'Система лояльности',
                    link: 'https://loyalty-torta.tilda.ws/?utm_source=Sayt&utm_medium=Gosti&utm_campaign=Menyu',
                    onAnotherSite: true,
                    isText: true
                },
                {
                    img: 'images/header/header-cart.svg',
                    link: '/cart',
                    alt: 'header-cart'
                },
            ],
            itemsMobile: [
                
                {
                    title: 'Меню',
                    link: '/catalog',
                    isText: true
                },
                {
                    title: 'Кейтеринг',
                    link: '/catering',
                    isText: true
                },
                {
                    title: 'Доставка',
                    link: '/',
                    isText: true,
                    hash: '#delivery'
                },
                {
                    title: 'Вакансии',
                    link: 'https://hr-torta.ru/',
                    onAnotherSite: true,
                    isText: true
                },
                {
                    title: 'Система лояльности',
                    link: 'https://loyalty-torta.tilda.ws/?utm_source=Sayt&utm_medium=Gosti&utm_campaign=Menyu',
                    onAnotherSite: true,
                    isText: true
                },               {
                    title: 'Контакты',
                    link: '/',
                    isText: true,
                    hash: '#contacts'
                },
                
            ],
            isHover: false,
            isCatalog: false,
            isBurgerShow: false,
        }
    },
    computed: {
        ...mapState('cart', ['cart']),
        productCounter: function () {
            return this.cart.reduce((acc, item) => acc + item.count, 0)
        }
    },
    methods: {
        onTop,
        toggleBurgerMenu() {
            this.isBurgerShow = !this.isBurgerShow
            document.querySelector('body').classList.add('no-scroll')
        },
        clickOnMenuItem(height) {
            this.isBurgerShow = false;
            this.onTop(height)
            document.querySelector('body').classList.remove('no-scroll')
        }
    },
    watch: {
        '$route.path'() {
            window.location.pathname === '/catalog' ? this.isCatalog = true : this.isCatalog = false
        }
    },
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.router-link-exact-active{
    color: #7B9561 !important;
}

.zIndex{
            @include mobile {
                z-index: 13;
            }
        }

header {
    position: fixed;
    top: 0;
    z-index: 11;
    width: 100vw;
    background: linear-gradient(180deg,#fff 55.04%,hsla(0,0%,100%,0));
    @include mobile {
        background: linear-gradient(180deg, #FFFFFF 80.04%, rgba(255, 255, 255, 0) 100%);
    }
    .burger-menu-layout {
        height: 100vh;
        width: 100vw;
        position: absolute;
        overflow: hidden;
        .opacity{
            background-color: #000000;
            opacity: 0.3;
            width: 26%;
            position: absolute;
            height: 100vh;
            z-index: 15;
        }
    }

    .burger-menu {
            @include desktop {
                display: none;
            }
            @include mobile {
                width: 74%;
                background: #FFFFFF;
                position: absolute;
                z-index: 10;
                right: 0;
                height: 100vh;
                display: flex;
                justify-content: space-between;
                flex-direction: column;
                padding: 0 26px 40px;
                
                .burger-menu_bottom{
                            display: flex;
                            flex-direction: column;
                            gap: 10px;
                        }
                
            .phoneNumber {
                text-decoration: none;
                color: black;
                font-family: 'Inter', sans-serif;
                font-size: 13px;
                font-weight: 400;
                line-height: 22px;
                letter-spacing: -0.4000000059604645px;
                text-align: left;

            }
            
            .button {
                @include green-button;
                font-size: 15px !important;
                font-weight: 500 !important;
                line-height: 22px !important;

                &:hover, &:active {
                    @include green-button-hover;
                }
            }
            }
            .burger-menu_top-part {
                padding: 40px 0;
                justify-content: space-between;
                .burger-menu_right-part{
                    display: flex;
                    gap: 0 20px;
                    align-items: center;
                    justify-content: end;
                }
            }
            .right-part {
                @include mobile {
                    display: flex;
                    flex-direction: column;
                    gap: 17px;
                    align-items: start;
                    a.nav-item {
                        @include inter-400-burger-item;
                        display: inline-block;
                        text-decoration: none;
                        color: #000000;
                    }
                }
                }
                .close-burger-menu{
                    width: 28px;
                    height: 28px;
                    background-color: transparent;
                    position: relative;
                    cursor: pointer;
                    &::before, &::after{
                        content: '';
                        background-color: #000000;
                        position: absolute;
                        width: 100%;
                        height: 2px;
                        top: 13px;
                    }
                    &::before{
                        rotate: 45deg;
                    }
                    &::after{
                        rotate: -45deg;
                    }
                }
        }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 27px 0;
        @include mobile {
            padding: 26px 16px 36px;
        }

        .left-part {
            display: flex;
            align-items: center;
            justify-content: center;

            .header-logo {
                height: 70px;
                width: 151px;
                cursor: pointer;
                @include mobile {
                    width: 88px;
                    height: 41px;
                }
            }

            .in-catalog-box {
                margin-left: 48px;

                .from-main-in-catalog {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    @include green-button;
                    @include mobile {
                        display: none;
                    }

                    .burger-menu {
                        width: 24px;
                        height: 16px;
                        display: flex;
                        justify-content: space-between;
                        flex-direction: column;
                        margin-right: 16px;

                        .line {
                            width: 100%;
                            height: 1px;
                            background: white;

                            &.active, &.in-catalog {
                                background: black;
                            }
                        }
                    }

                    p {
                        @include header-link;
                        padding: 0 0 0 2px;

                        &.in-catalog {
                            color: black;
                        }
                    }

                    &:hover, &:active, &.in-catalog {
                        @include green-button-hover;
                    }
                }

            }
        }

        .right-part {
            display: flex;
            align-items: center;
            gap: 0 48px;
            @include mobile {
                gap: 0 20px;
            }
            &:last-child {
                    padding: 0;

                    .cart-icon {
                        position: relative;
                        margin-left: 5px;
                        padding: 0;

                        img {
                            width: 44px;
                            height: 44px;
                            @include mobile {
                                width: 35px;
                                height: 35px;
                            }
                        }

                        .cart-counter {
                            position: absolute;
                            right: -8px;
                            top: 0;
                            width: 25px;
                            height: 25px;
                            background: $olive;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: white;
                            @include inter-400;
                            font-size: 16px;
                            line-height: 16px;
                            @include mobile {
                                width: 18px;
                                height: 18px;
                                font-size: 10px !important;
                                right: 0;
                            }
                        }
                    }
                }

            .header-burger {
                @include desktop {
                    display: none;
                }
                @include mobile {
                    cursor: pointer;
                }
            }

            .nav-item {
                @include header-link;
                color: black;
                padding: 16px 24px;
                @include mobile {
                    padding: 0;
                }

                &.text {
                    padding: 0;
                    border-bottom: 2px solid transparent;
                    @include mobile {
                        display: none;
                    }

                    &:hover {
                        color: #7B9561;
                    }
                    &:active{
                        color: #374b23;
                    }
                }

                &:last-child {
                    padding: 0;

                    .cart-icon {
                        position: relative;
                        width: 35px;
                        height: 36px;
                        margin-left: 5px;
                        padding: 0;

                        img {
                            width: 35px;
                            height: 36px;
                            @include mobile {
                                width: 35px;
                                height: 35px;
                            }
                        }

                        .cart-counter {
                            position: absolute;
                            right: -8px;
                            top: 0;
                            width: 25px;
                            height: 25px;
                            background: $olive;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: white;
                            @include inter-400;
                            font-size: 16px;
                            line-height: 16px;
                            @include mobile {
                                width: 18px;
                                height: 18px;
                                font-size: 10px !important;
                                right: 0;
                            }
                        }
                    }
                }

            }
        }
    }
}
</style>
