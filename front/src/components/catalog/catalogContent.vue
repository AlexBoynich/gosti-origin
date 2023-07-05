<template>
    <div class="catalog-content">
        <div
                v-show="showMessage"
                :class="['message', {'bad' : !isGood}]"
        >
            <div class="txt" v-show="activeItems.categoriesIndex === 0">
                {{ messageContent.first }}
            </div>
            <div class="txt" v-show="activeItems.categoriesIndex === 1">
                {{ messageContent.second }}
            </div>
        </div>
        <div :class="['categories-title', {'no-message' : !showMessage}]">
            {{ activeItems.categoriesTitle }}
        </div>
        <div class="subcategories-title">
            {{ activeItems.subcategoriesTitle }}
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
import catalogItem from "@/components/catalog/catalogItem/catalogItem.vue";
import catalogItemModal from "@/components/catalog/catalogItem/catalogItemModal.vue";

export default {
    name: "catalogContent",
    data() {
        return {
            modalIsActive: false,
            messageContent: {
                first: 'Завтраки действуют по будням с 8:00 — 12:00/ по выходным с 8:00 — 16:00',
                second: 'Бизнес-ланчи действуют по будням с 12:00 — 16:00'
            },
            itemInModal: {},
            isGood: true,
        }
    },
    computed: {
        showMessage: function () {
            return this.activeItems.categoriesIndex === 0 || this.activeItems.categoriesIndex === 1;
        },
    },
    methods: {
        checkTime (id) {
            let date = new Date();
            let hour = date.getHours()
            const options = { weekday: 'long' };
            const dayOfWeek = date.toLocaleString('en-US', options);
            if (id === 0) {
                if (dayOfWeek === 'Saturday' || dayOfWeek === 'Sunday') {
                    this.isGood = hour > 8 && hour < 16
                } else {
                    this.isGood = hour > 8 && hour < 12
                }
            } else if (id === 1) {
                if (dayOfWeek === 'Saturday' || dayOfWeek === 'Sunday') {
                    this.isGood = false
                } else {
                    this.isGood = hour > 12 && hour < 16;
                }
            }
        },
        closeScroll () {
            let body = document.querySelector('body')

            if (this.modalIsActive) {
                body.style.overflow = 'hidden'
            } else {
                body.style.overflow = ''
            }
        },
        openModal(item) {
            this.itemInModal = item
            this.modalIsActive = true
        },
        closeModal(act) {
            this.modalIsActive = act
        }
    },
    components: {
        catalogItem,
        catalogItemModal
    },
    props: ['activeItems', 'catalogItems'],
    updated() {
        this.closeScroll()
        this.checkTime(this.activeItems.categoriesIndex)
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

    &.no-message {
      margin-top: 95px;
    }
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
