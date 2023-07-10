<template>
    <div class="person-forms">
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
                    <div :class="['form', form.class]">
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
                            :class="['form-icon', form.img.class]"
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
    name: "personForms",
    data () {
        return {
            personForms: [
                {
                    title: 'Личные данные',
                    id: 'personalForms',
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
                }
            ],
        }
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.person-forms {

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
                    &.textarea {
                        width: 596px;
                    }
                }
            }
        }
    }
}

</style>
