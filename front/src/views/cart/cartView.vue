<template>
    <div id="cart" class="container">
        <h2 class="title">Корзина</h2>
        <div class="content">
            <cartContent
                :cart="cart"
                :cartIsActive="cartIsActive"
                :isDelivery="isDelivery"
            />
            <orderFormsBlock
                v-show="cartIsActive"
                @resultAction="resultAction"
                @activeWayToGetButton="activeWayTo"
            />
        </div>
        <div v-show="!cartIsActive" class="cart-inactive">
            <div class="message-title">Вы ничего не добавили</div>
            <div class="message-desc">Бесплатная доставка от 1500 рублей</div>
            <router-link to="/catalog" class="to-catalog">
                <button>Перейти в каталог</button>
            </router-link>
        </div>
        <validationError
            v-show="errorValidation"
            @closeModal="closeModal"
        />
        <ReadyOrderModal
            v-if="readyModalIsActive"
            @closeModal="closeModal"
            :dataForModal="dataForModal"
            :orderId="orderId"
        />
        <ErrorModal
            v-if="errorAfterRequest"
            @closeModal="closeModal"
        />
    </div>
</template>

<script>
import orderFormsBlock from "@/components/cart/orderFormsBlock.vue";
import cartContent from "@/components/cart/cartContent.vue";
import ReadyOrderModal from "@/components/cart/ordersModals/readyOrderModal.vue";
import validationError from "@/components/cart/ordersModals/validationError";
import {mapState} from "vuex";
import axios from "axios";
import ErrorModal from "../../components/cart/ordersModals/errorModal";

export default {
    name: "cartView",
    data() {
        return {
            errorValidation: false,
            errorAfterRequest: false,
            readyModalIsActive: false,
            dataForModal: [],
            isDelivery: true,
            orderId: null
        }
    },
    computed: {
        ...mapState('cart', ['cart']),
        cartIsActive: function () {
            return this.cart.length >= 1;
        },
    },
    methods: {
        resultAction(obj) {
            // if (obj.readyModal) {
            //     this.dataForModal = obj.data

            //     axios.post('/api/orders', obj.forRequest)
            //         .then(response => {
            //             this.orderId = response.data.orderId
            //             this.readyModalIsActive = true
            //         })
            //         .catch(() => {
            //             this.errorAfterRequest = true
            //         });
            // } else if (obj.errorModal) {
            //     this.errorValidation = true
            // }
            // this.blockScroll()
        },
        closeModal() {
            this.errorValidation = false
            this.readyModalIsActive = false
            this.errorAfterRequest = false
            this.blockScroll()
        },
        blockScroll() {
            let body = document.querySelector('body')

            if (this.errorValidation || this.readyModalIsActive || this.errorAfterRequest) {
                body.style.overflow = 'hidden'
            } else {
                body.style.overflow = ''
            }
        },
        activeWayTo(bool) {
            this.isDelivery = bool === true;
        }
    },
    components: {
        ErrorModal,
        cartContent,
        orderFormsBlock,
        validationError,
        ReadyOrderModal
    },
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
        padding-bottom: 120px;
    }

    .cart-inactive {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: -72px;

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
                padding: 16px 64px;

                &:hover {
                    @include green-button-hover;
                }
            }
        }
    }
}
</style>
