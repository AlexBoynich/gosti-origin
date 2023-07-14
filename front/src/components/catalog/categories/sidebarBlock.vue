<template>
    <div class="categories-block container">
        <aside>
            <div class="title">Каталог</div>
            <div class="content">
                <div class="categories">
                    <CategoriesItem
                            v-for="category in categories"
                            :key="category.id"
                            :categoriesItem="category"
                            :activeIndices="activeIndices"
                            @toggleCategory="toggleCategory"
                            @pickSubcategories="activeItems"
                    />
                </div>
                <div class="filters-box">
                    <div class="title">Фильтр</div>
                    <div class="filters">
                        <FiltersItem
                                v-for="filter in filters"
                                :key="filter.id"
                                :filtersItem="filter"
                                @pickFilter="pickFilter"
                        />
                    </div>
                </div>
            </div>
        </aside>
    </div>
</template>

<script>
import CategoriesItem from "@/components/catalog/categories/categoriesItem";
import FiltersItem from "@/components/catalog/filter/filtersItem";
import {mapActions, mapState} from "vuex";

export default {
    name: "sidebarBlock",
    data() {
        return {
            title: 'Каталог',
            activeIndices: {
                categoriesIndex: 1,
                subcategoriesIndex: 1
            }
        }
    },
    computed: {
        ...mapState('categories', ['categories']),
    },
    methods: {
        ...mapActions('categories', ['GET_CATEGORIES']),
        toggleCategory(id) {
            if (this.activeIndices.categoriesIndex === id) {
                this.activeIndices.categoriesIndex = null
                this.categories[id - 1].isActive = false
            } else {
                this.activeIndices.categoriesIndex = id
                this.categories[id - 1].isActive = true
            }
        },
        pickFilter(id) {
            this.$emit('pickFilter', {
                id: id
            })
        },
        activeItems(subcategory) {
            if (!subcategory) {
                let categoriesName = this.categories[0].title
                let subcategoriesName = this.categories[0].subcategories[0].title

                this.$emit('activeItems', {
                    categoryTitle: categoriesName,
                    categoriesIndex: 0,
                    subcategoryTitle: subcategoriesName,
                    subcategoriesIndex: 0
                })
            } else {
                this.activeIndices.subcategoriesIndex = subcategory.id

                this.$emit('activeItems', {
                    categoryTitle: this.categories[this.activeIndices.categoriesIndex - 1].title,
                    categoriesIndex: this.activeIndices.categoriesIndex - 1,
                    subcategoryTitle: subcategory.title,
                    subcategoriesIndex: subcategory.id
                })
            }
        },
        goToCatalog() {
            this.activeIndices.categoriesIndex = 1
            this.activeIndices.subcategoriesIndex = 1
        }
    },
    components: {
        FiltersItem,
        CategoriesItem
    },
    props: ['filters'],
    created() {
        this.GET_CATEGORIES();
        this.$parent.$on('goToCatalog', this.goToCatalog);
    },
    updated() {
        this.activeItems()
    },
    beforeDestroy() {
        this.$parent.$off('goToCatalog', this.goToCatalog);
    },
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

aside {
  max-width: 274px;
  width: 100%;
  height: 100%;

  .title {
    @include h2;
    margin-bottom: 16px;
  }

  .content {
    position: sticky;
    top: 130px;
    padding-bottom: 40px;

    .categories {
      display: flex;
      flex-direction: column;
      gap: 24px 0;
      margin-bottom: 48px;
    }

    .filters-box {

      .title {
        color: #000;
        @include inter-500;
        font-size: 20px;
        line-height: 110%;
        letter-spacing: -0.4px;
        margin-bottom: 24px;
      }

      .filters {
        display: flex;
        flex-direction: column;
        gap: 16px 0;
      }
    }
  }
}

</style>
