<template>
    <div class="modal-mask" @click="closeOnClickOutside">
        <div class="modal-container">
            <button class="close-modal" @click="closeModal">
                <img src="/images/catalog/catalogItem/modal/close-modal.svg" alt="close-modal">
            </button>
            <div class="modal-content">
                <div class="title">Ошибка</div>
                <div class="desc">Не все обязательные поля заполнены или заполнены с ошибкой</div>
                <button @click="closeModal">Хорошо</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "validationError",
    methods: {
        closeModal() {
            this.$emit('closeModal')
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
                text-align: center;
                max-width: 500px;
            }

            button {
                @include green-button;
                width: 227px;
                height: 58px;
                text-align: center;

                &:hover {
                    @include green-button-hover;
                }
            }

        }
    }
}
</style>
