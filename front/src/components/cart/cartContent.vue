<template>
    <div class="cart-content">
        <div class="cart-content-header">
            <div class="title-and-del">
                <div class="your-cart">Ваш заказ</div>
                <button class="delete-cart">
                    Очистить корзину
                </button>
            </div>
            <div class="product-counter">
                {{ cartCounter }}
            </div>
        </div>
        <div class="cart-content-body">
            <CartItem
                v-for="(item, index) in cart"
                :key="index"
                :cartItem="item"
            />
        </div>
    </div>
</template>

<script>
import CartItem from "@/components/cart/cartItem.vue";
export default {
    name: "cartContent",
    components: {
        CartItem
    },
    computed: {
        cartCounter: function () {
            let word
            if (this.cart.length > 4 && this.cart.length  < 21) {
                word = this.cart.length + ' товаров'
            } else if (this.cart.length % 10 === 1) {
                word = this.cart.length + ' товар'
            } else if (this.cart.length % 10 > 1 && this.cart.length % 10 < 5) {
                word = this.cart.length + ' товара'
            }
            return word
        },
    },
    props: ['cart']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
.cart-content {
  max-width: 596px;
  width: 100%;
  min-height: 100vh;

  .cart-content-header {
    display: flex;
    flex-direction: column;
    margin-bottom: 16px;

    .title-and-del {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;

      .your-cart {
        @include inter-500;
      }
      .delete-cart {
        background: transparent;
        border: none;
        @include inter-400;
        cursor: pointer;
        line-height: 20px;
      }
    }
    .product-counter {
      @include inter-300;
      font-size: 16px;
      line-height: 22px;
      color: rgba(0, 0, 0, 0.7);
    }
  }
  .cart-content-body {
      display: flex;
      flex-direction: column;
      gap: 24px 0;
  }
}
</style>
