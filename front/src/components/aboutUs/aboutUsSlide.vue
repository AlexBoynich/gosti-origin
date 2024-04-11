<template>
    <div class="about-us-slide">
        <div class="left-part">
            <h2 class="slide-title">{{ slide.title }}</h2>
            <p class="slide-desc" v-html="slide.desc"></p>
        </div>
        <div class="right-part">
            <img :src="slide.img" alt="about-slider-slide">
        </div>
    </div>
</template>

<script>
export default {
    name: "aboutUsSlide",
    props: ['slide']
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";

.about-us-slide {
    display: flex;
    align-items: center;
    justify-content: space-between;
    @include mobile {
        flex-direction: column;

    }

    .left-part {

        .slide-title {
            @include h3;
            padding-bottom: 8px;
            border-bottom: solid 1px rgba(123, 149, 97, 0.8);
            display: inline-block;
            margin-bottom: 32px;
            padding-right: 25px;
            padding-top: 5px;

        }

        .slide-desc {
            @include inter-400;
            display: flex;
            flex-direction: column;
            max-width: 460px;
            gap: 16px 0;
        }
    }

    .right-part {
        position: relative;
        overflow: hidden;
        width: 596px;
        height: 656px;
        border-radius: 16px;
        
        @include mobile {
            max-width: 100%;
            height: auto;
            aspect-ratio: 328/294;
        }

        img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    }
}
</style>
