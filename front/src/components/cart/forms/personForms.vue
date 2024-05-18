<template>
    <div class="person-forms">
        <div class="form-item">
            <div class="section-title">{{ personForms.title }}</div>
            <div class="forms">
                <form
                    v-for="form in personForms.forms"
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
                            :maxlength="form.maxLength"
                        >
                        </textarea>
                        <input
                            v-else-if="form.mask"
                            :type="form.type"
                            :class="['default-form', form.class, {'error' : form.isError}]"
                            :placeholder="form.placeholder"
                            :required="form.required"
                            :maxlength="form.maxLength"
                            v-model="form.formContent"
                            v-mask="form.mask"
                            @change="formValidate(
                                form.id,
                                form.pattern,
                                form.formContent
                            )"
                        >
                        <input
                            v-else
                            :type="form.type"
                            :class="['default-form', form.class, {'error' : form.isError}]"
                            :placeholder="form.placeholder"
                            :required="form.required"
                            v-model="form.formContent"
                            :maxlength="form.maxLength"
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
    name: "personForms",
    data() {
        return {
            personForms: {
                title: 'Личные данные',
                id: 'personalForms',
                forms: [
                    {
                        label: 'Фамилия, Имя, Отчество*',
                        placeholder: 'Иванов Иван Иванович',
                        mask: false,
                        required: true,
                        maxLength: 255,
                        class: 'full',
                        type: 'text',
                        id: 'fullName',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        formContent: '',
                        // eslint-disable-next-line
                        pattern: new RegExp(/^[a-zA-Zа-яА-ЯёЁ\s\.,!@#$%^&*()\-=_+|{}[\]:;'"<>/?]{0,1000}$/),
                        isError: false,
                        viewError: false,
                        errorText: 'поле содержит недопустимые символы'
                    },
                    {
                        label: 'Телефон*',
                        placeholder: '+7 (ХХХ) ХХХ - ХХ - ХХ',
                        required: true,
                        mask: '+7 (###) ###-##-##',
                        pattern: new RegExp(/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/),
                        maxLength: 18,
                        class: 'medium no-margin',
                        type: 'text',
                        id: 'phoneNumber',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        formContent: '',
                        isError: false,
                        viewError: false,
                        errorText: 'поле является обязательным для заполнения'
                    },
                    {
                        label: 'Почта',
                        placeholder: 'ivanovivan@yandex.ru',
                        required: false,
                        mask: false,
                        maxLength: 255,
                        class: 'medium',
                        type: 'text',
                        id: 'email',
                        img: {
                            name: 'error',
                            src: '/images/cart/form/error-icon.svg',
                            class: 'error'
                        },
                        formContent: '',
                        // eslint-disable-next-line
                        pattern: new RegExp("^((([0-9A-Za-z]{1}[-0-9A-z\\.]{0,30}[0-9A-Za-z]?)|([0-9А-Яа-я]{1}[-0-9А-я\\.]{0,30}[0-9А-Яа-я]?))@([-A-Za-z]{1,}\\.){1,}[-A-Za-z]{2,})$"),
                        isError: false,
                        viewError: false,
                        errorText: 'это поле должно содержать имя почты, @, точку и домен'
                    },
                    {
                        placeholder: 'Комментарий',
                        required: false,
                        mask: false,
                        maxLength: 1000,
                        class: 'textarea',
                        type: 'textarea',
                        id: 'message',
                        formContent: '',
                    },
                ]
            }
        }
    },
    methods: {
        formValidate(id, pattern, content) {
            let index = this.personForms.forms.findIndex(el => el.id === id)
            let form = this.personForms.forms[index]

            if (content !== '') {
                if (form === this.personForms.forms[0]) {
                    form.errorText = 'поле содержит недопустимые символы'
                }
                form.isError = !pattern.test(content);
                return form.isError
            } else {
                if (form === this.personForms.forms[0]) {
                    form.errorText = 'поле является обязательным для заполнения'
                }
                form.isError = true
            }
            if (this.personForms.forms[2].formContent === '') {
                this.personForms.forms[2].isError = false
            }
        },
        notNull() {
            let name = this.personForms.forms[0]
            let tel = this.personForms.forms[1]
            let email = this.personForms.forms[2]
            let message = this.personForms.forms[3]

            if (name.formContent === '') {
                name.isError = true
            }
            if (tel.formContent === '') {
                tel.isError = true
            }
            if (email.formContent === '') {
                email.isError = false
            }

            if (name.isError || tel.isError || email.isError) {
                this.$emit('notNull', {
                    act: true,
                    nameContent: name.formContent,
                    telContent: tel.formContent,
                    emailContent: email.formContent,
                    messageContent: message.formContent,
                })
            } else {
                this.$emit('notNull', {
                    act: false,
                    nameContent: name.formContent,
                    telContent: tel.formContent,
                    emailContent: email.formContent,
                    messageContent: message.formContent,
                })
            }
        }
    },
    created() {
        this.$parent.$on('checkForms', this.notNull);
    },
    beforeDestroy() {
        this.$parent.$off('checkForms', this.notNull);
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.person-forms {
    max-width: 100%;

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
                text-align: start;
                font-size: 18px;
                font-weight: 400;
                line-height: 19.8px;
                text-align: left;
                margin-bottom: 18px;
            }
        }

        .forms {
            display: flex;
            flex-wrap: wrap;
            gap: 16px 0;
            @include mobile {
                flex-direction: column;
            }

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

                        &.medium {
                            width: 100%;

                            &.no-margin {
                                margin-right: 16px;
                                @include mobile {
                                    margin-right: 0;
                                }
                            }
                        }

                        &.textarea {
                            height: 96px;
                            resize: none;
                        }

                        &.error {
                            @include default-form-error;
                        }

                        &:hover {
                            @include default-form-hover;
                        }
                    }

                    &.full {
                        width: 596px;
                        @include mobile {
                            width: 100%;
                        }
                    }

                    &.medium {
                        width: 290px;
                        @include mobile {
                            width: 100%;
                        }

                        &.no-margin {
                            margin-right: 16px;
                            @include mobile {
                                margin-right: 0;
                            }
                        }
                    }

                    &.textarea {
                        width: 596px;
                        @include mobile {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
}

</style>
