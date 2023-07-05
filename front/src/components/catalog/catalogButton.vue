<template>
    <div class="card-button">
        <template v-if="!stopList">
            <button
                v-show="!isActive"
                class="main-button"
                @click="inCart"
            >
                Добавить в корзину
            </button>
            <button
                v-show="isActive"
                class="button-counter"
            >
                <button @click="transformAmount('-')">
                    <img src="/images/catalog/cardButton/minus.svg" alt="minus">
                </button>

                <span class="count">{{ count }}</span>

                <button @click="transformAmount('+')">
                    <img src="/images/catalog/cardButton/plus.svg" alt="plus">
                </button>
            </button>
        </template>
        <template v-if="stopList">
            <button
                class="stop-list main-button"
                disabled
            >
                Недоступно к заказу
            </button>
        </template>
    </div>
</template>

<script>
export default {
    name: "catalogButton",
    data () {
        return {
            count: this.amount,
            isActive: false
        }
    },
    methods: {
        inCart () {
            this.count = 1
            this.isActive = true

        },
        transformAmount (action) {
            if (action === '-') {
                if (this.count === 1) {
                    this.count -= 1
                    this.isActive = false
                } else {
                    this.count -= 1
                }
            } else if (action === '+') {
                this.count += 1
            }
        },
    },
    props: ['stopList', 'amount']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
    .main-button {
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
            cursor: default;
        }
    }
    .button-counter {
        border-radius: 16px;
        background: $greenBackground;
        border: none;
        padding: 15px 0;
        color: white;
        @include inter-500;
        font-size: 20px;
        line-height: 110%;
        letter-spacing: -0.4px;
        text-align: center;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0 24px;

        button {
            border: none;
            background: transparent;
            max-width: 24px;
            max-height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;

            img {
                width: 24px;
                height: 24px;
            }
        }
    }
</style>
