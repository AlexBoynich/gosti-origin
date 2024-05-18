<template>
    <div :class="['categories-item', {'active' : categoriesItem.id === activeIndices.categoriesIndex}]">

        <div  class="categories-body">
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
import { mapActions } from "vuex";

export default {
    name: "categoriesItem",
    methods: {
        ...mapActions(['CHANGE_SHOW_CATALOG']),

        toggleCategory() {
            this.$emit('toggleCategory', this.categoriesItem.id)
        },
        pickSubcategories(subcategory) {
            this.$emit('pickSubcategories', subcategory)
            this.CHANGE_SHOW_CATALOG(false)
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
    border: none;
    background: #fff;
    overflow: hidden;
    @include mobile {
        white-space: nowrap;
    }

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
            transition: .3s ease-in-out;

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
        padding: 12px 0 40px;
        color: #000000;
        &::-webkit-scrollbar-thumb{
            background: black;
        }
        @include mobile {
            flex-direction: row;
            overflow-x: scroll;
            overflow-y: auto;
            padding: 0;
            border: none;
            scrollbar-width: 0;
            scrollbar-color: transparent;
            gap: 0 16px;
            ::-webkit-scrollbar{
                background: transparent;
                width: 0;
                height: 0;
            }
        }

    }

    &.active, &:hover {
        color: white;

        .categories-header {
            background: $paleGreen;
            color: white;
        }
    }
}
</style>
