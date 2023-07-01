<template>
    <a class="subcategories-item" :href="subcategoriesItem.title">
        {{ subcategoriesItem.title }}
    </a>
</template>

<script>
export default {
    name: "subcategoriesItem",
    props: ['subcategoriesItem']
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

    &:hover {
        opacity: 1;
    }
}
</style>
