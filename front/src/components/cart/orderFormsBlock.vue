<template>
    <div class="order-forms-block">
        <div class="title">Оформление заказа</div>
        <div
                v-for="item in personForms"
                :key="item.id"
                class="form-item"
        >
            <div class="section-title">{{ item.title }}</div>
            <div class="forms">
                <form
                        v-for="form in item.forms"
                        :key="form.id"
                >
                    <div
                            v-if="form.type === 'radio'"
                            class="radio-buttons"
                    >
                        <div
                                v-for="radio in form.radioButtons"
                                :key="radio.id"
                                class="radio-container"
                        >
                            <div class="radio">
                                <div v-show="radio.isActive" class="radio-dot"></div>
                            </div>
                            <label>{{ radio.label }}</label>
                        </div>
                    </div>
                    <div
                            v-else
                            :class="['form', form.class]"
                    >
                        <template v-if="form.label">
                            <label :for="form.id">{{ form.label }}</label>
                        </template>
                        <textarea
                                v-if="form.type === 'textarea'"
                                :class="['default-form', 'textarea', form.class]"
                                :placeholder="form.placeholder"
                        >

                            </textarea>
                        <input
                                v-else
                                :type="form.type"
                                :class="['default-form', form.class]"
                                :placeholder="form.placeholder"
                        >
                        <img
                                v-if="form.isError"
                                class="form-icon"
                                :src="form.img.src"
                                alt="form-icon"
                        >
                    </div>
                </form>
            </div>
        </div>
        <div v-show="pickup.isPickup" class="pickup">
            <div class="section-title">{{ pickup.title }}</div>
            <a href="#footer" class="link">{{ pickup.link }}</a>
        </div>
        <div v-show="deliveryForms.isDelivery" class="delivery">
            <div
                    v-for="item in deliveryForms.forms"
                    :key="item.id"
                    class="form-item"
            >
                <div class="section-title">{{ item.title }}</div>
                <div class="forms">
                    <form
                            v-for="(form, index) in item.forms"
                            :key="index"
                    >
                        <div
                                v-if="form.type === 'radio'"
                                class="radio-buttons"
                        >
                            <div
                                    v-for="(radio, index) in form.radioButtons"
                                    :key="index"
                                    class="radio-container"
                            >
                                <div class="radio">
                                    <div v-show="radio.isActive" class="radio-dot"></div>
                                </div>
                                <label>{{ radio.label }}</label>
                            </div>
                        </div>
                        <div
                                v-else
                                :class="['form', form.class]"
                        >
                            <template v-if="form.label">
                                <label :for="form.id">{{ form.label }}</label>
                            </template>
                            <textarea
                                    v-if="form.type === 'textarea'"
                                    :class="['default-form', 'textarea', form.class]"
                                    :placeholder="form.placeholder"
                            >
                            </textarea>
                            <input
                                    v-else
                                    :type="form.type"
                                    :class="['default-form', form.class]"
                                    :placeholder="form.placeholder"
                            >
                            <img
                                    v-if="form.img"
                                    class="form-icon"
                                    :src="form.img.src"
                                    alt="form-icon"
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div
                v-for="(item, index) in orderForms"
                :key="index"
                class="form-item"
        >
            <div class="section-title">{{ item.title }}</div>
            <div class="forms">
                <form
                        v-for="(form, index) in item.forms"
                        :key="index"
                >
                    <div
                            v-if="form.type === 'radio'"
                            class="radio-buttons"
                    >
                        <div
                                v-for="(radio, index) in form.radioButtons"
                                :key="index"
                                class="radio-container"
                        >
                            <div class="radio">
                                <div v-show="radio.isActive" class="radio-dot"></div>
                            </div>
                            <label>{{ radio.label }}</label>
                        </div>
                    </div>
                    <div
                            v-else
                            :class="['form', form.class]"
                    >
                        <template v-if="form.label">
                            <label :for="form.id">{{ form.label }}</label>
                        </template>
                        <textarea
                                v-if="form.type === 'textarea'"
                                :class="['default-form', 'textarea', form.class]"
                                :placeholder="form.placeholder"
                        >

                            </textarea>
                        <input
                                v-else
                                :type="form.type"
                                :class="['default-form', form.class]"
                                :placeholder="form.placeholder"
                        >
                        <img
                                v-if="form.img"
                                :class="['form-icon', form.img.class]"
                                :src="form.img.src"
                                alt="form-icon"
                        >
                    </div>
                </form>
            </div>
        </div>
        <div class="finally-forms">
            <div class="to-pay">
                <div class="section-title">{{ toPay.title }}</div>
                <div class="price">{{ price }}</div>
            </div>
            <div class="personal-data">
                <div
                        :id="personalData.id"
                        :class="['checkbox', {'active' : personalData.isActive}]"
                        @click="pickCheckbox"
                >
                    <img src="/images/catalog/filters/active-icon.svg" alt="active-icon">
                </div>
                <label :for="personalData.id">{{ personalData.label }}</label>
            </div>
        </div>
        <button>Оформить заказ</button>
    </div>
