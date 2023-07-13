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
    name: "deliveryForms",
    props: ['delivery'],
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

                        &.small {
                            width: 100%;
                        }
                    }
                    &.full {
                        width: 596px;
                    }
                    &.small {
                        width: 172px;
                        margin-right: 39px;

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
