<template>
    <div class="cart-content">
        <div class="cart-content-header">
            <div class="title-and-del">
                <div class="your-cart">Ваш заказ</div>
                <button
                    v-show="cartIsActive"
                    class="delete-cart"
                    @click="openModal"
                >
                    Очистить корзину
                </button>
            </div>
            <div v-show="cartIsActive" class="product-counter">
                {{ cartCounter }}
            </div>
        </div>
        <DeleteItemModal
            v-show="modalIsActive"
            @closeModal="closeModal"
            @choice="choice"
        />
        <div v-show="cartIsActive" :class="['cart-content-body', {'higher' : isDelivery}]">
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
import DeleteItemModal from "./ordersModals/deleteItemModal/deleteItemModal";
import {mapMutations} from "vuex";

export default {
    name: "cartContent",
    data () {
        return {
            modalIsActive: false
        }
    },
    computed: {
        cartCounter: function () {
            let temporaryСart = this.cart
            let count = temporaryСart.reduce((acc, item) => acc + item.count, 0)
            let word
            if (count > 20) {
                let secondNumber = count % 10;
                if (secondNumber === 1) {
                    word = count + " товар";
                } else if (secondNumber >= 2 && secondNumber <= 4) {
                    word = count + " товара";
                } else {
                    word = count + " товаров";
                }
            } else {
                if (count === 1) {
                    word = count + " товар";
                } else if (count >= 2 && count <= 4) {
                    word = count + " товара";
                } else {
                    word = count + " товаров";
                }
            }
            return word
        }
    },
    methods: {
        ...mapMutations('cart', ['DELETE_CART']),
        deleteCart () {
            this.DELETE_CART()
        },
        openModal () {
            this.modalIsActive = true
        },
        choice (act) {
            if (act === true) {
                this.deleteCart()
            }
            this.closeModal(false)
        },
        closeModal (state) {
            this.modalIsActive = state
        },
    },
    components: {
        CartItem,
        DeleteItemModal
    },
    props: ['cart', 'cartIsActive', 'isDelivery']
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
        max-height: 853px;
        overflow: scroll;

        scrollbar-width: none;
        -ms-overflow-style: none;

        &::-webkit-scrollbar {
            display: none;
        }

        &.higher {
            max-height: 1215px;
        }
    }
}
</style>
