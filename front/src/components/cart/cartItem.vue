<template>
    <div class="cart-item">
        <div class="img">
            <img :src="cartItem.img" alt="cart-item-img">
        </div>
        <div class="cart-item-content">
            <div class="product-header">
                <div class="title">{{ cartItem.title }}</div>
                <button class="delete-item" @click="openModal">
                    <img src="/images/catalog/catalogItem/modal/close-modal.svg" alt="delete-item">
                </button>
            </div>
            <div class="product-desc-box">
                <div class="counter">
                    <button class="action-button" @click="transformCartItemAmount('-')">
                        <img src="/images/cart/cartItem/counter/minus.svg" alt="minus">
                    </button>
                    <div class="count">{{ cartItem.count }}</div>
                    <button class="action-button" @click="transformCartItemAmount('+')">
                        <img src="/images/cart/cartItem/counter/plus.svg" alt="plus">
                    </button>
                </div>
                <div class="desc">
                    <div class="weight">{{ cartItem.weight }}</div>
                    <div class="price">{{ cartItem.price * cartItem.count + '₽' }}</div>
                </div>
            </div>
        </div>
        <DeleteItemModal
            v-show="modalIsActive"
            @closeModal="closeModal"
            @choice="choice"
        />
    </div>
</template>

<script>
import {mapState} from "vuex";
import DeleteItemModal from "./ordersModals/deleteItemModal";
export default {
    name: "cartItem",
    components: {DeleteItemModal},
    data () {
        return {
            modalIsActive: false
        }
    },
    computed: {
        ...mapState('cart', ['cart']),
        ...mapState('catalogItems', ['catalogItems']),
    },
    methods: {
        deleteItem () {
            let cartIndex = this.cart.findIndex((el) => el.id === this.cartItem.id)
            this.cart.splice(cartIndex, 1)
        },
        openModal() {
            this.modalIsActive = true
        },
        choice(act) {
            console.log(act)
            if (act === true) {
                this.deleteItem()
            }
            this.closeModal(false)
        },
        closeModal(state) {
            this.modalIsActive = state
        },
        transformCartItemAmount (act) {
            if (act === '-') {
                if (this.cartItem.count === 1) {
                    this.openModal()
                } else {
                    let cartIndex = this.cart.findIndex((el) => el.id === this.cartItem.id)
                    this.cart[cartIndex].count -= 1
                }
            } else {
                if (this.cart.reduce((acc, item) => acc + item.count, 0) < 99) {
                    if (this.cartItem.count < 99) {
                        let cartIndex = this.cart.findIndex((el) => el.id === this.cartItem.id)
                        this.cart[cartIndex].count += 1
                    }
                }
            }
        }
    },
    props: ['cartItem']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.cart-item {
    display: flex;
    background: #EFF4EB;
    border-radius: 16px;

    .img {
        position: relative;
        overflow: hidden;
        width: 196px;
        height: 136px;
        border-radius: 16px;

        img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    }

    .cart-item-content {
        padding: 16px 24px 16px 16px;
        position: relative;
        width: 400px;
        display: flex;
        justify-content: space-between;
        flex-direction: column;

        .product-header {

            .title {
                @include inter-400;
                font-size: 16px;
                line-height: 18px;
                max-width: 290px;
                height: 52px;
            }

            button {
                position: absolute;
                right: 24px;
                top: 16px;
                background: transparent;
                width: 16px;
                height: 16px;
                border: none;
                cursor: pointer;

                img {
                    width: 16px;
                    height: 16px;
                }
            }
        }

        .product-desc-box {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            .counter {
                display: flex;
                align-items: center;
                gap: 0 15px;

                button {
                    max-width: 24px;
                    max-height: 24px;
                    padding: 6px 8px;
                    border: 1px solid $olive;
                    background: $olive;
                    border-radius: 4px;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;

                    img {
                        width: 12px;
                        height: 12px;
                    }
                }
                .count {
                    @include inter-400;
                    font-size: 16px;
                    line-height: 18px;
                    width: 20px;
                    height: 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
            }
            .desc {
                display: flex;
                align-items: flex-end;
                flex-direction: column;

                .weight {
                    @include inter-300;
                    font-size: 16px;
                    line-height: 22px;
                    margin-bottom: 8px;
                }
                .price {
                    @include inter-500;
                    font-size: 20px;
                    line-height: 22px;
                }
            }
        }
    }
}
</style>
