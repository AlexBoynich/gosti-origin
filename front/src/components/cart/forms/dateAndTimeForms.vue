<template>
    <div class="form-item">
        <div class="section-title">{{ orderForms.title }}</div>
        <div class="forms">
            <form
                v-for="(form, index) in orderForms.forms"
                :key="index"
            >
                <div :class="['form', form.class]">
                    <label :for="form.id">{{ form.label }}</label>
                    <div class="date" v-if="form.type === 'text'">
                        <input
                            :type="form.type"
                            :class="['default-form', form.class]"
                            :placeholder="form.placeholder"
                            :required="form.required"
                            v-model="form.formContent"
                            v-mask="form.mask"
                            @change="formValidate(
                                form.id,
                                form.formContent
                            );
                            timeSlots()"
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
                    <div
                        v-else
                        class="select"
                        @click="openSlots"
                    >
                        <div>{{ form.selected }}</div>
                        <div
                            v-show="slotsIsOpened"
                            class="select-content"
                        >
                            <div
                                v-for="(item, index) in slots"
                                :key="index"
                                class="option"
                            >
                                <div
                                    @click="currentSlot(item)"
                                    :class="{'active' : item === form.selected}"
                                >
                                    {{ item }}
                                </div>
                            </div>
                        </div>
                        <img
                            v-if="form.img"
                            :class="['form-icon', form.img.class, {'active' : slotsIsOpened}]"
                            :src="form.img.src"
                            alt="form-icon"
                        >
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "dateAndTimeForms",
    data() {
        return {
            orderForms: {
                title: 'Дата и время',
                forms: [
                    {
                        label: 'Дата',
                        placeholder: '24.07.2023',
                        mask: '##.##.####',
                        class: 'small',
                        type: 'text',
                        id: 'date',
                        formContent: '',
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
                        label: 'Время',
                        placeholder: '13:00-14:00',
                        mask: false,
                        class: 'small',
                        type: 'select',
                        id: 'time',
                        img: {
                            name: 'select',
                            src: '/images/cart/form/select-arrow.svg',
                            class: 'arrow'
                        },
                        currentTimeSlots: [
                            "10:00-11:00",
                            "11:00-12:00",
                            "12:00-13:00",
                            "13:00-14:00",
                            "14:00-15:00",
                            "15:00-16:00",
                            "16:00-17:00",
                            "17:00-18:00",
                            "18:00-19:00",
                            "19:00-20:00",
                            "20:00-21:00"
                        ],
                        futureTimeSlots: [
                            "9:30-10:30",
                            "10:30-11:30",
                            "11:30-12:30",
                            "12:30-13:30",
                            "13:30-14:30",
                            "14:30-15:30",
                            "15:30-16:30",
                            "16:30-17:30",
                            "17:30-18:30",
                            "18:30-19:30",
                            "19:30-20:30",
                            "20:30-21:30"
                        ],
                        selected: '',
                        isError: false
                    }
                ]
            },
            slotsIsOpened: false,
            slots: []
        }
    },
    computed: {
        currentDate: function () {
            const currentDate = new Date();
            let hour = currentDate.getUTCHours() + 7
            let day
            if (hour >= 19) {
                const nextDay = new Date(currentDate);
                nextDay.setDate(currentDate.getDate() + 1);
                day = nextDay.getDate().toString().padStart(2, '0');
            } else {
                day = currentDate.getDate().toString().padStart(2, '0');
            }
            const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            const year = currentDate.getFullYear().toString();
            return day + '.' + month + '.' + year
        }
    },
    methods: {
        formValidate(id, content) {
            let index = this.orderForms.forms.findIndex(el => el.id === id)
            let dateForm = this.orderForms.forms[index]
            dateForm.isError = dateForm.formContent === '';
            let [day, month, year] = content.split(".");
            const currentDate = new Date();
            const currentDay = currentDate.getDate().toString().padStart(2, '0');
            const currentMonth = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            const currentYear = currentDate.getFullYear().toString();

            if (content.length === 0) {
                dateForm.errorText = 'поле является обязательным для заполнения'
                dateForm.isError = true
            } else if (content.length !== 10) {
                dateForm.errorText = 'Эта дата не может быть выбрана'
                dateForm.isError = true
            } else if (month > 12) {
                dateForm.errorText = 'Эта дата не может быть выбрана'
                dateForm.isError = true
            } else if (day > 31) {
                dateForm.errorText = 'Эта дата не может быть выбрана'
                dateForm.isError = true
            } else if (day < currentDay && month <= currentMonth) {
                dateForm.errorText = 'Эта дата не может быть выбрана'
                dateForm.isError = true
            } else if(month < currentMonth && year <= currentYear){
                dateForm.errorText = 'Эта дата не может быть выбрана'
                dateForm.isError = true
            } else if(year > currentYear) {
                dateForm.errorText = 'Эта дата не может быть выбрана'
                dateForm.isError = true
            }else {
                dateForm.errorText = 'поле является обязательным для заполнения'
            }
        },
        notNull() {
            let date = this.orderForms.forms[0]
            date.isError = date.formContent === '';
            this.formValidate(date.id, date.formContent)

            if (date.isError) {
                date.errorText = 'поле является обязательным для заполнения'

                this.$emit('notNull', {
                    act: true,
                    date: date.formContent,
                    time: this.orderForms.forms[1].selected
                })
            } else {
                this.$emit('notNull', {
                    act: false,
                    date: date.formContent,
                    time: this.orderForms.forms[1].selected
                })
            }
        },
        currentSlot (item) {
            this.orderForms.forms[1].selected = item
        },
        openSlots () {
            this.slotsIsOpened = !this.slotsIsOpened
        },
        timeSlots () {
            if (this.currentDate === this.orderForms.forms[0].formContent) {
                let date = new Date();
                let hour = date.getUTCHours() + 7


                this.slots = this.orderForms.forms[1].currentTimeSlots
                let index = this.orderForms.forms[1].currentTimeSlots.findIndex((el) => {
                    let currentTime
                    if (el[0] === 0) {
                        currentTime = el[1]
                    } else {
                        currentTime = el[0] + el[1]
                    }
                    return currentTime > hour + 1
                })
                if (index > 0) {
                    this.slots.splice(0, index)
                }
                this.orderForms.forms[1].selected = this.orderForms.forms[1].currentTimeSlots[0]
            } else {
                this.orderForms.forms[1].selected = this.orderForms.forms[1].futureTimeSlots[0]
                this.slots = this.orderForms.forms[1].futureTimeSlots
            }
        }
    },
    created() {
        this.$parent.$on('checkForms', this.notNull);
    },
    mounted() {
        this.orderForms.forms[0].formContent = this.currentDate
        this.orderForms.forms[0].placeholder = this.currentDate
        this.timeSlots()
    },
    beforeDestroy() {
        this.$parent.$off('checkForms', this.notNull);
    }
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

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

                .date {

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

                    .message {
                        position: absolute;
                        background-color: rgba(243, 218, 218, 0.9);
                        right: -128px;
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
                }

                .default-form {
                    border-radius: 16px;
                    border: 1px solid #7B9561;
                    outline: none;
                    padding: 13px 24px;
                    @include inter-300;
                    font-size: 16px;
                    line-height: 16px;

                    &.small {
                        width: 100%;
                    }
                }

                &.small {
                    width: 172px;
                    margin-right: 39px;

                    &.no-margin {
                        margin-right: 0;
                    }
                }

                .select {
                    border-radius: 16px;
                    border: 1px solid #7B9561;
                    padding: 13px 24px;
                    @include inter-300;
                    font-size: 16px;
                    line-height: 16px;
                    color: #000;
                    cursor: pointer;
                    position: relative;

                    .select-content {
                        position: absolute;
                        max-height: 191px;
                        width: 172px;
                        padding: 0 24px 13px;
                        overflow: scroll;
                        gap: 4px 0;
                        top: 29px;
                        left: -1px;
                        background: white;
                        border: solid 1px $greenBackground;
                        border-top: solid 0 transparent;
                        border-radius: 0 0 16px 16px;
                        cursor: default;
                        z-index: 1;

                        scrollbar-width: none;
                        -ms-overflow-style: none;

                        &::-webkit-scrollbar {
                            display: none;
                        }


                        .option {
                            @include inter-300;
                            font-size: 16px;
                            line-height: 22px;
                            cursor: pointer;
                            color: rgba(0, 0, 0, 0.5);

                            &:first-child {
                                margin-top: 3px;
                            }
                            & div.active {
                                color: black;
                            }
                        }
                    }
                    .form-icon.arrow {
                        position: absolute;
                        right: 16px;
                        bottom: 16px;
                        width: 12px;
                        height: 6px;
                        transition: .3s ease-in-out;

                        &.active {
                            transform: rotate(180deg);
                        }
                    }
                }
            }
        }
    }
}
</style>
