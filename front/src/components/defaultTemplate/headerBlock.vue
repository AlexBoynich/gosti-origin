<template>
    <header>
        <div class="container header-content">
            <div class="left-part">
                <router-link to="/">
                    <img
                            src="/images/header/header-logo.svg"
                            alt="header-logo"
                            class="logo"
                            @click="onTop()"
                    >
                </router-link>
                <div
                    @mouseenter="isHover = true"
                    @mouseleave="isHover = false"
                >
                    <router-link
                        class="navItem from-main-in-catalog"
                        to="/catalog"
                    >
                        <div class="burger-menu">
                            <div :class="['line', 'line1', {'active' : isHover}]"></div>
                            <div :class="['line', 'line2', {'active' : isHover}]"></div>
                            <div :class="['line', 'line3', {'active' : isHover}]"></div>
                        </div>
                        <p>Каталог</p>
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
                        <p v-if="navItem.title">
                            {{ navItem.title }}
                        </p>
                        <img v-else :src="navItem.img" :alt="navItem.alt">
                    </router-link>

                    <a
                            v-else
                            :key="index"
                            :href="navItem.link"
                            :class="['nav-item', {'text' : navItem.isText}]"
                    >
                        {{ navItem.title }}
                    </a>
                </template>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: "headerBlock",
    data () {
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
            isHover: false
        }
    },
    methods: {
        onTop () {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            })
        }
    },
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
header {
    position: fixed;
    top: 0;
    z-index: 11;
    width: 100%;
    background: linear-gradient(180deg, #FFFFFF 40.04%, rgba(255, 255, 255, 0) 100%);

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
            .from-main-in-catalog {
                display: flex;
                align-items: center;
                justify-content: center;
                @include green-button;
                margin-left: 48px;

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

                        &.active {
                            background: black;
                        }
                    }
                }
                p {
                    @include header-link;
                    padding: 0 1px 0 2px;
                }

                &:hover, &:active {
                    @include green-button-hover;
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
                        border-bottom: 2px solid $greenBackground;
                    }
                }
                &:last-child {
                    width: 48px;
                    height: 48px;
                    margin-left: 16px;
                    padding: 0;
                }
            }
        }
    }
}
</style>
