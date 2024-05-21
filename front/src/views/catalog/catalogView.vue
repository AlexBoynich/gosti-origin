<template>
    <div>       
        <div id="catalog" class="container">
        <sidebarBlock
            class="categories"
            @activeItems="setActiveItems"
            @pickFilter="setFilter"
            :filters="filters"
            :activeItemsForSidebar="activeItems"
        />
        <catalogContent
            :activeItems="activeItems"
            :catalogItems="catalogItems"
            ref="catalogContent"
            @goToCatalog="goToCatalog"
        />
    </div>
    </div>
</template>

<script>
import sidebarBlock from "../../components/catalog/categories/sidebarBlock";
import catalogContent from "../../components/catalog/catalogContent";
import {mapActions, mapState, mapGetters  } from "vuex";
import {onTop} from "@/utils/helpers";

export default {
    name: "catalogView",
    data() {
        return {
            activeItems: {
                categoriesTitle: '',
                categoriesIndex: 0,
                subcategoriesTitle: '',
                subcategoriesIndex: 10
            },
            width: 0,
            filters: [
                {
                    isActive: true,
                    label: 'без сахара',
                    id: 1,
                    img: '/images/catalog/filters/filters-img-1.svg',
                    forRequest: 'sugar'
                },
                {
                    isActive: true,
                    label: 'без глютена',
                    id: 2,
                    img: '/images/catalog/filters/filters-img-2.svg',
                    forRequest: 'gluten'
                },
                {
                    isActive: true,
                    label: 'без лактозы',
                    id: 3,
                    img: '/images/catalog/filters/filters-img-3.svg',
                    forRequest: 'lactose'
                },
            ],
            filtersForRequest: {}
        }
    },
    computed: {
        ...mapGetters(['GET_SHOW_CATALOG']),
        ...mapGetters(['GET_SUGAR']),
        ...mapGetters(['GET_GLUTEN']),
        ...mapGetters(['GET_LACTOSE']),
        ...mapState('catalogItems', ['catalogItems']),
        ...mapState('categories', ['categories']),
    },
    methods: {
        ...mapActions('catalogItems', ['GET_CATALOG_ITEMS']),
        onTop,
         setActiveItems(el) {
            this.activeItems.categoriesTitle = el.categoryTitle
            this.activeItems.categoriesIndex = el.categoriesIndex
            this.activeItems.subcategoriesTitle = el.subcategoryTitle
            this.activeItems.subcategoriesIndex = el.subcategoriesIndex

            if (!el.subcategoriesIndex) {
                this.activeItems.subcategoriesIndex = 10
            } else {
                this.activeItems.subcategoriesIndex = el.subcategoriesIndex
            }

            for (let i = 0; i < this.filters.length; i++) {
                this.filters[i].isActive = true
            }
            Object.keys(this.filtersForRequest).forEach(key => delete this.filtersForRequest[key])

            this.GET_CATALOG_ITEMS({
                subcategoryId: this.activeItems.subcategoriesIndex,
                requestFilter: ''
            })

            this.$refs.catalogContent.checkTime(this.activeItems.categoriesIndex);

            this.onTop('smooth')
        },
        setFilter(obj) {
            this.filters[obj.id - 1].isActive = !this.filters[obj.id - 1].isActive

            function generateFilterRequest(sugar, gluten, lactose, filtersForRequest) {

                if (!sugar) {
                    filtersForRequest.sugar = 0
                } else {
                    delete filtersForRequest.sugar
                }
                if (!gluten) {
                    filtersForRequest.gluten = 0
                } else {
                    delete filtersForRequest.gluten
                }
                if (!lactose) {
                    filtersForRequest.lactose = 0
                } else {
                    delete filtersForRequest.lactose
                }

                return Object.keys(filtersForRequest)
                    .map(key => `${key}=${filtersForRequest[key]}`)
                    .join('&')
            }

            this.GET_CATALOG_ITEMS({
                subcategoryId: this.activeItems.subcategoriesIndex,
                requestFilter: generateFilterRequest(this.filters[0].isActive, this.filters[1].isActive, this.filters[2].isActive, this.filtersForRequest)
            })
            this.onTop('smooth')
        },
        goToCatalog() {
            this.activeItems.categoriesIndex = 0
            this.activeItems.categoriesTitle = this.categories[0].title
            this.activeItems.subcategoriesIndex = 10
            this.activeItems.subcategoriesTitle = this.categories[0].subcategories[0].title

            for (let i = 0; i < this.filters.length; i++) {
                this.filters[i].isActive = true
            }
            Object.keys(this.filtersForRequest).forEach(key => delete this.filtersForRequest[key])

            this.$emit('goToCatalog',)
            this.GET_CATALOG_ITEMS({
                subcategoryId: 10,
                requestFilter: ''
            })
            this.onTop('smooth')
        },
    },
    components: {
        catalogContent,
        sidebarBlock,
    },
    created() {
        const onResize = () => this.width = window.innerWidth;
        onResize();
        window.addEventListener('resize', onResize);
        this.$on('hook:beforeDestroy', () => window.removeEventListener('resize', onResize));
        
    },
    // mounted() {
    //     this.filters[0].isActive = this.GET_SUGAR
    //     this.filters[1].isActive = this.GET_GLUTEN
    //     this.filters[2].isActive = this.GET_LACTOSE
    // }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

#catalog {
    display: flex;
    min-height: 100vh;
    margin-top: 174px;
    @include mobile {
        flex-direction: column;
        margin-top: 73px;
        min-height: auto;
        padding-top: 0;
    }

    .categories {
        max-width: 274px;
        margin-right: 48px;

        @include mobile {
            margin-right: 0;
            padding: 0;
            max-width: 100%;
            width: 100%;
        }
    }
}
</style>
