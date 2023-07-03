<template>
    <a
            :class="['subcategories-item',
            {'active' : this.activeIndex === this.subcategoriesItem.id}]"
            :href="subcategoriesItem.link"
            @click="pickSubcategories"
    >
        {{ subcategoriesItem.title }}
    </a>
</template>

<script>
export default {
    name: "subcategoriesItem",
    methods: {
        pickSubcategories () {
            this.$emit('pickSubcategories', this.subcategoriesItem.id)
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
