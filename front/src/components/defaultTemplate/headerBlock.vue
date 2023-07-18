<template>
    <header>
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
                        <div class="burger-menu">
                            <div :class="['line', 'line1', {'active' : isHover, 'in-catalog' : isCatalog}]"></div>
                            <div :class="['line', 'line2', {'active' : isHover, 'in-catalog' : isCatalog}]"></div>
                            <div :class="['line', 'line3', {'active' : isHover, 'in-catalog' : isCatalog}]"></div>
                        </div>
                        <p :class="{'in-catalog' : isCatalog}">Каталог</p>
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
                            <div v-show="cart.length > 0" class="cart-counter">{{ cart.length }}</div>
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
            isHover: false,
            isCatalog: false
        }
    },
    computed: {
        ...mapState('cart', ['cart'])
    },
    methods: {
        onTop
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

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 27px 0;

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

            .nav-item {
                @include header-link;
                color: black;
                padding: 16px 24px;

                &.text {
                    padding: 8px 24px;
                    border-bottom: 2px solid transparent;

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
