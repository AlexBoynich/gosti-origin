<template>
    <a
            :class="['subcategories-item',
            {'active' : this.subcategoriesItem.id === this.activeIndex}]"
            :href="subcategoriesItem.link"
            @click.prevent="pickSubcategories"
            @click="onTop('smooth')"
    >
        {{ subcategoriesItem.title }}
    </a>
</template>

<script>
import {onTop} from '@/utils/helpers.js'
export default {
    name: "subcategoriesItem",
    methods: {
        onTop,
        pickSubcategories () {
            this.$emit('pickSubcategories', {
                id: this.subcategoriesItem.id,
                title: this.subcategoriesItem.title
            })
        }
    },
    props: ['subcategoriesItem', 'activeIndex']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global.scss";

.subcategories-item {
    margin-left: 48px;
    font-size: 18px;
    cursor: pointer;
    text-decoration: none;
    color: black;
    opacity: .5;

    &.active {
      opacity: 1;
    }

    &:hover {
        opacity: 1;
    }
}
</style>
