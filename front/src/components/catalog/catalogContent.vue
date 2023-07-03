<template>
    <div class="catalog-content">
        <div
            v-show="showMessage"
            :class="['message', {'bad' : !isGood}]"
        >
            <div class="txt" v-show="activeIndices.categoriesIndex === 0">
                {{ messageContent.first }}
            </div>
            <div class="txt" v-show="activeIndices.categoriesIndex === 1">
                {{ messageContent.second }}
            </div>
        </div>
        <div class="categories-title">
            {{ catalogContent.categoriesTitle }}
        </div>
        <div class="subcategories-title">
            {{ catalogContent.subcategoriesTitle }}
        </div>
        <div class="catalog-items">
            <catalogItem
                v-for="(catalogItem, index) in catalogItems"
                :key="index"
                :catalogItem="catalogItem"
                @openModal="openModal"
            />
        </div>
        <catalogItemModal
            v-show="modalIsActive"
            @closeModal="closeModal"
            :catalogItem="itemInModal"
        />
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import catalogItem from "@/components/catalog/catalogItem/catalogItem.vue";
import catalogItemModal from "@/components/catalog/catalogItem/catalogItemModal.vue";

export default {
    name: "catalogContent",
    data () {
        return {
            modalIsActive: false,
            isGood: true,
            messageContent: {
                first: 'Завтраки действуют по будням с 8:00 — 12:00/ по выходным с 8:00 — 16:00',
                second: 'Бизнес-ланчи действуют по будням с 12:00 — 16:00'
            },
            itemInModal: {}
        }
    },
    computed: {
        ...mapState('catalogItems', ['catalogItems']),
        showMessage: function () {
            return this.activeIndices.categoriesIndex === 0 || this.activeIndices.categoriesIndex === 1;
        }
    },
    methods: {
        ...mapActions('catalogItems', ['GET_CATALOG_ITEMS']),
        closeScroll: function () {
            let body = document.querySelector('body')

            if (this.modalIsActive) {
                body.style.overflow = 'hidden'
            } else {
                body.style.overflow = ''
            }
        },
        openModal (item) {
            this.itemInModal = item
            this.modalIsActive = true
        },
        closeModal (act) {
            this.modalIsActive = act
        }
    },
    components: {
        catalogItem,
        catalogItemModal
    },
    props: ['activeIndices'],
    created() {
        this.GET_CATALOG_ITEMS(),
    },
    updated() {
        this.closeScroll()
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
.catalog-content {
    padding-bottom: 120px;

    .message {
        border-radius: 16px;
        padding: 40px 93px;
        margin-bottom: 24px;
        background: #DFE8D7;
        border-left: solid 5px $greenBackground;

        .txt {
            @include inter-400;
            color: #000;
            font-size: 20px;
            line-height: 140%;
            letter-spacing: -0.4px;
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
        width: 100%;
    }
}
</style>
