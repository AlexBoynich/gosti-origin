<template>
    <div id="cart" class="container">
        <h2 class="title">Корзина</h2>
        <div class="content">
            <cartContent :cart="cart" :cartIsActive="cartIsActive"/>
            <orderFormsBlock v-show="cartIsActive"/>
        </div>
        <div v-show="!cartIsActive" class="cart-inactive">
            <div class="message-title">Вы ничего не добавили</div>
            <div class="message-desc">Бесплатная доставка от 1500 рублей</div>
            <router-link to="/catalog" class="to-catalog">
                <button>Перейти в каталог</button>
            </router-link>
        </div>
    </div>
</template>

<script>
import orderFormsBlock from "@/components/cart/orderFormsBlock.vue";
import cartContent from "@/components/cart/cartContent.vue";
import {mapState} from "vuex";

export default {
    name: "cartView",
    components: {
        cartContent,
        orderFormsBlock
    },
    computed: {
        ...mapState('cart', ['cart']),
        cartIsActive: function () {
            return this.cart.length > 0;
        }
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
#cart {
    margin-top: 174px;
    min-height: 90vh;

    h2 {
        @include h2;
        margin-bottom: 24px;
    }

    .content {
        display: flex;
        justify-content: space-between;
    }
    .cart-inactive {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 48px;

        .message-title {
            @include inter-400;
            font-size: 32px;
            line-height: 35px;
            margin-bottom: 32px;
        }
        .message-desc {
            @include inter-400;
            font-size: 24px;
            line-height: 26px;
            margin-bottom: 72px;
        }
        .to-catalog {

            button {
                @include green-button;

                &:hover {
                    @include green-button-hover;
                }
            }
        }
    }
}
</style>
