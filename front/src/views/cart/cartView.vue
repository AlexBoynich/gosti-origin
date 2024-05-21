<template>
    <div id="cart" class="container">
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
            <div class="message-desc">Бесплатная доставка <br>от 1500 рублей</div>
            <router-link to="/catalog" class="to-catalog">
                <button>Перейти в меню</button>
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
        <transition name="fade">
            <div v-show="cartItemIsDelete" class="deletion-message">
                <div class="txt">
                    Недоступные позиции были удалены из корзины
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import orderFormsBlock from "@/components/cart/orderFormsBlock.vue";
import cartContent from "@/components/cart/cartContent.vue";
import ReadyOrderModal from "@/components/cart/ordersModals/readyOrderModal.vue";
import validationError from "@/components/cart/ordersModals/validationError";
import {mapActions, mapState} from "vuex";
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
        ...mapState('cart', ['cart', 'cartItemIsDelete']),
        cartIsActive: function () {
            return this.cart.length >= 1;
        },
    },
    methods: {
        ...mapActions('cart', ['GET_DISHES']),
        resultAction(obj) {
            if (obj.readyModal) {
                this.dataForModal = obj.data
                axios.post('/api/orders', obj.forRequest)
                    .then(response => {
                        this.orderId = response.data.orderId
                        this.readyModalIsActive = true
                    })
                    .catch(() => {
                        this.errorAfterRequest = true
                    });
            } else if (obj.errorModal) {
                this.errorValidation = true
            }
            this.blockScroll()
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
        },
        updateCart () {
            if (this.cart.length > 0) {
                let arrForBack = this.cart.map((el) => el.id)
                this.GET_DISHES(arrForBack)
            }
        }
    },
    components: {
        ErrorModal,
        cartContent,
        orderFormsBlock,
        validationError,
        ReadyOrderModal
    },
    created() {
        this.updateCart()
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.container{
    padding-top: 0;
    .title{
        @include mobile{
            display: none
        }
    }
}

#cart {
    margin-top: 120px;
    min-height: 90vh;
    @include mobile {
        min-height: auto;
        position: relative;
    }

    h2 {
        @include h2;
        margin-bottom: 24px;
    }
    .content {
        display: flex;
        justify-content: space-between;
        padding-bottom: 120px;
        @include mobile {
            flex-direction: column;
        }
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
            @include mobile {
                margin-bottom: 18px;
            }
        }

        .message-desc {
            @include inter-400;
            font-size: 24px;
            line-height: 26px;
            margin-bottom: 72px;
            @include mobile {
                margin-bottom: 40px;
                text-align: center !important;
                font-size: 18px !important;
            }
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
    .deletion-message {
        max-width: 800px;
        border-radius: 16px;
        padding: 20px 60px 20px 63px;
        margin-bottom: 24px;
        background: $lightGrayishRed;
        border-left: 5px solid $madderLake;
        position: absolute;
        top: 10px;
        right: 0;
        transition: .3s ease-in-out;

        .txt {
            @include inter-400;
            color: #000;
            font-size: 20px;
            line-height: 140%;
            letter-spacing: -0.4px;
        }
    }
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
}

</style>
