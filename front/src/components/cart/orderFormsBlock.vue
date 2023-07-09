<template>
    <div class="order-forms-block">
        <div class="title">Оформление заказа</div>
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
                                class="form-icon"
                                :src="form.img.src"
                                alt="form-icon"
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "orderFormsBlock",
    data() {
        return {
            orderForms: [
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
                                src: '/images/cart/form/error-icon.svg'
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
                                src: '/images/cart/form/error-icon.svg'
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
                                src: '/images/cart/form/error-icon.svg'
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
                                {id: 1, label: 'самовывоз', isActive: false},
                                {id: 2, label: 'доставка', isActive: true},
                            ]
                        },
                    ]
                },
                {
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
                                src: '/images/cart/form/error-icon.svg'
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
                                src: '/images/cart/form/error-icon.svg'
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
                                src: '/images/cart/form/error-icon.svg'
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
                                src: '/images/cart/form/error-icon.svg'
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
                                src: '/images/cart/form/error-icon.svg'
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
                                src: '/images/cart/form/error-icon.svg'
                            },
                            isError: false
                        }
                    ]
                },
                {
                    title: 'Дата и время',
                    forms: [
                        {
                            label: 'Дата',
                            placeholder: '24.07.2023',
                            class: 'small',
                            type: 'text',
                            id: 'date',
                            img: {
                                name: 'error',
                                src: '/images/cart/form/error-icon.svg'
                            },
                            isError: false
                        },
                        {
                            label: 'Время',
                            placeholder: '13:00-14:00',
                            class: 'small',
                            type: 'text',
                            id: 'time',
                            img: {
                                name: 'select',
                                src: '/images/cart/form/error-icon.svg'
                            },
                        }
                    ]
                },
            ]
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

  .section-title {
    @include inter-500;
    font-size: 20px;
    line-height: 22px;
    margin-bottom: 16px;
  }

  .form-item {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;

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

          .form-icon {
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

}
</style>