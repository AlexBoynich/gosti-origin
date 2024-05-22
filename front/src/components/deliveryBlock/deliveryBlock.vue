<template>
    <div class="delivery-block container">
        <img src="/images/homePage/deliveryBlock/delivery-image.png" alt="delivery-image" class="left-part">
        <div class="right-part">
            <h2 class="title"> {{ delivery.title }}</h2>
            <div class="desc">{{ delivery.desc }}</div>
            <div class="delivery-table-2">
                <div class="row-1">
                    <div>Заказ</div>
                    <div>Доставка</div>
                </div>
                <hr>
                <div class="row-2">
                    <div>до 1500</div>
                    <div>От 300</div>
                </div>
                <div class="row-3">
                    <div>от 1500</div>
                    <div>Бесплатно</div>
                </div>
            </div>
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
        
            <router-link to="/catalog">
                <button class="delivery-button" @click="onTop('auto')">
                    Перейти в меню
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
                desc: 'Выбирайте любимые блюда в каталоге и заказывайте их через нашу доставку по всему городу. Привезём свежую еду за 2 часа!',
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


.delivery-block {
    padding: 174px 0 92px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    @include mobile {
        flex-direction: column;
        padding: 70px 16px 90px;
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
                font-size: 15px;
                font-weight: 400;
                line-height: 20.25px;
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
        .delivery-table-2 {
            display: flex;
            flex-direction: column;
            margin-bottom: 40px;
            hr{
                margin-bottom: 10px;
                background: rgba(123, 149, 97, 0.35);
                height: 1px;
                border: none;
}
            }
            .row-1,.row-2,.row-3 {
                display: flex;
                justify-content: space-between;
                font-family: 'Inter', sans-serif;
                font-size: 20px;
                font-weight: 400;
                line-height: 22px;
                text-align: left;
                margin: 10px 0;
                padding-right: 60px;
                div{
                    min-width: 105px;
                }

            }
            .row-1 {
                color: #0000008C;
            }
            @media (min-width: 800px) {
                display: none;
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