</template>

<script>
export default {
    name: "orderFormsBlock",
    data() {
        return {
            personForms: [
                {
                    title: 'Личные данные',
                    forms: [
                        {
                            label: 'Фамилия, Имя, Отчество*',
                            placeholder: 'Иванов Иван Иванович',
                            class: 'full',
                            type: 'text',
                            id: 'fullName',
                            img: {
                                name: 'error',
                                src: '/images/cart/form/error-icon.svg',
                                class: 'error'
                            },
                            isError: false
                        },
                        {
                            label: 'Телефон*',
                            placeholder: '+7 (ХХХ) ХХХ - ХХ - ХХ',
                            class: 'medium no-margin',
                            type: 'text',
                            id: 'phoneNumber',
                            img: {
                                name: 'error',
                                src: '/images/cart/form/error-icon.svg',
                                class: 'error'
                            },
                            isError: false
                        },
                        {
                            label: 'Почта',
                            placeholder: 'ivanovivan@yandex.ru',
                            class: 'medium',
                            type: 'text',
                            id: 'email',
                            img: {
                                name: 'error',
                                src: '/images/cart/form/error-icon.svg',
                                class: 'error'
                            },
                            isError: false
                        },
                        {
                            placeholder: 'Комментарий',
                            class: 'textarea',
                            type: 'textarea',
                            id: 'message'
                        },
                    ]
                },
                {
                    title: 'Способ получения',
                    forms: [
                        {
                            type: 'radio',
                            class: 'radio',
                            id: 'howToObtain',
                            radioButtons: [
                                {id: 'pickup', label: 'самовывоз', isActive: true},
                                {id: 'delivery', label: 'доставка', isActive: false},
                            ]
                        },
                    ]
                },
            ],
            deliveryForms: {
                title: 'Адрес заказа',
                forms: [
                    {
                        label: 'Улица*',
                        placeholder: 'г.Томск, ул.Секретная',
                        class: 'full',
                        type: 'text',
                        id: 'street',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        isError: false
                    },
                    {
                        label: 'Дом*',
                        placeholder: '16/4',
                        class: 'small',
                        type: 'text',
                        id: 'house',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        isError: false
                    },
                    {
                        label: 'Квартира/офис',
                        placeholder: '50',
                        class: 'small',
                        type: 'text',
                        id: 'apartment',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        isError: false
                    },
                    {
                        label: 'Подъезд',
                        placeholder: '2',
                        class: 'small no-margin',
                        type: 'text',
                        id: 'entrance',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        isError: false
                    },
                    {
                        label: 'Этаж',
                        placeholder: '2',
                        class: 'small',
                        type: 'text',
                        id: 'floor',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        isError: false
                    },
                    {
                        label: 'Домофон',
                        placeholder: '50',
                        class: 'small no-margin',
                        type: 'text',
                        id: 'intercomNumber',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        isError: false
                    }
                ],
                isDelivery: false
            },
            pickup: {
                title: 'Адрес самовывоза',
                link: 'г.Томск, ул.Фрунзе, д.90',
                isPickup: true
            },
            orderForms: [
                {
                    title: 'Дата и время',
                    forms: [
                        {
                            label: 'Дата',
                            placeholder: '24.07.2023',
                            class: 'small',
                            type: 'text',
                            id: 'date'
                        },
                        {
                            label: 'Время',
                            placeholder: '13:00-14:00',
                            class: 'small',
                            type: 'text',
                            id: 'time',
                            img: {
                                name: 'select',
                                src: '/images/cart/form/select-arrow.svg',
                                class: 'arrow'
                            },
                        }
                    ]
                },
                {
                    title: 'Способ оплаты',
                    forms: [
                        {
                            type: 'radio',
                            class: 'radio',
                            id: 'paymentMethod',
                            radioButtons: [
                                {id: 'payByCard', label: 'картой при получении', isActive: true},
                                {id: 'payByCash', label: 'наличными при получении', isActive: false},
                            ]
                        },
                    ]
                },
            ],
            toPay: {
                title: 'К оплате:',
            },
            personalData: {
                label: 'даю согласие на обработку персональных данных',
                id: 'personalData',
                isActive: false
            }
        }
    },
    computed: {
        price: function () {
            return 800 + ' ₽'
        }
    },
    methods: {
        pickCheckbox() {
            this.personalData.isActive = !this.personalData.isActive
        }
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.order-forms-block {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  max-width: 596px;
  width: 100%;
  gap: 32px 0;

  .title {
    @include inter-500;
  }
  .form-item {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;

    .section-title {
      @include inter-500;
      font-size: 20px;
      line-height: 22px;
      margin-bottom: 16px;
    }

    .forms {
      display: flex;
      flex-wrap: wrap;
      gap: 16px 0;

      form {
        display: flex;
        flex-wrap: wrap;

        .form {
          display: flex;
          flex-direction: column;
          position: relative;

          label {
            @include inter-400;
            margin-bottom: 8px;
            line-height: 20px;
          }

          .form-icon.arrow {
            position: absolute;
            right: 16px;
            bottom: 21px;
            cursor: pointer;
            width: 12px;
            height: 6px;
          }
          .form-icon.error {
            position: absolute;
            right: 16px;
            bottom: 12px;
            cursor: pointer;
            background-color: $lightRedBackground;
            -webkit-mask-image: url('@/../public/images/cart/form/error-icon.svg');
            mask-image: url('@/../public/images/cart/form/error-icon.svg');

            &:hover {
              background-color: $redBackground;
              -webkit-mask-image: url('@/../public/images/cart/form/error-icon.svg');
              mask-image: url('@/../public/images/cart/form/error-icon.svg');
            }
          }

          .default-form {
            border-radius: 16px;
            border: 1px solid #7B9561;
            outline: none;
            padding: 13px 24px;
            @include inter-300;
            font-size: 16px;
            line-height: 16px;

            &.full {
              width: 100%;
            }

            &.medium {
              width: 100%;

              &.no-margin {
                margin-right: 16px;
              }
            }

            &.small {
              width: 100%;
            }

            &.textarea {
              height: 96px;
              resize: none;
            }
          }

          &.full {
            width: 596px;
          }

          &.medium {
            width: 290px;

            &.no-margin {
              margin-right: 16px;
            }
          }

          &.small {
            width: 172px;
            margin-right: 39px;

            &.no-margin {
              margin-right: 0;
            }
          }

          &.textarea {
            width: 596px;
          }
        }

        .radio-buttons {
          display: flex;
          gap: 0 64px;

          .radio-container {
            display: flex;
            gap: 0 8px;

            .radio {
              width: 20px;
              height: 20px;
              border-radius: 50%;
              border: solid 1px $greenBackground;
              display: flex;
              align-items: center;
              justify-content: center;
              cursor: pointer;

              .radio-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: $greenBackground;
              }
            }

            label {
              @include inter-400;
              line-height: 20px;
              font-size: 20px;
            }
          }
        }
      }
    }
  }
  .pickup {
    display: flex;
    gap: 0 40px;

    .section-title {
      @include inter-500;
      font-size: 20px;
      line-height: 22px;
    }

    .link {
      @include inter-400;
      font-size: 16px;
      line-height: 18px;
      color: black;
      padding-bottom: 4px;
      border-bottom: 1px dashed #000;
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
        margin-right: 16px;

        img {
          width: 14px;
          height: 12px;
          display: none;
        }

        &.active {
          border: 1px solid $greenBackground;

          img {
            display: flex;
          }
        }

        &:hover {
          border: 1px solid $greenBackground;
        }
      }

      label {
        @include inter-400;
        font-size: 16px;
        line-height: 18px;
      }
    }
  }
  button {
    @include green-button;
    text-align: center;
    width: 100%;
    margin-bottom: 120px;

    &:hover {
      @include green-button-hover;
    }
  }
}
</style>