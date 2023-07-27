<template>
    <div class="modal-mask" @click="closeOnClickOutside">
        <div class="modal-container">
            <button class="close-modal" @click="closeModal">
                <img src="/images/catalog/catalogItem/modal/close-modal.svg" alt="close-modal">
            </button>
            <div class="modal-content">
                <div class="modal-image">
                    <img :src="catalogItem.img" alt="product-image">
                    <filterIconsBox
                        v-if="!this.catalogItem.sugar || !this.catalogItem.lactose || !this.catalogItem.gluten"
                        :catalogItem="catalogItem"
                        class="filter-items-box"
                    />
                </div>
                <div class="title">{{ catalogItem.title }}</div>
                <div class="desc" v-html="catalogItem.desc"></div>
                <div class="info-box">
                    <div class="info-about-product-weight">
                        <div v-if="catalogItem.calories && catalogItem.proteins && catalogItem.fats && catalogItem.carbohydrates"
                             class="in-hundred-gram"
                        >
                            в 100 граммах
                        </div>
                        <div class="info-table">
                            <div v-if="catalogItem.calories" class="table-column">
                                <div class="count">{{ catalogItem.calories }}</div>
                                <div class="desc">Ккал</div>
                            </div>
                            <div v-if="catalogItem.proteins" class="table-column">
                                <div class="count">{{ catalogItem.proteins }}</div>
                                <div class="desc">Белки</div>
                            </div>
                            <div v-if="catalogItem.fats" class="table-column">
                                <div class="count">{{ catalogItem.fats }}</div>
                                <div class="desc">Жиры</div>
                            </div>
                            <div v-if="catalogItem.carbohydrates" class="table-column">
                                <div class="count">{{ catalogItem.carbohydrates }}</div>
                                <div class="desc">Углеводы</div>
                            </div>
                        </div>
                    </div>
                    <div class="weight-and-price">
                        <div class="weight">{{ catalogItem.weight }}</div>
                        <div class="price">{{ catalogItem.price + ' ₽' }}</div>
                    </div>
                </div>
                <catalogButton
                    :catalogItem="catalogItem"
                    :amount="amount"
                    @inCart="inCart"
                    @transformAmount="transformAmount"
                />
            </div>
        </div>
    </div>
</template>

<script>
import catalogButton from "../catalogButton";
import filterIconsBox from "./filterIconsBox";

export default {
    name: "catalogItemModal",
    data() {
        return {
            active: true
        }
    },
    methods: {
        closeModal() {
            this.$emit('closeModal', !this.active)
        },
        inCart() {
            this.$emit('inCart', {
                id: this.catalogItem.id,
                count: 1
            })
        },
        transformAmount(item) {
            this.$emit('transformAmount', {
                id: this.catalogItem.id,
                count: item.count
            })
        },
        closeOnClickOutside(e) {
            if (e.target.classList.contains('modal-mask')) {
                this.closeModal()
            }
        }
    },
    components: {
        catalogButton,
        filterIconsBox
    },
    props: ['catalogItem', 'amount']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.modal-mask {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.25);

    .modal-container {
        width: 704px;
        height: 803px;
        border-radius: 16px;
        background: white;
        padding: 72px 61px 31px;
        position: relative;

        .close-modal {
            cursor: pointer;
            background: transparent;
            border: none;
            position: absolute;
            right: 32px;
            top: 32px;
            width: 17px;
            height: 16px;

            img {
                width: 100%;
                height: 100%;
            }
        }

        .modal-content {

            .modal-image {
                position: relative;
                overflow: hidden;
                width: 582px;
                height: 372px;
                border-radius: 16px;
                margin-bottom: 16px;

                img {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                }

                .filter-items-box {
                    position: absolute;
                    bottom: 16px;
                    right: 16px;
                }
            }

            .title {
                color: black;
                @include inter-500;
                font-size: 20px;
                line-height: 22px;
                letter-spacing: -0.02em;
                text-align: left;
                margin-bottom: 8px;
                height: 53px;
                max-height: 53px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .desc {
                @include inter-400;
                line-height: 20px;
                letter-spacing: -0.02em;
                text-align: left;
                height: 74px;
                max-height: 74px;
                overflow: hidden;
                text-overflow: ellipsis;
                margin-bottom: 4px;
            }

            .info-box {
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                margin-bottom: 24px;

                .info-about-product-weight {

                    .in-hundred-gram {
                        @include inter-400;
                        font-size: 16px;
                        line-height: 23px;
                        letter-spacing: -0.02em;
                        text-align: left;
                        color: rgba(0, 0, 0, 0.5);
                        margin-bottom: 4px;
                    }

                    .info-table {
                        display: flex;
                        align-items: center;
                        gap: 0 12px;
                        max-width: 322px;

                        .table-column {
                            padding-right: 12px;
                            border-right: solid 1px #7B956180;
                            display: flex;
                            flex-direction: column;
                            gap: 16px 0;
                            max-height: 64px;

                            &:last-child {
                                border: none;
                                padding-right: 0;
                            }

                            .count {
                                @include inter-400;
                                font-size: 20px;
                                line-height: 22px;
                                letter-spacing: -0.02em;
                                text-align: left;
                                color: black;
                            }

                            .desc {
                                @include inter-400;
                                line-height: 20px;
                                letter-spacing: -0.02em;
                                text-align: left;
                                color: rgba(0, 0, 0, 0.5);
                            }
                        }
                    }
                }

                .weight-and-price {

                    .weight {
                        @include inter-400;
                        line-height: 20px;
                        letter-spacing: -0.02em;
                        text-align: right;
                        color: rgba(0, 0, 0, 0.5);
                        margin-bottom: 8px;
                    }

                    .price {
                        @include inter-500;
                        font-size: 24px;
                        line-height: 26px;
                        letter-spacing: -0.02em;
                        text-align: left;
                    }
                }
            }

        }
    }
}
</style>
