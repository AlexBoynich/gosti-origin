<template>
    <div id="catalog" class="container">
        <sidebarBlock class="categories" @activeItems="activeItems"/>
        <catalogContent :activeIndices="activeIndices"/>
    </div>
</template>

<script>
import sidebarBlock from "../../components/catalog/categories/sidebarBlock";
import catalogContent from "../../components/catalog/catalogContent";

export default {
    name: "catalogView",
    data () {
        return {
            activeIndices: {
                categoriesIndex: 0,
                subcategoriesIndex: 0
            }
        }
    },
    methods: {
        activeItems (el) {
            this.activeIndices.categoriesIndex = el.categoriesIndex
            if (!el.subcategoriesIndex) {
                this.activeIndices.subcategoriesIndex = 0
            } else {
                this.activeIndices.subcategoriesIndex = el.subcategoriesIndex
            }
            console.log(this.activeIndices)
        }
    },
    components: {catalogContent, sidebarBlock}
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
