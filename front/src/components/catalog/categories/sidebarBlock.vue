<template>
    <div class="categories-block container">
        <aside>
            <div class="title">Каталог</div>
            <div class="content">
                <div class="categories">
                    <CategoriesItem
                        v-for="(category, index) in categories"
                        :key="index"
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
                            v-for="(filter, index) in filters"
                            :key="index"
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
            },
            filters: [
                {
                    isActive: false,
                    label: 'без сахара',
                    id: '0',
                    img: '/images/catalog/filters/filters-img-1.svg'
                },
                {
                    isActive: false,
                    label: 'без глютена',
                    id: '1',
                    img: '/images/catalog/filters/filters-img-2.svg'
                },
                {
                    isActive: false,
                    label: 'без лактозы',
                    id: '2',
                    img: '/images/catalog/filters/filters-img-3.svg'
                },
            ]
        }
    },
    computed: {
        ...mapState('categories', ['categories']),
    },
    methods: {
        toggleCategory (id) {
            if (this.activeIndices.categoriesIndex === id) {
                this.activeIndices.categoriesIndex = null
                this.categories[id].isActive = false
            } else {
                this.activeIndices.categoriesIndex = id
                this.activeIndices.subcategoriesIndex = null
                this.categories[id].isActive = true
            }
        },
        pickFilter (id) {
            this.filters[id].isActive = !this.filters[id].isActive
        },
        activeItems (subcategory) {
            if (!subcategory) {
                let categoriesName = this.categories[0].name
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
                    categoryTitle: this.categories[this.activeIndices.categoriesIndex - 1].name,
                    categoriesIndex: this.activeIndices.categoriesIndex - 1,
                    subcategoryTitle: subcategory.title,
                    subcategoriesIndex: subcategory.id
                })
            }

        },
        ...mapActions('categories', ['GET_CATEGORIES'])
    },
    components: {
        FiltersItem,
        CategoriesItem
    },
    created() {
        this.GET_CATEGORIES();
    },
    beforeUpdate() {
        this.activeItems()
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

aside {
    max-width: 274px;
    width: 100%;
    height: 100%;

    .title {
        @include inter-500;
        color: #000;
        font-size: 72px;
        line-height: 110%;
        letter-spacing: -1.8px;
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
