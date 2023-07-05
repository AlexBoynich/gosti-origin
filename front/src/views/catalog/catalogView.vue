<template>
    <div id="catalog" class="container">
        <sidebarBlock class="categories" @activeItems="getActiveItems"/>
        <catalogContent :activeItems="activeItems" :catalogItems="catalogItems"/>
    </div>
</template>

<script>
import sidebarBlock from "../../components/catalog/categories/sidebarBlock";
import catalogContent from "../../components/catalog/catalogContent";
import {mapActions, mapState} from "vuex";

export default {
    name: "catalogView",
    data () {
        return {
            activeItems: {
                categoriesTitle: '',
                categoriesIndex: 0,
                subcategoriesTitle: '',
                subcategoriesIndex: 1
            }
        }
    },
    computed: {
        ...mapState('catalogItems', ['catalogItems']),
    },
    methods: {
        ...mapActions('catalogItems', ['GET_CATALOG_ITEMS']),
        getActiveItems (el) {
            this.activeItems.categoriesTitle = el.categoryTitle
            this.activeItems.categoriesIndex = el.categoriesIndex
            this.activeItems.subcategoriesTitle = el.subcategoryTitle
            this.activeItems.subcategoriesIndex = el.subcategoriesIndex

            if (!el.subcategoriesIndex) {
                this.activeItems.subcategoriesIndex = 1
            } else {
                this.activeItems.subcategoriesIndex = el.subcategoriesIndex
            }

            this.GET_CATALOG_ITEMS({
                subcategoryId: this.activeItems.subcategoriesIndex
            })
        },
    },
    components: {
        catalogContent,
        sidebarBlock
    },
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
