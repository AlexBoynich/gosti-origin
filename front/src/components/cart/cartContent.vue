<template>
    <div class="cart-content">
        <div class="cart-content-header">
            <div class="title-and-del">
                <div class="your-cart">Ваш заказ</div>
                <button
                    v-show="cartIsActive"
                    class="delete-cart"
                    @click="deleteCart"
                >
                    Очистить корзину
                </button>
            </div>
            <div v-show="cartIsActive" class="product-counter">
                {{ cartCounter }}
            </div>
        </div>
        <div v-show="cartIsActive" class="cart-content-body">
            <CartItem
                v-for="(item, index) in cart"
                :key="index"
                :cartItem="item"
            />
        </div>
    </div>
</template>

<script>
import CartItem from "@/components/cart/cartItem.vue";
import {mapMutations} from "vuex";

export default {
    name: "cartContent",
    computed: {
        cartCounter: function () {
            let word
            if (this.cart.length > 4 && this.cart.length < 21) {
                word = this.cart.length + ' товаров'
            } else if (this.cart.length % 10 === 1) {
                word = this.cart.length + ' товар'
            } else if (this.cart.length % 10 > 1 && this.cart.length % 10 < 5) {
                word = this.cart.length + ' товара'
            }
            return word
        },
    },
    methods: {
        ...mapMutations('cart', ['DELETE_CART']),
        deleteCart () {
            this.DELETE_CART()
        }
    },
    components: {
        CartItem
    },
    props: ['cart', 'cartIsActive']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.cart-content {
    max-width: 596px;
    width: 100%;


    .cart-content-header {
        display: flex;
        flex-direction: column;
        margin-bottom: 16px;

        .title-and-del {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;

            .your-cart {
                @include inter-500;
            }

            .delete-cart {
                background: transparent;
                border: none;
                @include inter-400;
                cursor: pointer;
                line-height: 20px;
            }
        }

        .product-counter {
            @include inter-300;
            font-size: 16px;
            line-height: 22px;
            color: rgba(0, 0, 0, 0.7);
        }
    }

    .cart-content-body {
        display: flex;
        flex-direction: column;
        gap: 24px 0;
        max-height: /*853*/ 1215px;
        overflow: scroll;

        scrollbar-width: none;
        -ms-overflow-style: none;

        &::-webkit-scrollbar {
            display: none;
        }
    }
}
</style>
