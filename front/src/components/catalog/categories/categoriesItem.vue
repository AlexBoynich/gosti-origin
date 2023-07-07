<template>
    <div :class="['categories-item', {'active' : categoriesItem.id === activeIndices.categoriesIndex}]">
        <div :class="['categories-header', {'active' : categoriesItem.id === activeIndices.categoriesIndex}]" @click="toggleCategory()">
            <div class="categories-title">
                {{ categoriesItem.title }}
            </div>
            <img src="/images/catalog/categories/categories-arrow.svg" alt="categories-arrow" :class="['toggle-arrow', { 'reverse-arrow' : categoriesItem.id === activeIndices.categoriesIndex}]">
        </div>
        <div v-show="categoriesItem.id === activeIndices.categoriesIndex" class="categories-body">
            <subcategoriesItem
                v-for="(item, index) in categoriesItem.subcategories"
                :key="index"
                :subcategoriesItem="item"
                :activeIndex="activeIndices.subcategoriesIndex"
                @pickSubcategories="pickSubcategories"
            />
        </div>
    </div>
</template>

<script>
import subcategoriesItem from "@/components/catalog/categories/subcategoriesItem";
export default {
    name: "categoriesItem",
    methods: {
        toggleCategory () {
            this.$emit('toggleCategory', this.categoriesItem.id)
        },
        pickSubcategories (subcategory) {
            this.$emit('pickSubcategories', subcategory)
        }
    },
    props: ['categoriesItem', 'activeIndices'],
    components: {
        subcategoriesItem
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
.categories-item {
    width: 100%;
    color: black;
    border-radius: 16px;
    border: 1px solid $greenBackground;
    background: #fff;
    overflow: hidden;

    .categories-header {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        cursor: pointer;
        position: relative;
        padding: 16px 0;

        &.active {
            padding: 16px 0 12px;
        }

        .categories-title {
            text-align: center;
            @include inter-500;
            color: #000;
            font-size: 20px;
            line-height: 110%;
            letter-spacing: -0.4px;
        }
        .toggle-arrow {
            position: absolute;
            right: 16px;
            width: 16px;
            height: 8px;

            &.reverse-arrow {
                transform: rotate(180deg);
            }
        }
    }
    .categories-body {
        display: flex;
        flex-direction: column;
        @include inter-400;
        line-height: 110%;
        letter-spacing: -0.36px;
        text-align: left;
        gap: 16px 0;
        margin: 12px 0 40px;
    }

    &.active {
        background: #EFF4EB;
        color: white;

        .categories-header {
            background: #EFF4EB;
            color: white;
        }
    }
}
</style>
