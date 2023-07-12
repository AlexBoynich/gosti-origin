<template>
    <div class="card-button">
        <template v-if="catalogItem.isAvailabel">
            <button
                v-show="!isActive"
                class="main-button default-button"
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

                <div class="count">{{ amount }}</div>

                <button @click="transformAmount('+')">
                    <img src="/images/catalog/cardButton/plus.svg" alt="plus">
                </button>
            </button>
        </template>
        <template v-if="!catalogItem.isAvailabel">
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

import {mapState} from "vuex";

export default {
    name: "catalogButton",
    data() {
        return {
            counter: this.amount,
        }
    },
    computed: {
        ...mapState('catalogItems', ['catalogItems']),
        count: function () {
            let index = this.catalogItems.findIndex((el) => el.id === this.catalogItem.id)
            console.log(this.catalogItems[index])
            return this.catalogItems[index].count
        },
        isActive: function () {
            return this.counter > 0
        }
    },
    methods: {
        inCart() {
            this.counter = 1
            this.$emit('inCart')
        },
        transformAmount(action) {
            if (action === '-') {
                if (this.counter === 1) {
                    this.counter -= 1
                } else {
                    this.counter -= 1
                }
            } else if (action === '+') {
                if (this.counter < 99) {
                    this.counter += 1
                }
            }

            this.$emit('transformAmount', {
                id: this.catalogItem.id,
                count: this.counter
            })
        },
    },
    updated() {
        this.counter = this.amount
    },
    props: ['catalogItem', 'amount'],
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
    &.default-button:hover {
        background: #C1D4B2;
        color: black;
    }
}

.button-counter {
    border-radius: 16px;
    background: #C1D4B2;
    border: none;
    padding: 13px 0;
    color: black;
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


    .count {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 28px;

    }

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
