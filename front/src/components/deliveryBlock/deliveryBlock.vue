<template>
    <div class="delivery-block container">
        <img src="/images/deliveryBlock/delivery-image.png" alt="delivery-image" class="left-part">
        <div class="right-part">
            <h2 class="title"> {{ delivery.title }}</h2>
            <div class="desc">{{ delivery.desc }}</div>
            <div class="delivery-table">
                <div class="table-column"
                     v-for="(column, index) in delivery.tableColumns"
                     :key="index"
                >
                    <div class="table-item"
                         v-for="(item, i) in column.tableItems"
                         :key="i"
                    >
                        {{ item }}
                    </div>
                </div>
            </div>
            <router-link to="/">
                <button class="delivery-button">
                    Перейти в каталог
                </button>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "deliveryBlock",
    data () {
        return {
            delivery: {
                title: 'Доставка',
                desc: 'Выбирайте любимые блюда в каталоге и заказывайте их через нашу доставку по всему городу. Привезём свежую еду за 2 часа!',
                tableColumns: [
                    {tableItems: ['Заказ', 'Доставка']},
                    {tableItems: ['До 1000 ₽', '150 ₽']},
                    {tableItems: ['От 1000 ₽', 'Бесплатно']},
                ]
            }
        }
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.delivery-block {
  padding: 92px 0;
  display: flex;
  align-items: center;
  justify-content: space-between;

  .left-part {
    width: 596px;
    height: 656px;
    border-radius: 16px;
  }
  .right-part {
    max-width: 596px;

    .title {
      @include h2;
      padding-bottom: 8px;
      border-bottom: solid 1px rgba(123, 149, 97, 0.35);
      display: inline-block;
      margin-bottom: 32px;
      line-height: 53px;
      padding-right: 25px;
    }
    .desc {
      @include inter-400;
      margin-bottom: 16px;
      max-width: 468px;
    }
    .delivery-table {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 32px;
      gap: 0 49px;

      .table-column {
        display: flex;
        flex-direction: column;
        gap: 52px 0;
        @include inter-500;


        &:first-child {
          @include inter-400;
          font-size: 24px;
          line-height: 26px;
          color: rgba(0, 0, 0, 0.55);
        }
        &:nth-child(2) {
          padding: 28px 49px;
          border-right: solid 1px rgba(123, 149, 97, 0.36);
          border-left: solid 1px rgba(123, 149, 97, 0.36);

        }
      }
    }
    .delivery-button {
      @include green-button;

      &:hover, &:active {
        @include green-button-hover;
      }
    }
  }
}
</style>
