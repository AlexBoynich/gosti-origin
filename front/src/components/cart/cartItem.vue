<template>
    <div class="cart-item">
        <div class="img">
            <img src="/images/cart/cartItem/cart-item-img.png" alt="cart-item-img">
        </div>
        <div class="cart-item-content">
            <div class="product-header">
                <div class="title">Салат с лососем и соусом из огурца</div>
                <button class="delete-item">
                    <img src="/images/catalog/catalogItem/modal/close-modal.svg" alt="delete-item">
                </button>
            </div>
            <div class="product-desc-box">
                <div class="counter">
                </div>
                <div class="desc">

                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "cartItem"
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
.cart-item {
  display: flex;
  background: $lightGreenBackground;
  border-radius: 16px;

  .img {
    position: relative;
    overflow:hidden;
    width: 196px;
    height: 136px;
    border-radius: 16px;

    img {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
      object-fit: cover;
      width: 100%;
      height: 100%;
    }
  }
  .cart-item-content {
    padding: 16px 24px 16px 16px;
    position: relative;
    width: 400px;

    .product-header {

      .title {
        @include inter-400;
        font-size: 16px;
        line-height: 18px;
        max-width: 290px;
        height: 52px;
      }
      button {
        position: absolute;
        right: 24px;
        top: 16px;
        background: transparent;
        width: 16px;
        height: 16px;
        border: none;
        cursor: pointer;

        img {
          width: 16px;
          height: 16px;
        }
      }
    }
  }
}
</style>