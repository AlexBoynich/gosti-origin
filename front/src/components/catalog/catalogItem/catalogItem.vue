<template>
    <div class="catalog-item">
        <div class="item-clickable" @click="openModal">
            <div class="product-img">
                <img :src="catalogItem.img" alt="product-img">
            </div>
            <div class="catalog-item-content">
                <div class="title">{{ catalogItem.title }}</div>
                <div class="price-and-weight">
                    <div class="price">{{ catalogItem.price + ' ₽' }}</div>
                    <div class="weight">{{ catalogItem.weight }}</div>
                </div>
            </div>
        </div>
        <CatalogButton
            :catalogItem="catalogItem"
            @inCart="inCart"
            :amount="counter"
            @transformAmount="transformAmount"
        />
        <catalogItemModal
            v-show="modalIsActive"
            :catalogItem="catalogItem"
            :amount="counter"
            @closeModal="closeModal"
            @inCart="inCart"
            @transformAmount="transformAmount"
        />
    </div>
</template>

<script>
import CatalogButton from "@/components/catalog/catalogButton";
import catalogItemModal from "./catalogItemModal";

export default {
    name: "catalogItem",
    data () {
        return {
            modalIsActive: false,
            counter: this.catalogItem.count
        }
    },
    methods: {
        inCart () {
            this.counter = 1
            this.$emit('inCart', {
                item: this.catalogItem,
                count: this.counter
            })
        },
        transformAmount (item) {
            this.counter = item.count
            this.$emit('transformAmount', {
                item: this.catalogItem,
                count: this.counter
            })
        },
        closeScroll () {
            let body = document.querySelector('body')

            if (this.modalIsActive) {
                body.style.overflow = 'hidden'
            } else {
                body.style.overflow = ''
            }
        },
        openModal() {
            this.modalIsActive = true
        },
        closeModal(act) {
            this.modalIsActive = act
        }
    },
    components: {
        CatalogButton,
        catalogItemModal
    },
    props: ['catalogItem'],
    updated() {
        this.counter = this.catalogItem.count
        this.closeScroll()
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.catalog-item {
  display: flex;
  flex-direction: column;
  max-width: 439px;

  .item-clickable {
    .product-img {
      position: relative;
      overflow: hidden;
      width: 439px;
      height: 359px;
      border-radius: 16px;
      margin-bottom: 24px;
      cursor: pointer;

      img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        object-fit: cover;
        width: 100%;
        height: 100%;
      }
    }

    .catalog-item-content {
      display: flex;
      flex-direction: column;

      .title {
        max-height: 56px;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #000;
        @include inter-400;
        font-size: 20px;
        line-height: 140%;
        letter-spacing: -0.4px;
        margin-bottom: 24px;
      }

      .price-and-weight {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 16px;

        .price {
          color: #000;
          @include inter-500;
          font-size: 24px;
          line-height: 110%;
          letter-spacing: -0.48px;
        }

        .weight {
          color: #000;
          @include inter-400;
          font-size: 20px;
          line-height: 110%;
          letter-spacing: -0.4px;
        }
      }
    }
  }

}
</style>
