<template>
    <div class="delivery-forms">
        <div class="form-item">
            <div class="section-title">{{ delivery.title }}</div>
            <div class="forms">
                <form
                    v-for="form in delivery.forms"
                    :key="form.id"
                >
                    <div :class="['form', form.class]">
                        <label :for="form.id">{{ form.label }}</label>
                        <input
                            :type="form.type"
                            :class="['default-form', form.class, {'error' : form.isError}]"
                            :placeholder="form.placeholder"
                            :maxlength="form.maxLength"
                            :required="form.required"
                            v-model="form.formContent"
                            @change="formValidate(
                                form.id,
                                form.pattern,
                                form.formContent
                            )"
                        >
                        <img
                            v-if="form.isError"
                            :class="['form-icon', form.img.class]"
                            :src="form.img.src"
                            alt="form-icon"
                            @mouseover="form.viewError = true"
                            @mouseleave="form.viewError = false"
                        >
                        <div v-show="form.viewError" class="message">
                            <div class="txt">
                                {{ form.errorText }}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "deliveryForms",
    data() {
        return {
            delivery: {
                title: 'Адрес заказа',
                isDelivery: true,
                forms: [
                    {
                        label: 'Улица*',
                        placeholder: 'ул.Секретная',
                        class: 'full',
                        type: 'text',
                        id: 'street',
                        formContent: '',
                        required: true,
                        maxLength: 255,
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        isError: false,
                        viewError: false,
                        errorText: 'поле является обязательным для заполнения'
                    },
                    {
                        label: 'Дом*',
                        placeholder: '16/4',
                        class: 'small',
                        formContent: '',
                        required: true,
                        maxLength: 255,
                        type: 'text',
                        id: 'house',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        isError: false,
                        viewError: false,
                        errorText: 'поле является обязательным для заполнения'
                    },
                    {
                        label: 'Квартира/офис',
                        placeholder: '50',
                        class: 'small',
                        formContent: '',
                        required: false,
                        maxLength: 255,
                        type: 'text',
                        id: 'apartment',
                    },
                    {
                        label: 'Подъезд',
                        placeholder: '2',
                        class: 'small no-margin',
                        type: 'text',
                        formContent: '',
                        required: false,
                        maxLength: 255,
                        id: 'entrance',
                    },
                    {
                        label: 'Этаж',
                        placeholder: '2',
                        class: 'small',
                        formContent: '',
                        required: false,
                        maxLength: 255,
                        type: 'text',
                        id: 'floor',
                    },
                    {
                        label: 'Домофон',
                        placeholder: '50',
                        formContent: '',
                        required: false,
                        maxLength: 255,
                        class: 'small no-margin',
                        type: 'text',
                        id: 'intercomNumber',
                    }
                ],
            },
        }
    },
    methods: {
        formValidate() {
            let street = this.delivery.forms[0]
            let house = this.delivery.forms[1]
            let apartment = this.delivery.forms[2]
            let entrance = this.delivery.forms[3]
            let floor = this.delivery.forms[4]
            let intercomNumber = this.delivery.forms[5]

            house.isError = house.formContent === '';
            street.isError = street.formContent === '';

            if (house.isError || street.isError) {
                this.$emit('formValidate', {
                    act: true,
                    street: street.formContent,
                    house: house.formContent,
                    apartment: apartment.formContent,
                    entrance: entrance.formContent,
                    floor: floor.formContent,
                    intercomNumber: intercomNumber.formContent,

                })
            } else {
                this.$emit('formValidate', {
                    act: false,
                    street: street.formContent,
                    house: house.formContent,
                    apartment: apartment.formContent,
                    entrance: entrance.formContent,
                    floor: floor.formContent,
                    intercomNumber: intercomNumber.formContent,
                })
            }
        },
    },
    created() {
        this.$parent.$on('checkForms', this.formValidate);
    },
    beforeDestroy() {
        this.$parent.$off('checkForms', this.formValidate);
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.delivery-forms {
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
            @include mobile {
                font-size: 18px;
                font-weight: 400;
                line-height: 19.8px;
                text-align: start;

            }
        }

        .forms {
            display: flex;
            flex-wrap: wrap;
            gap: 16px 0;
            @include mobile {
                gap: 16px;
            }

            form {
                display: flex;
                flex-wrap: wrap;
                @include mobile {
                    width: auto;
                }

                .form {
                    display: flex;
                    flex-direction: column;
                    position: relative;

                    label {
                        @include inter-400;
                        margin-bottom: 8px;
                        line-height: 20px;
                        @include mobile {
                            font-size: 14px;
                            font-weight: 400;
                            line-height: 19.8px;
                            text-align: left;

                        }
                    }

                    .form-icon.error {
                        position: absolute;
                        right: 16px;
                        bottom: 12px;
                        cursor: pointer;
                        @include form-icon;

                        &:hover {
                            @include form-icon-hover;
                        }
                    }

                    .message {
                        position: absolute;
                        background-color: $lightGrayishRed;
                        right: 16px;
                        bottom: 40px;
                        padding: 25px 32px;
                        border-radius: 16px;
                        width: 302px;

                        .txt {
                            max-width: 238px;
                            @include inter-400;
                            font-size: 16px;
                            line-height: 18px;
                        }
                    }

                    .default-form {
                        @include default-form;

                        &.full {
                            width: 100%;
                        }

                        &.small {
                            width: 100%;
                        }

                        &.error {
                            @include default-form-error
                        }

                        &:hover {
                            @include default-form-hover;
                        }
                    }

                    &.full {
                        width: 596px;
                        @include mobile {
                            width: 91vw;
                        }
                    }

                    &.small {
                        width: 172px;
                        margin-right: 39px;
                        @include mobile {
                            margin-right: 0;
                            width: 43vw;
                        }

                        &.no-margin {
                            margin-right: 0;
                        }
                    }
                }
            }
        }
    }
}
</style>
