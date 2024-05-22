<template>
    <div class="categories-block container">
        <aside>
            
            <div class="content">
                <div :class="['categories', {'margin-0' : !showOnMobile()}]">
                    <CategoriesItem
                        v-for="category in categories.slice(2, 3)"
                        :key="category.id"
                        :categoriesItem="category"
                        :activeIndices="activeIndices"
                        @toggleCategory="toggleCategory"
                        @pickSubcategories="activeItems"
                    />
                </div>
                <div 
                class="filters-box"
                >
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
import {mapActions, mapState, mapGetters} from "vuex";

export default {
    name: "sidebarBlock",
    data() {
        return {
            title: 'Каталог',
            activeIndices: {
                categoriesIndex: 0,
                subcategoriesIndex: 10
            },
            width: 0,
        }
    },
    computed: {
        ...mapState('categories', ['categories']),
        ...mapGetters(['GET_SHOW_CATALOG'])
    },
    methods: {
        ...mapActions('categories', ['GET_CATEGORIES']),
        ...mapActions(['CHANGE_SHOW_CATALOG']),

        toggleCategory(id) {
            if (this.activeIndices.categoriesIndex === id) {
                this.activeIndices.categoriesIndex = null
                this.categories[id - 1].isActive = false
            } else {
                this.activeIndices.categoriesIndex = id
                this.categories[id - 1].isActive = true
            }
        },
        showOnMobile() {
            if (this.width < 800 && this.GET_SHOW_CATALOG !== true) {
                return false
            }
            else return true
        },
        pickFilter(id) {
            this.$emit('pickFilter', {
                id: id
            })
        },
        activeItems(subcategory) {
            if (!subcategory) {
                let categoriesName = 'Основное меню'
                let subcategoriesName = 'Салаты'

                this.$emit('activeItems', {
                    categoryTitle: categoriesName,
                    categoriesIndex: 0,
                    subcategoryTitle: subcategoriesName,
                    subcategoriesIndex: 0
                })
            } else {
                this.activeIndices.subcategoriesIndex = subcategory.id

                this.$emit('activeItems', {
                    categoryTitle: 1,
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
    props: ['filters', 'activeItemsForSidebar'],
    created() {
        this.GET_CATEGORIES();
        this.$parent.$on('goToCatalog', this.goToCatalog);

        const onResize = () => this.width = window.innerWidth;
        onResize();
        window.addEventListener('resize', onResize);
        this.$on('hook:beforeDestroy', () => window.removeEventListener('resize', onResize));
    },
    mounted() {
        this.activeItems()
    },
    beforeDestroy() {
        this.$parent.$off('goToCatalog', this.goToCatalog);
    },
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";


.margin-0{
     margin: 0 !important;
}

aside {
    max-width: 274px;
    width: 100%;
    height: 100%;

    .breadcrumbsMobile {
        font-family: 'Inter', sans-serif;
        font-size: 18px;
        font-weight: 400;
        line-height: 19.8px;
        text-align: left;
        color: #000000;
        margin-top: 16px;

        @include desktop {
            display: none;
        }
    }
    
    @include mobile {
        max-width: 100%;
    }

    .title {
        @include h2;
        margin-bottom: 16px;
        @include mobile {
            margin-bottom: 50px;
        }
    }
    .titleMobile {
        display: flex;
        gap: 16px;
        padding-top: 15px;

        img {
            width: 20px;
            height: 17px;
        }
    }

    .content {
        position: sticky;
        top: 130px;
        padding-bottom: 40px;
        
        @include mobile {
            width: 100%;
            margin-top: 16px;
            padding-bottom: 0;
            gap: 30px;
            display: flex;
            flex-direction: column;
        }

        .categories {
            display: flex;
            flex-direction: column;
            gap: 24px 0;
            margin-bottom: 48px;
            @include mobile {
                margin-bottom: 0;
            }
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
                
                @include mobile {
                    flex-direction: row;
                    overflow: scroll;
                    margin-bottom: 20px;
                    scrollbar-width: none;
                    -ms-overflow-style: none;
                    ::-webkit-scrollbar{
                        display: none;
                    }
                }
            }
        }
    }
}

</style>
