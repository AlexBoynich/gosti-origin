<template>
    <div id="catalog" class="container">
        <categoriesBlock class="categories"/>
        <catalogContent />
    </div>
</template>

<script>
import categoriesBlock from "../../components/catalog/categories/sidebarBlock";
import catalogContent from "../../components/catalog/catalogContent";

export default {
    name: "catalogView",
    components: {catalogContent, categoriesBlock}
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

#catalog {
    display: flex;
    min-height: 100vh;
    padding-top: 174px;

    .categories {
        max-width: 274px;
        margin-right: 48px;
    }
}
</style>
