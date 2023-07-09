<template>
    <div id="cart" class="container">
        <h2 class="title">Корзина</h2>
        <div class="content">
            <cartContent />
            <orderFormsBlock />
        </div>
    </div>
</template>

<script>
import orderFormsBlock from "@/components/cart/orderFormsBlock.vue";
import cartContent from "@/components/cart/cartContent.vue";

export default {
    name: "cartView",
    components: {cartContent, orderFormsBlock}
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
#cart {
  margin-top: 174px;

  h2 {
    @include h2;
    margin-bottom: 24px;
  }
  .content {
    display: flex;
    justify-content: space-between;
  }
}
</style>