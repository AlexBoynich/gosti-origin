<template>
    <div id="cart" class="container">
        <h2 class="title">Корзина</h2>
        <div class="content">
            <cartContent :cart="cart" :cartIsActive="cartIsActive"/>
            <orderFormsBlock v-show="cartIsActive" @resultAction="resultAction"/>
        </div>
        <div v-show="!cartIsActive" class="cart-inactive">
            <div class="message-title">Вы ничего не добавили</div>
            <div class="message-desc">Бесплатная доставка от 1500 рублей</div>
            <router-link to="/catalog" class="to-catalog">
                <button>Перейти в каталог</button>
            </router-link>
        </div>
        <ErrorModal
            v-show="errorModalIsActive"
            @closeModal="closeModal"
        />
        <ReadyOrderModal
            v-if="readyModalIsActive"
            @closeModal="closeModal"
            :dataForModal="dataForModal"
        />
    </div>
</template>

<script>
import orderFormsBlock from "@/components/cart/orderFormsBlock.vue";
import cartContent from "@/components/cart/cartContent.vue";
import ErrorModal from "@/components/cart/ordersModals/errorModal.vue";
import ReadyOrderModal from "@/components/cart/ordersModals/readyOrderModal.vue";
import {mapState} from "vuex";

export default {
    name: "cartView",
    data () {
        return {
            errorModalIsActive: false,
            readyModalIsActive: false,
            dataForModal: []
        }
    },
    computed: {
        ...mapState('cart', ['cart']),
        cartIsActive: function () {
            return this.cart.length >= 1;
        },
    },
    methods: {
        resultAction (obj) {
            if (obj.readyModal) {
                this.readyModalIsActive = true
                this.dataForModal = obj.data
            } else if (obj.errorModal) {
                this.errorModalIsActive = true
            }
            this.blockScroll()
        },
        closeModal() {
            this.errorModalIsActive = false
            this.readyModalIsActive = false
            this.blockScroll()
        },
        blockScroll() {
            let body = document.querySelector('body')

            if (this.errorModalIsActive || this.readyModalIsActive) {
                body.style.overflow = 'hidden'
            } else {
                body.style.overflow = ''
            }
        }
    },
    components: {
        cartContent,
        orderFormsBlock,
        ReadyOrderModal,
        ErrorModal
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
