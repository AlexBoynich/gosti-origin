<template>
    <div class="order-forms-block">
        <div class="title">Оформление заказа</div>
        <PersonForms
            @notNull="personNotNull"
        />
        <div class="radio-buttons">
            <div class="section-title">{{ wayToGet.title }}</div>
            <div class="radio-container">
                <div
                    v-for="radio in wayToGet.radioButtons"
                    :key="radio.id"
                    class="radio-box"
                    @click="activeWayToGetButton(radio.id)"
                >
                    <div class="radio">
                        <div v-show="radio.isActive" class="radio-dot"></div>
                    </div>
                    <label>{{ radio.label }}</label>
                </div>
            </div>
        </div>
        <pickupBlock
            v-if="wayToGet.pickup.isPickup"
            :pickup="wayToGet.pickup"
        />
        <deliveryForms
            v-else
            @formValidate="deliveryNotNull"
        />
        <DateAndTimeForms
            @notNull="dateAndTimeNotNull"
        />
        <div class="radio-buttons">
            <div class="section-title">{{ payMethod.title }}</div>
            <div class="radio-container">
                <div
                    v-for="radio in payMethod.radioButtons"
                    :key="radio.id"
                    class="radio-box"
                    @click="activePayMethod(radio.id)"
                >
                    <div class="radio">
                        <div v-show="radio.isActive" class="radio-dot"></div>
                    </div>
                    <label>{{ radio.label }}</label>
                </div>
            </div>
        </div>
        <div v-if="wayToGet.delivery.isDelivery" class="delivery-price">
            <div class="sum-delivery">
                <div class="section-title">{{ wayToGet.delivery.deliveryPriceBlock.title }}</div>
                <div class="price">{{ deliveryPrice + ' ₽' }}</div>
            </div>
            <div class="message">
                {{ wayToGet.delivery.deliveryPriceBlock.message }}
            </div>
        </div>
        <div class="finally-forms">
            <div class="to-pay">
                <div class="section-title">{{ toPay.title }}</div>
                <div class="price">{{ price + ' ₽' }}</div>
            </div>
            <div class="personal-data">
                <div
                    :id="personalData.id"
                    :class="['checkbox', {'active' : personalData.isActive, 'error' : personalData.error}]"
                    @click="toggleCheckbox"
                >
                    <img
                        src="/images/catalog/filters/active-icon.svg"
                        alt="active-icon"
                    >
                </div>
                <label :for="personalData.id">
                    <a
                        href="/documents/consent-to-the-processing-of-personal-data.pdf"
                        target="_blank"
                    >
                        даю <span>{{personalData.link}}</span>
                    </a>
                </label>
            </div>
        </div>
        <button @click="checkForms">Оформить заказ</button>
    </div>
</template>

<script>
import deliveryForms from "./forms/deliveryForms";
import PersonForms from "./forms/personForms";
import pickupBlock from "./forms/pickupBlock";
import DateAndTimeForms from "./forms/dateAndTimeForms";
import {mapMutations, mapState} from "vuex";
import {onTop} from "@/utils/helpers";


