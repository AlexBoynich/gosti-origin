<template>
    <div class="delivery-block container">
        <img src="/images/homePage/deliveryBlock/delivery-image.png" alt="delivery-image" class="left-part">
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
            <div class="delivery-table-mobile">
                <div class="table-item-mobile"
                     v-for="(item, index) in delivery.tableItemsMobile"
                     :key="index"
                >
                    {{ item }}
                </div>
            </div>
            <router-link to="/catalog">
                <button class="delivery-button" @click="onTop('auto')">
                    Перейти в каталог
                </button>
            </router-link>
        </div>
    </div>
</template>

<script>
import {onTop} from '@/utils/helpers.js'

export default {
    name: "deliveryBlock",
    data() {
        return {
            delivery: {
                title: 'Доставка',
                desc: 'Выбирайте любимые блюда в каталоге и заказывайте их через нашу доставку по всему городу.',
                tableColumns: [
                    {tableItems: ['Заказ', 'Доставка']},
                    {tableItems: ['До 1500 ₽', 'от 300 р']},
                    {tableItems: ['От 1500 ₽', 'Бесплатно']},
                ],
                tableItemsMobile: [
                'Заказ',
                'Доставка',
                'До 1500 ₽',
                'от 300 р',
                'От 1500 ₽',
                'Бесплатно'
                ]
            }
        }
    },
    methods: {
        onTop
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.container{
    margin-top: 100px !important;
}

.delivery-block {
    padding: 174px 0 92px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    @include mobile {
        flex-direction: column;
    }

    .left-part {
        width: 596px;
        height: 656px;
        border-radius: 16px;
        @include mobile {
            width: 100%;
            aspect-ratio: 328/360;
            height: auto;
        }
    }

    .right-part {
        max-width: 596px;
        @include mobile {
            width: 100%
        }

        .title {
            @include h3;
            padding-bottom: 8px;
            border-bottom: solid 1px rgba(123, 149, 97, 0.35);
            display: inline-block;
            margin-bottom: 32px;
            line-height: 53px;
            padding-right: 25px;
            @include mobile {
                font-size: 30px;
                font-weight: 500;
                line-height: 22px;
                text-align: left;
                padding-top: 28px;

            }
        }

        .desc {
            @include inter-400;
            margin-bottom: 16px;
            max-width: 468px;
            @include mobile {
                font-size: 18px;
                font-weight: 400;
                line-height: 24.3px;
                text-align: left;

            }
        }

        .delivery-table-mobile {
            display: none;
            
            @include mobile {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-template-rows: 1fr 1fr 1fr;
                gap: 34px 54px;
                margin: 40px 0;
            }
            
            &:nth-child(2) {
                color: #0000008C;
            }

            .table-item-mobile {
                font-family: 'Inter', sans-serif;
                font-size: 24px;
                font-weight: 400;
                line-height: 22px;
                text-align: left;

            }
        }
    
        .delivery-table {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            gap: 0 49px;
            @include mobile {
                display: none;
            }

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
