<template>
    <header>
        <div 
        class="burger-menu-layout"
        v-show="isBurgerShow"
        @click="toggleBurgerMenu"
        >
            <div 
            class='burger-menu'
            @click.prevent="toggleBurgerMenu"            
            >
            <div class="burger-menu_top-part">
                <img src="/images/header/header-logo-white.svg" alt="Логотип Гости">
                <img src="/images/header/header-cart-white.svg" alt="Корзина">
            </div>
            <nav class="right-part">
                <template v-for="(navItem, index) in itemsMobile">

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
            </nav>

            </div>
        </div>
        <div class="container header-content">
            <div class="left-part">
                <router-link to="/">
                    <img
                        src="/images/header/header-logo.svg"
                        alt="header-logo"
                        class="logo"
                        @click="onTop('smooth')"
                    >
                </router-link>
                <div
                    @mouseenter="isHover = true"
                    @mouseleave="isHover = false"
                    class="in-catalog-box"
                    @click="onTop('auto')"
                >
                    <router-link
                        :class="['navItem', 'from-main-in-catalog', {'in-catalog' : isCatalog}]"
                        to="/catalog"
                    >
                        <!-- <div class="burger-menu">
                            <div :class="['line', 'line1', {'active' : isHover, 'in-catalog' : isCatalog}]"></div>
                            <div :class="['line', 'line2', {'active' : isHover, 'in-catalog' : isCatalog}]"></div>
                            <div :class="['line', 'line3', {'active' : isHover, 'in-catalog' : isCatalog}]"></div>
                        </div> -->
                        <p :class="{'in-catalog' : isCatalog}">Доставка</p>
                    </router-link>
                </div>
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
                    img: 'images/header/header-cart.svg',
                    link: '/cart',
                    alt: 'header-cart'
                },
            ],
            itemsMobile: [
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
                    title: 'Каталог',
                    link: '/catalog',
                    isText: true
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
        }
    },
    watch: {
        '$route.path'() {
            window.location.pathname === '/catalog' ? this.isCatalog = true : this.isCatalog = false
        }
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

header {
    position: fixed;
    top: 0;
    z-index: 11;
    width: 100%;
    background: linear-gradient(180deg, #FFFFFF 55.04%, rgba(255, 255, 255, 0) 100%);
    @include mobile {
        background: linear-gradient(180deg, #FFFFFF 64.04%, rgba(255, 255, 255, 0) 100%);
    }
    .burger-menu-layout {
        height: 100vh;
        width: 100vw;
        position: absolute;
    }

    .burger-menu {
            @include desktop {
                display: none;
            }
            @include mobile {
                width: 100%;
                height: 35vh;
                background: #7B9561;
                position: absolute;
                border-radius: 0 0 20px 20px;
                z-index: 10;
            }
            .burger-menu_top-part {
                padding: 40px 16px;
                display: flex;
                justify-content: space-between;
            }
        }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 46px 16px;

        .left-part {
            display: flex;
            align-items: center;
            justify-content: center;

            .header-logo {
                height: 63px;
                width: 137px;
                cursor: pointer;
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

                &.text {
                    padding: 8px 24px;
                    border-bottom: 2px solid transparent;
                    @include mobile {
                        display: none;
                    }

                    &:active, &:hover {
                        border-bottom: 2px solid $olive;
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
                        }
                    }
                }

            }
        }
    }
}
</style>
