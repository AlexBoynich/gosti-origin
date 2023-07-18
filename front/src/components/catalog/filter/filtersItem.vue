<template>
    <div class="filter-item">
        <div
            :id="filtersItem.id"
            :class="['checkbox', {'active' : !filtersItem.isActive}]"
            @click="pickFilter"
        >
            <img src="/images/catalog/filters/active-icon.svg" alt="active-icon">
        </div>
        <label :for="filtersItem.id">{{ filtersItem.label }}</label>
        <img :src="filtersItem.img" alt="filter-img">
    </div>
</template>

<script>
export default {
    name: "filtersItem",
    methods: {
        pickFilter() {
            this.$emit('pickFilter', this.filtersItem.id)
        }
    },
    props: ['filtersItem']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.filter-item {
    display: flex;
    align-items: center;
    padding: 2px 0;

    .checkbox {
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        width: 20px;
        height: 20px;
        border: 1px solid rgba(123, 149, 97, 0.5);
        border-radius: 3px;
        margin-right: 16px;

        img {
            width: 14px;
            height: 12px;
            display: none;
        }

        &.active {
            border: 1px solid $olive;

            img {
                display: flex;
            }
        }

        &:hover {
            border: 1px solid $olive;
        }
    }

    label {
        color: #000;
        @include inter-400;
        line-height: 110%;
        letter-spacing: -0.36px;
        margin-right: 8px;
    }

    img {
        width: 20px;
        height: 20px;
    }
}
</style>
