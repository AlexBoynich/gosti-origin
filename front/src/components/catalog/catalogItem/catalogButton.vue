<template>
    <div class="card-button">
        <button
            v-if="!stopList"
        >
            Добавить в корзину
        </button>
        <button
            v-if="stopList"
            class="stop-list"
        >
            Недоступно к заказу
        </button>
    </div>
</template>

<script>
export default {
    name: "catalogButton",
    props: ['stopList']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
    button {
        border-radius: 16px;
        background: $greenBackground;
        border: none;
        padding: 16px 0;
        color: white;
        @include inter-500;
        font-size: 20px;
        line-height: 110%;
        letter-spacing: -0.4px;
        text-align: center;
        cursor: pointer;
        width: 100%;

        &.stop-list {
            background: #BDCAB0;
        }
    }
</style>
