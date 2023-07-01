<template>
    <div class="catalog-block container">
        <aside>
            <div class="title">Каталог</div>
            <div class="categories">
                <CategoriesItem
                    v-for="(category, index) in categories"
                    :key="index"
                    :categoriesItem="category"
                    :activeIndex="activeIndex"
                    @toggleCategory="toggleCategory"
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
        </aside>
        <div class="catalog-content">
            <div :class="['message', {'good' : isGood, 'bad' : !isGood}]">
                <div class="txt">
                    Завтраки действуют по будням с 8:00 — 12:00/ по выходным с 8:00 — 16:00
                </div>
            </div>
            <div class="categories-title">
                Завтраки
            </div>
            <div class="subcategories-title">
                Каши
            </div>
            <div class="catalog-items">
                <catalogItem
                    v-for="(catalogItem, index) in catalogItems"
                    :key="index"
                    :catalogItem="catalogItem"
                />
            </div>
        </div>
    </div>
</template>

<script>
import CategoriesItem from "@/components/catalog/categories/categoriesItem";
import FiltersItem from "@/components/catalog/filter/filtersItem";
import catalogItem from "@/components/catalog/catalogItem/catalogItem";
import {mapActions, mapState} from "vuex";
export default {
    name: "catalogBlock",
    data () {
        return {
            title: 'Каталог',
            activeIndex: 0,
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
            ],
            isGood: true,
            catalogItems: [
                {
                    stopList: false,
                    img: '/images/catalog/catalogItem/product-image.png',
                    title: 'Кукурузная каша с пармезаном и яйцом пашот',
                    price: '520 ₽',
                    weight: '440 г'
                },
                {
                    stopList: false,
                    img: '/images/catalog/catalogItem/product-image.png',
                    title: 'Кукурузная каша с пармезаном и яйцом пашот',
                    price: '520 ₽',
                    weight: '440 г'
                },
                {
                    stopList: false,
                    img: '/images/catalog/catalogItem/product-image.png',
                    title: 'Кукурузная каша с пармезаном и яйцом пашот',
                    price: '520 ₽',
                    weight: '440 г'
                },
                {
                    stopList: false,
                    img: '/images/catalog/catalogItem/product-image.png',
                    title: 'Кукурузная каша с пармезаном и яйцом пашот',
                    price: '520 ₽',
                    weight: '440 г'
                },
                {
                    stopList: false,
                    img: '/images/catalog/catalogItem/product-image.png',
                    title: 'Кукурузная каша с пармезаном и яйцом пашот',
                    price: '520 ₽',
                    weight: '440 г'
                },
                {
                    stopList: false,
                    img: '/images/catalog/catalogItem/product-image.png',
                    title: 'Кукурузная каша с пармезаном и яйцом пашот',
                    price: '520 ₽',
                    weight: '440 г'
                }
            ]
        }
    },
    computed: {
        ...mapState('categories', ['categories'])
    },
    methods: {
        toggleCategory (id) {
            if (this.activeIndex === id) {
                this.activeIndex = null
                this.categories[id].isActive = false
            } else {
                this.activeIndex = id
                this.categories[id].isActive = true
            }
        },
        pickFilter (id) {
            this.filters[id].isActive = !this.filters[id].isActive
        },
        ...mapActions('categories',['GET_CATEGORIES'])
    },
    components: {
        FiltersItem,
        CategoriesItem,
        catalogItem
    },
    created() {
        this.GET_CATEGORIES()
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
.catalog-block {
        min-height: 100vh;
        padding-top: 174px;
        display: flex;

        aside {
            max-width: 274px;
            width: 100%;
            margin-right: 48px;

            .title {
                @include inter-500;
                color: #000;
                font-size: 72px;
                line-height: 110%;
                letter-spacing: -1.8px;
                margin-bottom: 16px;
            }

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
        .catalog-content {
            padding-bottom: 120px;

            .message {
                width: 100%;
                border-radius: 16px;
                padding: 40px;
                margin-bottom: 24px;

                .txt {
                    @include inter-400;
                    max-width: 732px;
                    color: #000;
                    font-size: 20px;
                    line-height: 140%;
                    letter-spacing: -0.4px;
                }
                &.good {
                    background: #DFE8D7;
                    border-left: solid 5px $greenBackground;
                }
                &.bad {
                    background: #F3DADA;
                    border-left: 5px solid #C94040
                }
            }
            .categories-title {
                @include inter-500;
                color: #000;
                font-size: 24px;
                line-height: 110%;
                letter-spacing: -0.48px;
                margin-bottom: 16px;
            }
            .subcategories-title {
                color: #000;
                @include inter-400;
                line-height: 110%;
                letter-spacing: -0.36px;
                margin-bottom: 16px
            }
            .catalog-items {
                display: flex;
                flex-wrap: wrap;
                gap: 48px 40px;
            }
        }
    }
</style>
