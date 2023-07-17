<template>
    <div class="container">
        <div class="cookie-modal">
            <button class="close-modal" @click="closeModal">
                <img src="/images/catalog/catalogItem/modal/close-modal.svg" alt="close-modal">
            </button>
            <div class="modal-content">
                Наш сайт использует файлы cookie, чтобы улучшить работу сайта, повысить его эффективность и удобство.
                Продолжая использовать наш сайт, вы соглашаетесь на использование файлов cookie.
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "cookieModal",
    methods: {
        closeModal() {
            this.$emit('closeModal')
        }
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.container {
    position: fixed;
    z-index: 100;
    left: 0;
    right: 0;
    bottom: 16px;

    .cookie-modal {
        width: 100%;
        padding: 42px 64px;
        border: 1px solid $olive;
        background: $paleYellow;
        position: relative;
        border-radius: 16px;

        .close-modal {
            cursor: pointer;
            background: transparent;
            border: none;
            position: absolute;
            right: 24px;
            top: 24px;
            width: 17px;
            height: 16px;

            img {
                width: 100%;
                height: 100%;
            }
        }

        .modal-content {
            max-width: 1042px;
            @include inter-400;
            line-height: 22px;
            font-size: 20px;
        }
    }
}

</style>
