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
                    <input
                        v-if="form.type === 'text'"
                        :type="form.type"
                        :class="['default-form', form.class]"
                        :placeholder="form.placeholder"
                    >
                    <div
                        v-else
                        class="select"
                    >
                        <div>dsd</div>
                        <img
                            v-if="form.img"
                            :class="['form-icon', form.img.class]"
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
    props: ['orderForms']
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
                    color: rgba(0, 0, 0, 0.5);
                    cursor: pointer;

                    .form-icon.arrow {
                        position: absolute;
                        right: 16px;
                        bottom: 21px;
                        width: 12px;
                        height: 6px;
                    }
                }
            }
        }
    }
}
</style>