export default {
    name: "orderFormsBlock",
    data() {
        return {
            wayToGet: {
                title: 'Способ получения',
                id: 'wayToGet',
                radioButtons: [
                    {id: 'pickup', label: 'самовывоз', isActive: false},
                    {id: 'delivery', label: 'доставка', isActive: true},
                ],
                delivery: {
                    deliveryPriceBlock: {
                        title: 'Сумма доставки',
                        message: '*бесплатная доставка от 1500 рублей'
                    },
                    isDelivery: true,
                },
                pickup: {
                    title: 'Адрес самовывоза',
                    link: 'г.Томск, ул.Фрунзе, д.90',
                    isPickup: false
                },
            },
            payMethod: {
                title: 'Способ оплаты',
                id: 'paymentMethod',
                radioButtons: [
                    {id: 'payByCard', label: 'картой при получении', isActive: true},
                    {id: 'payByCash', label: 'наличными при получении', isActive: false},
                ]
            },
            toPay: {
                title: 'К оплате:',
            },
            personalData: {
                link: 'согласие на обработку персональных данных',
                id: 'personalData',
                isActive: null,
                error: null
            },
            order: {
                personal: {
                    fullName: '',
                    phoneNumber: '',
                    email: '',
                    message: '',
                    personalFormIsEmpty: true,
                },
                wayToGet: {
                    content: 'Доставка',
                    delivery: {
                        formIsEmpty: true,
                        street: '',
                        house: '',
                        apartment: '',
                        entrance: '',
                        floor: '',
                        intercomNumber: '',
                    }
                },
                dateAndTime: {
                    formIsEmpty: false,
                    date: '',
                    timeSlot: ''
                },
                payMethod: 'картой при получении',
            }
        }
    },
    computed: {
        ...mapState('cart', ['cart']),
        price: function () {
            let totalPrice = this.cart.reduce((acc, item) => acc + item.price * item.count, 0)
            if (this.wayToGet.delivery.isDelivery) {
                if (totalPrice < 1500) {
                    return totalPrice + 200
                } else {
                    return totalPrice
                }
            } else {
                return totalPrice
            }

        },
        deliveryPrice: function () {
            let totalPrice = this.cart.reduce((acc, item) => acc + item.price * item.count, 0)
            if (totalPrice >= 1500) {
                return 0
            } else {
                return 200
            }
        },
        formIsEmpty: function () {
            return this.order.personal.personalFormIsEmpty || this.wayToGetError || this.order.dateAndTime.formIsEmpty;
        },
        wayToGetError: function () {
            if (this.order.wayToGet.content === 'доставка') {
                return this.order.wayToGet.delivery.formIsEmpty
            } else {
                return false
            }
        },
        dataForModal: function () {
            let data = [
                {title: 'Адрес', content: ''},
                {title: 'ФИО', content: this.order.personal.fullName},
                {title: 'Телефон', content: this.order.personal.phoneNumber},
                {title: 'Дата и время', content: this.order.dateAndTime.date + ' c ' + this.order.dateAndTime.timeSlot},
                {title: 'Способ оплаты', content: this.order.payMethod},
                {title: 'К оплате:', content: ''}
            ]
            if (this.order.wayToGet.content === 'Доставка') {
                data[0].content = this.order.wayToGet.delivery.street + ', д.' + this.order.wayToGet.delivery.house +
                    (this.order.wayToGet.delivery.apartment ? ', кв. ' + this.order.wayToGet.delivery.apartment : "") +
                    (this.order.wayToGet.delivery.entrance ? ', п. ' + this.order.wayToGet.delivery.entrance : "") +
                    (this.order.wayToGet.delivery.floor ? ', эт. ' + this.order.wayToGet.delivery.floor : "") +
                    (this.order.wayToGet.delivery.intercomNumber ? ', д. ' + this.order.wayToGet.delivery.intercomNumber : "")
            } else {
                data[0].content = 'г.Томск, пр.Фрунзе, д.90'
            }
            data[data.length - 1].content = this.price + ' ₽'

            return data
        },
        dataForRequest: function () {
            let objForRequest = {}
            objForRequest.name = this.order.personal.fullName
            objForRequest.phone = this.order.personal.phoneNumber
            objForRequest.email = this.order.personal.email
            objForRequest.comment = this.order.personal.message
            objForRequest.obtainingMethod = this.order.wayToGet.content
            if (objForRequest.obtainingMethod === 'Доставка') {
                objForRequest.street = this.order.wayToGet.delivery.street
                objForRequest.house = this.order.wayToGet.delivery.house
                objForRequest.flat = this.order.wayToGet.delivery.apartment
                objForRequest.entrance = this.order.wayToGet.delivery.entrance
                objForRequest.floor = this.order.wayToGet.delivery.floor
                objForRequest.intercom = this.order.wayToGet.delivery.intercomNumber
            } else {
                objForRequest.street = 'г.Томск, пр.Фрунзе'
                objForRequest.house = '90'
            }
            objForRequest.receiptDate = this.order.dateAndTime.date
            objForRequest.receiptTime = this.order.dateAndTime.timeSlot

            if (this.order.payMethod === 'картой при получении') {
                objForRequest.paymentMethod = 'Картой'
            } else {
                objForRequest.paymentMethod = 'Наличный'
            }

            objForRequest.deliveryPrice = this.deliveryPrice
            objForRequest.cost = this.price - this.deliveryPrice
            objForRequest.dishes = this.cart.map(item => ({id: item.id, count: item.count}))

            return objForRequest
        }
    },
    methods: {
        onTop,
        ...mapMutations('cart', ['DELETE_CART']),
        activeWayToGetButton(id) {
            if (id === 'pickup') {
                this.wayToGet.radioButtons[0].isActive = true
                this.wayToGet.radioButtons[1].isActive = false

                this.wayToGet.pickup.isPickup = true
                this.wayToGet.delivery.isDelivery = false

                this.order.wayToGet.content = 'Самовывоз'

                this.$emit('activeWayToGetButton', false)
            } else {
                this.wayToGet.radioButtons[0].isActive = false
                this.wayToGet.radioButtons[1].isActive = true

                this.wayToGet.pickup.isPickup = false
                this.wayToGet.delivery.isDelivery = true

                this.order.wayToGet.content = 'Доставка'

                this.$emit('activeWayToGetButton', true)
            }
        },
        activePayMethod(id) {
            if (id === 'payByCard') {
                this.payMethod.radioButtons[0].isActive = true
                this.payMethod.radioButtons[1].isActive = false

                this.order.payMethod = 'картой при получении'
            } else {
                this.payMethod.radioButtons[0].isActive = false
                this.payMethod.radioButtons[1].isActive = true

                this.order.payMethod = 'наличными при получении'
            }
        },
        toggleCheckbox() {
            this.personalData.isActive = !this.personalData.isActive
        },
        checkForms: function () {
            this.$emit('checkForms')
            this.personalData.error = !this.personalData.isActive;

            if (!this.order.personal.personalFormIsEmpty && !this.personalData.error) {
                if (this.order.wayToGet.content === 'Доставка') {
                    if (!this.order.wayToGet.delivery.formIsEmpty) {
                        this.dataForModal[this.dataForModal.length - 1].content = this.price + ' ₽'
                        this.readyModalIsActive = true
                        this.$emit('resultAction', {
                            readyModal: true,
                            errorModal: false,
                            data: this.dataForModal,
                            forRequest: this.dataForRequest
                        })
                        this.DELETE_CART()
                        this.onTop('smooth')
                    } else {
                        this.$emit('resultAction', {
                            readyModal: false,
                            errorModal: true
                        })
                    }
                } else {
                    this.dataForModal[this.dataForModal.length - 1].content = this.price + ' ₽'
                    this.readyModalIsActive = true
                    this.$emit('resultAction', {
                        readyModal: true,
                        errorModal: false,
                        data: this.dataForModal,
                        forRequest: this.dataForRequest
                    })
                    this.DELETE_CART()
                    this.onTop('smooth')
                }

            } else {
                this.$emit('resultAction', {
                    readyModal: false,
                    errorModal: true
                })
            }
        },
        personNotNull(obj) {
            this.order.personal.personalFormIsEmpty = obj.act;
            this.order.personal.fullName = obj.nameContent
            this.order.personal.phoneNumber = obj.telContent
            this.order.personal.email = obj.emailContent
            this.order.personal.message = obj.messageContent

            if (this.order.personal.fullName === "" || this.order.personal.phoneNumber === "") {
                this.order.personal.personalFormIsEmpty = true
            }
        },
        deliveryNotNull(obj) {
            this.order.wayToGet.delivery.formIsEmpty = obj.act;
            this.order.wayToGet.delivery.street = obj.street
            this.order.wayToGet.delivery.house = obj.house
            this.order.wayToGet.delivery.apartment = obj.apartment
            this.order.wayToGet.delivery.entrance = obj.entrance
            this.order.wayToGet.delivery.floor = obj.floor
            this.order.wayToGet.delivery.intercomNumber = obj.intercomNumber

            if (obj.street === "" || obj.house === "") {
                this.order.wayToGet.delivery.formIsEmpty = true;
            }
        },
        dateAndTimeNotNull(obj) {
            this.order.dateAndTime.formIsEmpty = obj.act
            this.order.dateAndTime.date = obj.date
            this.order.dateAndTime.timeSlot = obj.time
        },
    },
    components: {
        DateAndTimeForms,
        pickupBlock,
        PersonForms,
        deliveryForms
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.order-forms-block {
    display: flex;
    flex-direction: column;
    max-width: 596px;
    width: 100%;
    gap: 32px 0;

    .title {
        @include inter-500;
    }

    .radio-buttons {
        display: flex;
        flex-direction: column;
        gap: 0 64px;

        .section-title {
            @include inter-500;
            font-size: 20px;
            line-height: 22px;
            margin-bottom: 16px;
        }

        .radio-container {
            display: flex;
            gap: 0 64px;

            .radio-box {
                display: flex;
                gap: 0 8px;

                .radio {
                    width: 20px;
                    height: 20px;
                    border-radius: 50%;
                    border: solid 1px $olive;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;

                    .radio-dot {
                        width: 8px;
                        height: 8px;
                        border-radius: 50%;
                        background: $olive;
                    }
                }

                label {
                    @include inter-400;
                    line-height: 20px;
                }
            }
        }
    }

    .delivery-price {
        display: flex;
        flex-direction: column;
        gap: 8px 0;

        .sum-delivery {
            display: flex;
            gap: 0 40px;

            .section-title {
                @include inter-500;
                font-size: 20px;
                line-height: 22px;
            }

            .price {
                @include inter-400;
                font-size: 20px;
                line-height: 22px;
            }
        }

        .message {
            font-size: 16px;
            line-height: 18px;
            @include inter-400;
        }
    }

    .finally-forms {
        .to-pay {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;

            .section-title {
                @include inter-500;
                font-size: 20px;
                line-height: 22px;
            }

            .price {
                @extend .section-title
            }
        }

        .personal-data {
            display: flex;
            align-items: center;
            gap: 0 16px;

            .checkbox {
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                width: 20px;
                height: 20px;
                border: 1px solid rgba(123, 149, 97, 0.5);
                border-radius: 3px;

                img {
                    width: 14px;
                    height: 12px;
                    display: none;
                }

                &.error {
                    border: 1px solid $madderLake;
                }

                &.active {
                    border: 1px solid $olive;

                    img {
                        display: flex;
                    }
                }

                &:hover {
                    border: 1px solid $olive;
                }

            }

            label {
                a {
                    @include inter-400;
                    font-size: 16px;
                    line-height: 18px;
                    color: black;
                    text-decoration: none;

                    span {
                        border-bottom: 1px solid transparent;
                    }

                    &:hover {
                        span {
                            border-bottom: 1px solid black;
                        }
                    }
                }

            }
        }
    }

    button {
        @include green-button;
        text-align: center;
        width: 100%;

        &:hover {
            @include green-button-hover;
        }
    }
}
</style>
