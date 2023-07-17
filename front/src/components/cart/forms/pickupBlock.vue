<template>
    <div class="pickup-forms">
        <div class="section-title">{{ pickup.title }}</div>
        <div class="link" @click="scrollToFooter">{{ pickup.link }}</div>
    </div>
</template>

<script>
export default {
    name: "pickupBlock",
    methods: {
        scrollToFooter() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            })
        }
    },
    props: ['pickup']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.pickup-forms {
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
        cursor: pointer;
    }
}
</style>
