<template>
    <div class="modal-mask">
        <div class="modal-container">
            <button class="close-modal" @click="closeModal">
                <img src="/images/catalog/catalogItem/modal/close-modal.svg" alt="close-modal">
            </button>
            <div class="modal-content">
                <div class="title">
                    Спасибо! <br>
                    Номер вашего заказа {{ orderId }}.
                </div>
                <div class="order-desc-box">
                    <div class="order-item"
                         v-for="(item, index) in dataForModal"
                         :key="index"
                    >
                        <div class="item-title">{{ item.title }}</div>
                        <div class="item-desc" v-html="item.content"></div>
                    </div>
                </div>
                <button @click="closeModal">Ок</button>
                <div class="text-message">
                    Если вы хотите изменить или отменить заказ позвоните по номеру
                    <a
                        :href="leftPartFooterItems[0].descItems[1].href"
                        class="phone"
                    >
                        {{ phoneNumber }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "readyOrderModal",
    computed: {
        ...mapState('leftPartFooterItems', ['leftPartFooterItems']),
        phoneNumber: function () {
            return this.leftPartFooterItems[0].descItems[1].desc
        }
    },
    methods: {
        closeModal() {
            this.$emit('closeModal')
        }
    },
    props: ['dataForModal', 'orderId']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.modal-mask {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.25);

    .modal-container {
        width: 704px;
        min-height: 655px;
        border-radius: 16px;
        background: white;
        padding: 32px 61px 64px;
        position: relative;

        .close-modal {
            cursor: pointer;
            background: transparent;
            border: none;
            position: absolute;
            right: 32px;
            top: 32px;
            width: 17px;
            height: 16px;

            img {
                width: 100%;
                height: 100%;
            }
        }

        .modal-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin-top: 88px;

            .title {
                @include inter-500;
                font-size: 24px;
                line-height: 26px;
                margin-bottom: 32px;
                text-align: center;
            }

            .order-desc-box {
                margin-bottom: 32px;
                max-width: 450px;
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 24px 0;

                .order-item {
                    display: flex;
                    align-items: flex-start;
                    justify-content: space-between;

                    .item-title {
                        @include inter-500;
                        font-size: 20px;
                        line-height: 22px;
                    }

                    .item-desc {
                        @include inter-400;
                        font-size: 20px;
                        line-height: 22px;
                        max-width: 240px;
                        width: 100%;
                        word-wrap: break-word;
                        text-align: left;
                    }
                }

            }

            button {
                @include green-button;
                width: 100%;
                height: 58px;
                text-align: center;
                margin-bottom: 16px;

                &:hover {
                    @include green-button-hover;
                }
            }

            .text-message {
                @include inter-400;
                font-size: 16px;
                line-height: 18px;
                text-align: center;
                max-width: 511px;

                .phone {
                    text-decoration: none;
                    @include inter-400;
                    font-size: 16px;
                    line-height: 18px;
                    color: black;
                }
            }
        }
    }
}
</style>
