<template>
    <div class="modal-mask" @click="closeOnClickOutside">
        <div class="modal-container">
            <button class="close-modal" @click="closeModal">
                <img src="/images/catalog/catalogItem/modal/close-modal.svg" alt="close-modal">
            </button>
            <div class="modal-content">
                <div class="title">Удалить?</div>
                <div class="desc">Вы уверены, что хотите удалить товар из корзины?</div>
                <div class="buttons">
                    <button @click="choice('del')">Ок</button>
                    <button @click="choice('cancel')">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "deleteItemModal",
    methods: {
        closeModal() {
            this.$emit('closeModal', false)
        },
        choice(action) {
            if (action === 'cancel') {
                this.$emit('choice', false)
            } else {
                this.$emit('choice', true)
            }
        },
        closeOnClickOutside(e) {
            if (e.target.classList.contains('modal-mask')) {
                this.closeModal()
            }
        }
    }
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
        height: 461px;
        border-radius: 16px;
        background: white;
        padding: 32px;
        position: relative;
        @include mobile {
            width: 328px;
            height: 278px;
            border-radius: 10px;
        }

        .close-modal {
            cursor: pointer;
            background: transparent;
            border: none;
            position: absolute;
            right: 32px;
            top: 32px;
            width: 17px;
            height: 16px;
            @include mobile {
                top: 10px;
                right: 10px;
            }

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
            @include mobile {
                margin-top: 23px;
            }

            .title {
                @include inter-400;
                font-size: 32px;
                line-height: 35px;
                margin-bottom: 32px;
            }

            .desc {
                @include inter-400;
                font-size: 24px;
                line-height: 26px;
                margin-bottom: 64px;
                @include mobile {
                    margin-bottom: 44px;
                }
            }

            .buttons {
                display: flex;
                align-items: center;
                gap: 0 56px;

                button {
                    @include green-button;
                    width: 227px;
                    height: 58px;
                    text-align: center;
                    @include mobile {
                        width: 120px;
                        height: 48px;
                        text-align: center;
                    }

                    &:hover {
                        @include green-button-hover;
                    }
                }
            }
        }
    }
}
</style>
