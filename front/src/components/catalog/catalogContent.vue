<template>
    <div 
    class="catalog-content"
    >
        <div
            v-show="activeItems.subcategoriesTitle === 'Завтраки' || catalogItems.length === 0"
            :class="['message', {'bad' : !isGood || catalogItems.length === 0}]"
        >
            <div
                v-show="activeItems.subcategoriesTitle === 'Завтраки'"
                class="txt"
            >
                {{ messageContent.breakfast }}
            </div>
            <div
                v-show="activeItems.subcategoriesTitle === 'Бизнес-ланч' || catalogItems.length === 0"
                class="txt"
            >
                {{ messageContent.businessLunch }}
            </div>
            <div
                v-show="catalogItems.length === 0"
                class="txt"
            >
                {{ messageContent.noDishes }}
            </div>
        </div>

        <button
            v-show="catalogItems.length === 0"
            class="go-to-catalog"
            @click="goToCatalog"
        >
            Перейти в меню
        </button>
        <div class="catalog-items">
            <catalogItem
                v-for="(catalogItem, index) in arrСonsideringСart"
                :key="index"
                :catalogItem="catalogItem"
                @inCart="inCart"
                @transformAmount="transformAmount"
            />
        </div>
    </div>
</template>

<script>
import catalogItem from "@/components/catalog/catalogItem/catalogItem.vue";
import {mapMutations, mapState, mapGetters} from 'vuex'

export default {
    name: "catalogContent",
    data() {
        return {
            messageContent: {
                breakfast: 'Завтраки действуют по будням с 8:00 — 12:00 / по выходным с 8:00 — 16:00',
                businessLunch: 'Бизнес-ланчи действуют по будням с 12:00 — 16:00',
                noDishes: 'К сожалению, по вашему запросу ничего не найдено'
            },
            isGood: true,
            componentCart: [],
            width: 0,
        }
    },
    computed: {
        ...mapState('cart', ['cart']),
        ...mapGetters(['GET_SHOW_CATALOG']),
        showMessage: function () {
            if (this.activeItems.categoriesIndex === 0 || this.activeItems.categoriesIndex === 1) {
                return true
            } else return this.catalogItems.length === 0;
        },
        arrСonsideringСart: function () {
            return this.catalogItems.map(item => {
                const cartItem = this.cart.find(cartItem => cartItem.id === item.id);
                this.$set(item, 'count', cartItem ? cartItem.count : 0);
                return item;
            });
        }
    },
    methods: {
        ...mapMutations('cart', ['SET_CART', 'ADD_IN_CART']),
        checkTime(id) {
            let date = new Date();
            let hour = date.getUTCHours() + 7
            const options = {weekday: 'long'};
            const dayOfWeek = date.toLocaleString('en-US', options);

            if (id === 0) {
                if (dayOfWeek === 'Saturday' || dayOfWeek === 'Sunday') {
                    this.isGood = hour >= 8 && hour < 16
                } else {
                    this.isGood = hour >= 8 && hour < 12
                }
            } else if (id === 1) {
                if (dayOfWeek === 'Saturday' || dayOfWeek === 'Sunday') {
                    this.isGood = false
                } else {
                    this.isGood = hour >= 12 && hour < 16;
                }
            }
            return this.isGood
        },
        goToCatalog() {
            this.$emit('goToCatalog')
        },
        inCart(item) {
            if (this.cart.reduce((acc, item) => acc + item.count, 0) < 99) {
                let temporaryItem = item.item
                temporaryItem.count = item.count
                this.ADD_IN_CART(temporaryItem)
            }
        },
        transformAmount(item) {
            let temporaryItem = item.item
            temporaryItem.count = item.count

            this.componentCart = this.cart
            this.componentCart.push(temporaryItem)

            let index = this.componentCart.findIndex(el => el.id === temporaryItem.id)
            this.componentCart.splice(index, 1)

            index = this.componentCart.findIndex(el => el.count === 0)
            if (index !== -1) {
                this.componentCart.splice(index, 1);
            }
            this.SET_CART(this.componentCart)
        },
        showOnMobile() {
            if (this.width < 800 && this.GET_SHOW_CATALOG === true) {
                return false
            }
            else return true
        }
    },
    components: {
        catalogItem,
    },
    props: ['activeItems', 'catalogItems'],
    
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

.catalog-content {
    padding-bottom: 120px;
    
    @include mobile {
        padding-bottom: 0;
        margin-top: 115px;
    }

    .message {
        border-radius: 5px;
        padding: 20px 90px 20px 93px;
        margin-bottom: 24px;
        border: 1px solid #7B9561;

        @include mobile {
            padding: 20px 16px;
        }


        .txt {
            font-family: 'Inter', sans-serif;
            font-size: 20px;
            font-weight: 400;
            line-height: 27px;
            text-align: center;
            color: #000;

            @include mobile {
                font-size: 14px;
                font-weight: 400;
                line-height: 18.9px;
                text-align: center;
            }
        }

        &.bad {
            // border: 1px solid #b85b3f;
        }
    }

    .categories-title {
        @include inter-500;
        color: #000;
        font-size: 24px;
        line-height: 110%;
        letter-spacing: -0.48px;
        margin-bottom: 16px;

        &.no-message {
            margin-top: 95px;
        }

        @include mobile {
            display: none;
        }
    }


    .subcategories-title {
        color: #000;
        @include inter-400;
        line-height: 110%;
        letter-spacing: -0.36px;
        margin-bottom: 16px;

        @include mobile {
            display: none;
        }
    }

    .go-to-catalog {
        @include green-button;
        padding: 16px 64px;
        margin-top: 24px;

        &:hover {
            @include green-button-hover;

        }
    }

    .catalog-items {
        display: flex;
        flex-wrap: wrap;
        gap: 48px 30px;
        min-width: 1030px;
        width: 100%;
        @include mobile {
            min-width: auto;
            gap: 30px 16px;
        }
    }

}
</style>
