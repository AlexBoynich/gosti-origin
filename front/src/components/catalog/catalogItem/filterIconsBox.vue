<template>
    <div class="filter-items-box">
        <div
            v-if="!catalogItem.sugar"
            class="filter-icon"
            @mouseover="hintOnHover('s')"
            @mouseleave="closeHint"
        >
            <div v-show="sugar" class="message">
                без сахара
            </div>
            <img
                src="/images/catalog/catalogItem/filterIcon/no-sugar.svg"
                alt="filter-icon"
            >

        </div>
        <div
            v-if="!catalogItem.gluten"
            class="filter-icon"
            @mouseover="hintOnHover('g')"
            @mouseleave="closeHint"
        >
            <div v-show="gluten" class="message">
                без глютена
            </div>
            <img
                src="/images/catalog/catalogItem/filterIcon/no-gluten.svg"
                alt="filter-icon"
            >
        </div>
        <div
            v-if="!catalogItem.lactose"
            class="filter-icon"
            @mouseover="hintOnHover('l')"
            @mouseleave="closeHint"
        >
            <div v-show="lactose" class="message">
                без лактозы
            </div>
            <img
                src="/images/catalog/catalogItem/filterIcon/no-lactose.svg"
                alt="filter-icon"
            >
        </div>
    </div>
</template>

<script>
export default {
    name: "filterIconsBox",
    data() {
        return {
            sugar: false,
            gluten: false,
            lactose: false
        }
    },
    methods: {
        hintOnHover(el) {
            if (el === 's') {
                this.sugar = true
            } else if (el === 'g') {
                this.gluten = true
            } else {
                this.lactose = true
            }
        },
        closeHint() {
            this.sugar = false
            this.gluten = false
            this.lactose = false
        }
    },
    props: ['catalogItem']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.filter-items-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 1px solid #CECECE26;
    background: linear-gradient(0deg, rgba(206, 206, 206, 0.15), rgba(206, 206, 206, 0.15)),
    linear-gradient(0deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3));
    border-radius: 42px;
    padding: 6px 19px;
    gap: 6px;
    position: relative;

    .filter-icon {
        width: 22px;
        height: 22px;

        img {
            width: 22px;
            height: 22px;
        }

        .message {
            position: absolute;
            left: -97px;
            top: -62px;
            padding: 16px 0;
            width: 109px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            @include inter-400;
            font-size: 16px;
            line-height: 18px;
            background: linear-gradient(0deg, rgba(206, 206, 206, 0.15), rgba(206, 206, 206, 0.15)),
            linear-gradient(0deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3));
            border: 1px solid #CECECE26;
            border-radius: 16px;
        }
    }
}
</style>
