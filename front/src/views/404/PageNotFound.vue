<template>
    <div class="page-not-found container">
        <div class="title">404</div>
        <div class="desc">Страница не найдена</div>
        <div class="buttons">
            <button @click="goBack">Назад</button>
            <button @click="onMainPage">На главную</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "PageNotFound",
    methods: {
        onMainPage() {
            this.$router.push('/')
        },
        goBack() {
            this.$router.go(-1);
        }
    }
}
</script>

<style scoped lang="scss">
@import "src/assets/styles/global";

.page-not-found {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    .title {
        @include inter-300;
        font-size: 350px;
        line-height: 259px;
        letter-spacing: -0.03em;
        text-align: center;
        margin-bottom: 48px;
    }

    .desc {
        @include inter-400;
        font-size: 32px;
        line-height: 35px;
        letter-spacing: -0.02em;
        text-align: center;
        margin-bottom: 64px;
    }

    .buttons {
        max-width: 480px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;

        button {
            @include green-button;
            width: 208px;
            height: 54px;
            text-align: center;

            &:hover {
                @include green-button-hover;
            }
        }
    }
}
</style>
